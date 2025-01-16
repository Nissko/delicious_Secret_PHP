<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProgramePageController extends Controller
{
    public function indexProgram(){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
        ];

        return view('program')->with(['data'=>$data]);
    }

    public function showProgram(Request $request){
        /*округление калорий для правильного расчета программ*/
        if ($request->calories < 1000){
            $cal = round ($request->calories, -2);
            $calMax = $cal + 500;
            $program = Program::all()->where('calories', '>=', $cal)
                ->where('calories', '<=', $calMax);
        }
        elseif ($request->calories > 2500){
            $cal = round ($request->calories, -3);
            $program = Program::all()->where('calories', 2500);
        }
        else {
            $cal = round ($request->calories, -3);
            $calMax = $cal + 500;
            $program = Program::all()->where('calories', '>=', $cal)
                ->where('calories', '<=', $calMax);
        }
        $data = view('programShow', ['program' => $program, 'calories' => $cal])->render();
        return response()->json(['options'=>$data]);
    }

    public function showOneProgram(Request $request){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'id' => $UserController -> user_id,
            'role' => $UserController -> user_role,
        ];
        $program_one = Program::find($request->id);
        return view('programShowOne', ['program' => $program_one])->with(['data'=>$data]);
    }

    public function store(Request $request){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'role' => $UserController -> user_role,
        ];
        $apps = AppModel::create($request->all());
        return redirect()->route('indexProgram')->with(['data'=>$data]);
    }

    public function FormBuy(Request $request){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'id' => $UserController -> user_id,
            'role' => $UserController -> user_role
        ];

        $program_id = $request -> program_id;

        if (Program::find($program_id)){
            return view('form_buy', compact('program_id'))->with(['data'=>$data]);
        }
        else{
            return redirect()->back();
        }
    }

    public function MakeOrder(Request $request){
        $UserController = new UserController();
        $UserController -> authUser();
        $data = (object)[
            'id' => $UserController -> user_id,
            'role' => $UserController -> user_role
        ];

        $program = Program::find($request -> program_id);

        $order = Order::create([
            'name'=> 'Заказ - ',
            'price'=> $program->price,
            'status' => 'Оплачен',
            'program_id' => $program->id,
            'user_id' => $data->id,
        ]);

        return redirect()->route('indexAccount');
    }

    public function StoreAdminProgram(Request $request){
        if(Auth::user() and Auth::user()->role === 'admin'){
            $file = $request->file('program_file');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move('storage/program', $filename);

            $program = Program::create([
                    'program_file' => isset($file) ? $filename : NULL,
                ] + $request -> all());

            return redirect()->route('admin.program.index');
        }
        else{
            return redirect()->route('indexHome');
        }
    }

    public function UpdateAdminProgram(Request $request, $id){
        if(Auth::user() and Auth::user()->role === 'admin'){
            if (isset($request->program_file)) {
                $file = $request->file('program_file');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move('storage/program', $filename);

                $program = Program::find($id);
                $program -> update([
                    'program_file' => isset($file) ? $filename : NULL,
                ] + $request -> all());

                return redirect()->route('admin.program.index');
            }
            else{
                $program = Program::find($id);
                $program -> update($request->all());

                return redirect()->route('admin.program.index');
            }
        }
        else{
            return redirect()->route('indexHome');
        }
    }
}
