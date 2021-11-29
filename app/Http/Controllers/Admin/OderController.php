<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Oder;
use App\Models\OderProduct;
use Exception;
use Illuminate\Http\Request;

class OderController extends Controller
{
    public function list()
    {
        $list = Oder::orderBy('id', 'DESC')->paginate($this->paginateItems);
        return view('be.oder.list', compact('list'));
    }
    public function add()
    {
        $oder = Oder::all();
        return view('be.oder.add', compact('oder'));;
    }
    public function doAdd(Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            Oder::create($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Add Error');
        }
        return redirect(route('admin.oder.list'))->with('success', 'Add Success');
        // TODO: Implement doAdd() method.
    }
    public function edit($id)
    {
        $obj = Oder::find($id);
        $oder = Oder::where('id', '<>', $id)->get();
        return view('be.oder.edit', compact('obj', 'oder'));
    }
    public function doEdit($id, Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            Oder::where('id', $id)->update($data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Edit Failed');
        }
        return redirect(route('admin.oder.list'))->with('success', 'Edit Success');
    }
    public function detail($id)
    {
        $oders = OderProduct::where('oder_id', $id)->get();
        $obj = Oder::find($id);
        return view('be.oder.detail', compact('oders', 'obj'));
    }
    public function update($id, Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            OderProduct::where('id', $id)->update($data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Edit Failed');
        }
        return redirect(route('admin.oder.list'))->with('success', 'Edit Success');
    }
    public function deleteItem($id)
    {
        try {
            OderProduct::where('id', $id)->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'DELETE FAILED!');
        }
        return redirect()->back()->with('success', 'DELETE SUCCESSED!');
    }
}