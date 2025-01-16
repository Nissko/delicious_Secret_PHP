<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Rate;
use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RecipePageController extends Controller
{
    public function indexRecipe(){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'id' => $UserController -> user_id,
            'role' => $UserController -> user_role,
        ];

        $rates = 0; //Рейтинг в числовом формате, изначально 0

        $recipe = Recipe::with('ingredients')->where('status', 'Опубликован')->paginate(10);

        return view('recipe')->with(['recipe' => $recipe])
            ->with(['rates' => $rates])
            ->with(['data'=>$data]);
    }

    public function showRecipe($id){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'id' => $UserController -> user_id,
            'role' => $UserController -> user_role,
        ];
        /*получение рейтинга рецепта*/
        $rate_db = Rate::all()->where('recipe_id', $id);
        $rates = 0; //Рейтинг в числовом формате, изначально 0
        foreach ($rate_db as $rating){
            $rates += $rating->value_rate; // получаем рейтинг
        }
        //если есть несколько оценок, то ищем AVG
        if ($rates > 0){
            $rates = round($rates / count($rate_db), 0);
        }

        /*получение оценки, конктретно от авторизированного юзера*/
        $rates_user = Rate::all()->where('recipe_id', $id)->where('user_id', $data->id) ? Rate::all()->where('recipe_id', $id)->where('user_id', $data->id) : "null";
        $recipe_show = Recipe::find($id);
        return view('recipe.show', ['recipe_show' => $recipe_show])
            ->with(['rates' => $rates])
            ->with(['rates_user' => $rates_user])
            ->with(['data'=>$data]);
    }

    public function AddRate(Request $request, $id){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'id' => $UserController -> user_id,
            'role' => $UserController -> user_role,
        ];
        $rate = Rate::create([
            'value_rate' => (integer)$request->rating,
            'user_id' => $data -> id,
            'recipe_id' => $id
        ]);

        return redirect()->back();
    }

    /*Сортировка*/
    public function search(Request $request)
    {
        if($request->ajax()){
            $UserController = new UserController();
            $UserController -> authUser();
            $data = (object)[
                'role' => $UserController -> user_role,
            ];
            $rates = 0; //Рейтинг в числовом формате, изначально 0

            $query = $request->value;

            $results = Recipe::where('name', 'LIKE', '%' . $query . '%')
                ->where('status', 'Опубликован')
                ->orWhere('description', 'LIKE', '%' . $query . '%')->get();

            $datas = view('recipe.search_result', compact('results'))
                ->with(['query' => $query])
                ->with(['rates' => $rates])
                ->with(['data'=>$data])->render();

            return response()->json(['options'=> $datas]);
        }
    }

    public function SortParam(Request $request){
        if($request->ajax()){
            $UserController = new UserController();
            $UserController -> authUser();
            $data = (object)[
                'role' => $UserController -> user_role,
            ];
            $rates = 0; //Рейтинг в числовом формате, изначально 0

            $query = $request->value;
            if ($query === 'desc'){ /*Сортировка по новизне*/
                $results = Recipe::all()->where('status', 'Опубликован')->sortDesc();
                $datas = view('recipe.sort_param')
                    ->with(['results' => $results])
                    ->with(['rates' => $rates])
                    ->with(['data'=>$data])->render();

                return response()->json(['options'=> $datas]);
            }
            elseif ($query === 'most_popular'){ /*Сортировка по популярности*/
                $results = Recipe::all()->where('status', 'Опубликован')->sortByDesc('average_rate');

                $datas = view('recipe.sort_param')
                    ->with(['results' => $results])
                    ->with(['rates' => $rates])
                    ->with(['data'=>$data])->render();

                return response()->json(['options'=> $datas]);
            }
            else{
                return redirect()->back();
            }
        }
    }

    public function StoreAdminRecipe(Request $request){
        if (Auth::user() and Auth::user()->role === "admin"){
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
                'user_id' => Auth::user()->id,
                'category_id' => $request -> recipe_category,
                'status' => 'Опубликован'
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

            return redirect()->route('admin.recipe.index');
        }
        else{
            return redirect()->route('indexHome');
        }
    }

    public function UpdateAdminRecipe(Request $request){
        if (Auth::user() and Auth::user()->role === "admin"){
            if (isset($request -> img)){
                /*Обложка рецепта*/
                $file = $request->file('img');
                $filename_recipe = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/recipes', $filename_recipe);

                /*Создаем новый рецепт*/
                $recipe = Recipe::find($request->id);
                $recipe -> update([
                    'img' => $filename_recipe,
                ] + $request->all());

                return redirect()->route('admin.recipe.index');
            }
            else{
                /*Создаем новый рецепт*/
                $recipe = Recipe::find($request->id);
                $recipe -> update($request->all());

                return redirect()->route('admin.recipe.index');
            }
        }
        else{
            return redirect()->route('indexHome');
        }
    }

    public function UpdateAdminRecipeIngredient(Request $request){
        if (Auth::user() and Auth::user()->role === "admin"){
            /*добавляем массив кол-ва в переменную*/
            $qty = $request -> recipe_ingredients_qty;
            $id = $request -> ingrediend_id;
            /*сортируем*/
            foreach ($request -> recipe_ingredients as $index => $name){
                /*создаем ingredient*/
                $ingredient = Ingredient::find($id[$index]);
                $ingredient -> update([
                    'name' => $name,
                    'qty' => $qty[$index],
                ]);
            }

            return redirect()->route('admin.recipe.index');
        }
        else{
            return redirect()->route('indexHome');
        }
    }

    public function UpdateAdminRecipeStep(Request $request){
        if (Auth::user() and Auth::user()->role === "admin"){
            /*добавляем массив кол-ва в переменную*/
            $id = $request -> step_id;
            /*сортируем*/
            foreach ($request -> recipe_steps_description as $indexSteps => $description_name){
                $step = Step::find($id[$indexSteps]);
                $step -> update([
                    'description' => $description_name,
                ]);
            }

            return redirect()->route('admin.recipe.index');
        }
        else{
            return redirect()->route('indexHome');
        }
    }
}
