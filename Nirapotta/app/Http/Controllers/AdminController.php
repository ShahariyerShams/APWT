<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request,  $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function AdminCreate(){
        return view('admin.adminCreate');
    }
    public function adminCreateSubmitted(Request $request){
        $admin = new Admin();
        $admin->name= $request->name;
        $admin->email= $request->email;
        $admin->phone= $request->phone;
        $admin->password= $request->password;
        $admin->save();
        return redirect()->route('adminList');
    }
    public function adminList(){
        $Admins = Admin::all();
        return view('admin.adminList')->with('admins', $admins);
    }
    //public function teacherCourses(Request $request){

        // $t = Teacher::where('id',1)->first();
        ///$t = Teacher::where('id',$request->id)->first();
        // return $t->id;
        //hasmany
       // return $t->courses;

        //eloquent
        // return $t->assignedCourses();
    
    public function adminDash(){
        return view('index');

    }
    public function registration()
    {
        return view('registration');
    }
    public function newAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',            
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:3|max:30',
            'confirmpassword' => 'required',
        ]); 
        
        
        if($request->input('password')==$request->input('confirmpassword')){
            $admin = new Admin;
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->phone = $request->input('phone');
            $admin->password = $request->input('password');
            $admin->save();
        }
        else{
            return back()->with('fail','Password Do not Match');
        }

        if($admin->save()){
            return back()->with('success','Registartion Has been Succesfuly Done');
         }else{
             return back()->with('fail','Something went wrong, try again later');
         }
    }
}
