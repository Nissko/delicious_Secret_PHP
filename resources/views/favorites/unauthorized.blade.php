@extends('home')
@section('title', 'Избранное')
@section('content')
    <link href="{{ asset( 'style/bootstrap/bootstrap.css' ) }}" rel="stylesheet">
    <script src="{{ asset( 'js/bootstrap/bootstrap.min.js' ) }}"></script>
    <link href="{{ asset( 'style/favorite_style.css' ) }}" rel="stylesheet">
    <div class="min-vh-100 container_content message_no_auth">
        <div class="alert alert-danger">
            <span>Вы не авторизованы!</span>
        </div>
        <div>
            <a href="." class="btn btn-outline-warning">Вернуться на главную</a>
        </div>
    </div>
@endsection
