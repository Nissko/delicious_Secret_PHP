<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'id' => $UserController -> user_id,
            'role' => $UserController -> user_role,
            'name' => $UserController -> user_name,
            'surname' => $UserController -> user_surname,
            'photo' => $UserController -> user_photo
        ];

        if (Auth::user()){
            $favorites = Favorite::all()->where('user_id', $UserController -> user_id);

            return view('favorites.index')
                ->with('favorites', $favorites)
                ->with('data', $data);
        } else{

            return view('favorites.unauthorized')
                ->with('data', $data);
        }
    }

    public function store(Request $request)
    {
        if ($request->ajax()){
            $favorites = Favorite::create([
                'recipe_id' => $request->recipe,
                'user_id' => $request->user,
            ]);

            $datas = redirect()->back();

            return response()->json(['options'=> $datas]);
        }
        return redirect()->route('indexRecipe');
    }

    public function destroy(Request $request)
    {
        $favorites = Favorite::find($request->favorite_id);
        $favorites->delete();

        return redirect()->back();
    }
}
