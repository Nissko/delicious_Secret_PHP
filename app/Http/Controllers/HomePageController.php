<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function indexHome() {
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
        ];
        return view('home')->with(['data'=>$data]);
    }
}
