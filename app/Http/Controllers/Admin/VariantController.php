<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use Exception;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function list()
    {
        $list = Variant::orderBy('id', 'DESC')->paginate($this->paginateItems);
        return view('be.variant.list', compact('list'));
    }
    public function add()
    {
        return view('be.variant.add');
    }
    public function doAdd(Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            Variant::create($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Add Error');
        }
        return redirect(route('admin.variant.list'))->with('success', 'Add Success');
        // TODO: Implement doAdd() method.
    }
    public function edit($id)
    {
        $obj = Variant::find($id);
        return view('be.variant.edit', compact('obj'));
    }
    public function doEdit($id, Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            Variant::where('id', $id)->update($data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Edit Failed');
        }
        return redirect(route('admin.variant.list'))->with('success', 'Edit Success');
    }
    public function delete($id)
    {
        try {
            Variant::where('id', $id)->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'DELETE FAILED!');
        }
        return redirect()->back()->with('success', 'DELETE SUCCESSED!');
    }
}