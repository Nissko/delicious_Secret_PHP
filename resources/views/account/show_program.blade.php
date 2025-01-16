<?php
use Illuminate\Support\Carbon;
?>
@foreach($orders as $order)
    <div class="form-control mb-3">
        <div class="pt-1 pb-1">{{ $order -> name }} {{ $order -> id }}</div>
        <div class="pb-1">Статус: {{ $order -> status }}</div>
        <div class="pb-1">Стоимость: {{ $order -> price }} рублей</div>
        <div class="pb-1">Программа: {{ $order -> program -> name }}</div>
        <div>Дата программы: с {{ $order -> program -> created_at -> format('d.m.Y') }} до {{ Carbon::createFromFormat('d.m.Y', $order -> program -> created_at -> format('d.m.Y'))->addDays(5)->format('d.m.Y') }}</div>
        <div class="mt-2 mb-2 d-flex gap-3">
            <a class="btn btn-primary btn-sm text-white" href="{{ asset('storage/program/'.$order -> program -> program_file) }}">Скачать программу</a>
            <form action="{{ route('account.checkOrder', $order->id) }}">
                @csrf
                <button class="btn btn-warning btn-sm">Чек оплаты</button>
            </form>
        </div>
    </div>
@endforeach
