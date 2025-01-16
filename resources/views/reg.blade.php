@extends('home')
@section('content')
    <div class="container_content">
        <div class="reg">
            @if($data -> role == 'guest')
            @endif
            @if($data -> role == 'user')
                <a href="/logout">Выход</a>
            @endif
            <h1 class="b-h1">Регистрация</h1>
            <form action="{{route('store')}}" method="post">
                @csrf
                <div><input class="b-name" type="text" name="first_name" placeholder="Ваше имя"></div>
                <div><input class="b-surname" type="text" name="last_name" placeholder="Ваша фамилия"></div>
                <div><input class="b-surname" type="text" name="patronymic" placeholder="Ваше отчество"></div>
                <div><input class="b-phone" type="text" name="phone" placeholder="Ваш телефон"></div>
                <div><input class="b-email" type="email" name="email" placeholder="Ваша почта"></div>
                <div><input class="b-password" type="password" name="password" placeholder="Ваш пароль"></div>
                <div class="bb-btn"><input class="b-btn" type="submit" name="b-btn" value="Зарегистрироваться"></div>
            </form>
        </div>
    </div>
@endsection
