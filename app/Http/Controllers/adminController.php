<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\userUpdateRequest;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userNum=User::all()->count();
        $roleNum=Role::all()->count();
         return view("adminLTE.index",compact("userNum","roleNum"));
        
    }

    public function showAllUsers()
    {
        $users=User::all();
        $roles=Role::pluck('name','id')->all();
       

     return view("adminLTE.showAllUsers",compact('users','roles'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::findOrFail($id);
        return view("adminLTE.show",compact('user'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::findOrFail($id);
        $roles=Role::pluck('name','id')->all();
        return view("adminLTE.edit",compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(userUpdateRequest $request, $id)
    {
        
         $input=$request->all();
         $user=User::findOrFail($input['userid']);
        if($file=$request->file('photo'))
        {
       
        $name=$file->getClientOriginalName();
        $file->move('images',$name);
        $input['photo']=$name;
        }
        $input['password']=bcrypt($request->password);

         $user->update($input);

        return redirect('/admin/users');
      
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $user=User::findOrFail($request['deleteuserid']);
        unlink(public_path().$user->photo);
        $user->delete();
        return redirect('/admin/users');
        return $user;
 
    }
}
