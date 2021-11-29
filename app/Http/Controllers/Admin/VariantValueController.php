<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use App\Models\VariantValue;
use Exception;
use Illuminate\Http\Request;

class VariantValueController extends Controller
{
    public function list()
    {
        $list = VariantValue::orderBy('id', 'DESC')->paginate($this->paginateItems);
        return view('be.variant_value.list', compact('list'));
    }
    public function add()
    {
        $variants = Variant::all();
        return view('be.variant_value.add', compact('variants'));
    }
    public function doAdd(Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            VariantValue::create($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Add Error');
        }
        return redirect(route('admin.variant_value.list'))->with('success', 'Add Success');
        // TODO: Implement doAdd() method.
    }
    public function edit($id)
    {
        $obj = VariantValue::find($id);
        $variants = Variant::all();
        return view('be.variant_value.edit', compact('obj', 'variants'));
    }
    public function doEdit($id, Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            VariantValue::where('id', $id)->update($data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Edit Failed');
        }
        return redirect(route('admin.variant_value.list'))->with('success', 'Edit Success');
    }
    public function delete($id)
    {
        try {
            VariantValue::where('id', $id)->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'DELETE FAILED!');
        }
        return redirect()->back()->with('success', 'DELETE SUCCESSED!');
    }
}