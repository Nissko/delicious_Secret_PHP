@extends('home')
@section('content')
    <div class="container_content">
        <div class="reg">
            <h1 class="b-h1">Авторизация</h1>
            <form action="{{ route('signup') }}" method="post">
                @csrf
                <div><input type="email" class="b-email" name="email" placeholder="Ваша почта"></div>
                <div><input type="password" class="b-password" name="password" placeholder="Ваш пароль"></div>
                <div class="bb-btn"><input class="b-btn" type="submit" name="b-btn" value="Войти"></div>
            </form>
        </div>
    </div>
@endsection
