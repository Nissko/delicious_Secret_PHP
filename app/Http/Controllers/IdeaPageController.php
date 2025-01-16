<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdeaPageController extends Controller
{
    public function indexIdea(){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
        ];
        return view('idea')->with(['data'=>$data]);
    }
}
