<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\Recipe;
use App\Models\Step;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        return view('account.index')
            ->with(['data' => $data]);
    }

    public function AddRecipeUserForm(Request $request){
        if($request->ajax()){
            $UserController = new UserController();
            $UserController -> authUser();
            $data = (object)[
                'id' => $UserController -> user_id,
                'role' => $UserController -> user_role,
                'name' => $UserController -> user_name,
                'surname' => $UserController -> user_surname,
            ];

            $categories = Category::all();
            $countries = Country::all();

            $datas = view('account.recipe_add')
                ->with('categories', $categories)
                ->with('countries', $countries)
                ->with(['data' => $data])->render();
            return response()->json(['options'=>$datas]);
        }
    }

    public function changePhotoForm(Request $request){
        if($request->ajax()){
            $UserController = new UserController();
            $UserController -> authUser();
            $data = (object)[
                'id' => $UserController -> user_id,
                'role' => $UserController -> user_role,
                'name' => $UserController -> user_name,
                'surname' => $UserController -> user_surname,
            ];

            $datas = view('account.photo_form')->with(['data' => $data])->render();
            return response()->json(['options'=>$datas]);
        }
    }

    public function changePhotoLogic(Request $request, User $user){
        $file = $request->file('photo');
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        /*Move or StoreAs*/
        $file->move('storage/account', $filename);
        $user->update([
            'photo' => $filename
        ]);

        return redirect()->route('indexAccount');
    }

    public function changePasswordForm(Request $request)
    {
        if($request->ajax()){
            $UserController = new UserController();
            $UserController -> authUser();
            $data = (object)[
                'id' => $UserController -> user_id,
                'role' => $UserController -> user_role,
                'name' => $UserController -> user_name,
                'surname' => $UserController -> user_surname,
            ];

            $datas = view('account.password_form')->with(['data' => $data])->render();
            return response()->json(['options'=>$datas]);
        }
    }

    public function changePasswordLogic(Request $request, User $user){
        $password = $request->password;
        $password_verification = $request->new_password;

        if ($password === $password_verification){
            $user->update([
                'password' => Hash::make($password)
            ]);
            Auth::logout();
            return redirect()->route('login');
        }
        else{
            return redirect()->back();
        }
    }

    public function AddRecipeUser(Request $request, User $user){
        if (Auth::user()){
            /*Обложка рецепта*/
            $file = $request->file('recipe_img');
            $filename_recipe = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move('storage/recipes', $filename_recipe);

            /*Создаем новый рецепт*/
            $recipe = Recipe::create([
                'name' => $request -> recipe_name,
                'description' => $request -> recipe_description,
                'person' => $request -> recipe_person,
                'time' => $request -> recipe_time,
                'calories' => $request -> recipe_calories,
                'img' => $filename_recipe,
                'country_id' => $request -> recipe_country,
                'user_id' => $user->id,
                'category_id' => $request -> recipe_category,
            ]);

            /*добавляем массив кол-ва в переменную*/
            $qty = $request -> recipe_ingredients_qty;
            /*сортируем*/
            foreach ($request -> recipe_ingredients as $index => $name){
                /*создаем ingredient*/
                $ingredient = Ingredient::create([
                    'name' => $name,
                    'qty' => $qty[$index],
                    'recipe_id' => $recipe->id,
                ]);
            }

            /*Добавление шагов*/
            $photo_name = $request -> recipe_steps_img;
            $count = 1;

            foreach ($request -> recipe_steps_description as $indexSteps => $description_name){
                if (isset($photo_name[$indexSteps])){
                    $file = $photo_name[$indexSteps];
                    $filename_recipe_steps = Str::random(40) . '.' . $file->getClientOriginalExtension();
                    $file->move('storage/recipes/steps', $filename_recipe_steps);
                }
                $steps = Step::create([
                    'step_number' => $count,
                    'description' => $description_name,
                    'step_img' => isset($photo_name[$indexSteps]) ? $filename_recipe_steps : NULL,
                    'recipe_id' => $recipe->id
                ]);
                $count++;
            }

            return redirect()->route('indexAccount')->with('success', 'Рецепт успешно добавлен и будет опубликован, после проверки администрацией!');
        }
        else{
            return redirect()->route('indexHome');
        }
    }

    public function showProgram(Request $request){
        if (Auth::user()){
            if($request->ajax()){
                $UserController = new UserController();
                $UserController -> authUser();
                $data = (object)[
                    'id' => $UserController -> user_id,
                    'role' => $UserController -> user_role,
                    'name' => $UserController -> user_name,
                    'surname' => $UserController -> user_surname,
                ];

                $order = Order::all()->where('user_id', $data -> id)->sortDesc();

                $datas = view('account.show_program')
                    ->with(['data' => $data])
                    ->with(['orders' => $order])
                    ->render();
                return response()->json(['options'=>$datas]);
            }
        }
    }
}
