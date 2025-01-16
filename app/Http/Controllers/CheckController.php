<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function showCheck(Request $request, $order_id){
        $orders = Order::findOrFail($order_id) /* Поиск заказа */;
        $count = $orders->count(); /* кол-во */

        return view('Check.check_form', compact('orders', 'count'));
    }

    public function checkOrder(Request $request, $order_id){
        $orders = Order::findOrFail($order_id) /* Поиск заказа */;
        $count = $orders->count(); /* кол-во */

        $pdf = Pdf::loadView('Check.check_form', compact('orders'), compact('count'));

        return $pdf->download('delicious_secret_recipe_check_order-'. $orders->id .'.pdf');
    }
}
