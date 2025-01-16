<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Program;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user() and Auth::user()->role === 'admin'){
            $UserController = new UserController();
            $UserController -> authUser();
            $data = (object)[
                'role' => $UserController -> user_role,
            ];

            return view('admin.index')->with('data', $data);
        }
        else{
            return redirect()->route('indexHome');
        }
    }

    public function ModerateRecipe() {
        if (Auth::user() and Auth::user()->role === 'admin'){
            $UserController = new UserController();
            $UserController -> authUser();
            $data = (object)[
                'role' => $UserController -> user_role,
            ];

            $recipe = Recipe::with('ingredients')->paginate(5);
            $category = Category::all();
            $country = Country::all();

            return view('admin.recipe.index')
                ->with('countries', $country)
                ->with('categories', $category)
                ->with('recipes', $recipe)
                ->with('data', $data);
        }
        else{
            return redirect()->route('indexHome');
        }
    }

    public function ModerateProgram() {
        if (Auth::user() and Auth::user()->role === 'admin'){
            $UserController = new UserController();
            $UserController -> authUser();
            $data = (object)[
                'role' => $UserController -> user_role,
            ];

            $program = Program::all();

            return view('admin.program.index')
                ->with('programs', $program)
                ->with('data', $data);
        }
        else{
            return redirect()->route('indexHome');
        }
    }
}
