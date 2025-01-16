<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $user_id;
    public $user_role;
    public $user_name;
    public $user_surname;
    public $user_photo;

    function authUser(){
        if (Auth::check()){
            $user = Auth::user();
            $this -> user_id = $user -> id;
            $this -> user_role = $user -> role;
            $this -> user_name = $user -> first_name;
            $this -> user_surname = $user -> last_name;
            $this -> user_photo = $user -> photo;
        }
        else{
            $this -> user_role = 'Гость';
        }
    }

    public function index(){
        $this -> authUser();
        $data = (object)[
            'role' => $this -> user_role,
        ];
        return view('home')->with(['data' => $data]);
    }

    public function create(){
        $this -> authUser();
        $data = (object)[
            'role' => $this -> user_role,
        ];
        return view('reg')->with(['data' => $data]);
    }

    public function store(Request $request){
        User::create([
                'password' => Hash::make($request->password),
            ] + $request->all());
        return redirect()->route('login');
    }
    public function login(){
        $this -> authUser();
        $data = (object)[
            'role' => $this -> user_role,
        ];
        return view('auth')->with(['data' => $data]);
    }

    public function signup(Request $request){
        if (Auth::attempt($request -> only(['email', 'password']))){
            return redirect()->route('indexHome');
        }
        return redirect()->route('login');
    }

    public function logout(){
        if (Auth::check()){
            Auth::logout();
            return redirect()->route('indexHome');
        }
    }
}

