<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class adminRoleController extends Controller
{
    public function index()
    {
        $roles=Role::all();
        return view('adminLTE.role.index',compact('roles'));
        
    }
    public function store(Request $request)
    {
        $data=[
            "name"=>$request->name
        ];
        Role::create($data);
        return redirect()->back();
    }
}
