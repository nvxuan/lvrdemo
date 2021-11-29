<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Oder;
use App\Models\OderProduct;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeController extends Controller
{
    //
    public function index()
    {
        return view('fe.layout');
    }

    public function home()
    {
        $lastProducts = Product::orderBy('id', 'DESC')->paginate(5);
        $topViewProducts = Product::orderBy('views', 'DESC')->paginate(5);
        $topSoldProducts = Product::orderBy('sold', 'DESC')->paginate(5);
        return view('fe.home', compact('lastProducts', 'topSoldProducts', 'topViewProducts'));
    }

    public function search(Request $request)
    {
        $q = $request->q;
        $id = -1;
        $category = ($id == -1) ? null : Category::find($id);
        $allCategory = Category::all();
        $products = Product::where('name', 'LIKE', '%' . $q . '%')->orWhere('content', 'LIKE', '%' . $q . '%')->orderBy('id', 'DESC')->paginate($this->paginateItems);
        return view('fe.products.category', compact('products', 'category', 'allCategory'));
    }
    public function user($id, Request $request)
    {
        $oders = Oder::where('user_id', '=', $id)->get();
        $oderProducts = OderProduct::all();
        $user = User::find($id);
        return view('fe.user.user', compact('user', 'oders', 'oderProducts'));
    }
    public function checkout(Request $request)
    {

        try {
            DB::beginTransaction();

            //xu ly du lieu de chen vao oder
            $data = $request->all();
            $user = $request->session()->get('USER');
            unset($data['_token']);
            $data['user_id'] = $user->id;
            $data['name'] = $user->name;
            $data['phone'] = $user->phone;
            $data['tax'] = 0;
            $oder = Oder::create($data);
            //chen vao bang oder_products
            $products = $request->session()->get('CART');
            foreach ($products as $product) {
                $oderProduct = array();
                $oderProduct['product_id'] = $product['product']->id;
                $oderProduct['oder_id']  = $oder->id;
                $oderProduct['quantity']  = $product['quantity'];
                $oderProduct['name']  = $product['product']->name;
                $oderProduct['price']  = $product['product']->price;
                DB::table('oder_products')->insert($oderProduct);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect(view('fe.home'))->with('success', "Đặt Hàng Thành Công!");
    }
}