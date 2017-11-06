<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
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

    public function index(Request $request)
    {
        $users = DB::select("select * from users where NOT role = 'SuperAdmin'");
        return view('staff.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        return view('staff.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'username' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required',
            'role' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

            if ($validator->passes()) {

                $user = New User();
                $user->username = Input::get('username');
                $user->email = Input::get('email');
                $password = Input::get('password');
                $user->password = Hash::make($password);
                $user->role = Input::get('role');
                $user->save();
                
                flash('staff created succefully!');
                return redirect('staff');
                
            }else{
                return Redirect::intended('staff/create')
                    ->withErrors($validator)
                    ->withInput();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the user
        $user = User::find($id);

        // show the edit form and pass the user
        return View('staff.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'username' => 'required',
            'email' => 'required',
            'password' => '',
            'role' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

            if ($validator->passes()) {

                $user = User::find($id);
                $user->username = Input::get('username');
                $user->email = Input::get('email');
                $password = Input::get('password');
                $user->password = Hash::make($password);
                $user->role = Input::get('role');
                $user->save();
                flash('staff updated succefully!');
                return redirect('staff');
                
            }else{
                return Redirect::back()->withInput()->withErrors($validator);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $user = User::find($id);
        $user->delete();

        // redirect
        return Redirect::intended('staff');
    }
}
