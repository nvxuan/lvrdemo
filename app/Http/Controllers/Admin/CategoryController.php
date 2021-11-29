<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function list()
    {
        $list = Category::orderBy('id', 'DESC')->paginate($this->paginateItems);
        return view('be.category.list', compact('list'));
    }
    public function add()
    {
        $category = Category::all();
        return view('be.category.add', compact('category'));;
    }
    public function doAdd(Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            Category::create($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Add Error');
        }
        return redirect(route('admin.category.list'))->with('success', 'Add Success');
        // TODO: Implement doAdd() method.
    }
    public function edit($id)
    {
        $obj = Category::find($id);
        $category = Category::where('id', '<>', $id)->get();
        return view('be.category.edit', compact('obj', 'category'));
    }
    public function doEdit($id, Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            Category::where('id', $id)->update($data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Edit Failed');
        }
        return redirect(route('admin.category.list'))->with('success', 'Edit Success');
    }
    public function delete($id)
    {
        try {
            Category::where('id', $id)->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'DELETE FAILED!');
        }
        return redirect()->back()->with('success', 'DELETE SUCCESSED!');
    }
}