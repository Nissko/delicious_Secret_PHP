@extends('home')
@section('title', 'Админ-панель')
@section('content')
    <link href="{{ asset( 'style/bootstrap/bootstrap.css' ) }}" rel="stylesheet">
    <script src="{{ asset( 'js/bootstrap/bootstrap.min.js' ) }}"></script>
    <link rel="stylesheet" href="{{ asset('style/account_style.css') }}">
    <div class="container_content main_account min-vh-100">
        <div class="fs-4 fw-bold pb-4">Добро пожаловать в панель-администратора!</div>
        <div class="pb-2">Выберите, что хотите сделать:</div>
        <div>
            <a class="btn btn-outline-primary" href="{{ route('admin.recipe.index') }}">Редактировать рецепты</a>
            <a class="btn btn-outline-primary" href="{{ route('admin.program.index') }}">Редактировать программы</a>
        </div>
    </div>
@endsection
