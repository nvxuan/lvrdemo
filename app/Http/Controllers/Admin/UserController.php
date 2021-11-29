<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller implements ICRUD
{
    public function list()
    {
        $list = User::orderBy('id', 'DESC')->paginate($this->paginateItems);
        return view('be.user.list', compact('list'));
    }
    public function search(Request $request)
    {
        $q = $request->q;
        $list = User::where('name', 'LIKE', '%' . $q . '%')->orWhere('email', 'LIKE', '%' . $q . '%')->orWhere('full_name', 'LIKE', '%' . $q . '%')->orderBy('id', 'DESC')->paginate($this->paginateItems);
        return view('be.user.list', compact('list'));
    }
    public function add()
    {
        return view('be.user.add');
    }
    public function doAdd(Request $request)
    {
        try {
            $data = $request->all();
            //$data['password'] = Hash::make($data['password']);
            unset($data['_token']);
            //DB::table('users')->insert($data);
            //dd($data);
            User::create($data);
        } catch (\Exception $e) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);
            return redirect()->back()->with('error', 'Add Error');
        }
        return redirect(route('admin.user.list'))->with('success', 'Add Success');
        // TODO: Implement doAdd() method.
    }
    public function edit($id)
    {
        $obj = User::find($id);
        return view('be.user.edit', compact('obj'));
    }
    public function doEdit($id, Request $request)
    {
        try {
            $data = $request->all();
            //$data['password'] = Hash::make($data['password']);
            unset($data['_token']);
            User::where('id', $id)->update($data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Edit Failed');
        }
        return redirect()->back()->with('success', 'Edit Done');
    }
    public function delete($id)
    {
        try {
            User::where('id', $id)->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'DELETE FAILED!');
        }
        return redirect()->back()->with('success', 'DELETE SUCCESSED!');
    }
}