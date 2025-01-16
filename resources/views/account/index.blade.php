@extends('home')
@section('title', 'Личный кабинет')
@section('content')
    <link href="{{ asset( 'style/bootstrap/bootstrap.css' ) }}" rel="stylesheet">
    <script src="{{ asset( 'js/bootstrap/bootstrap.min.js' ) }}"></script>
    <link rel="stylesheet" href="{{ asset('style/account_style.css') }}">
    <div class="container_content main_account">
        @if(session()->has('success'))
            <div class="alert alert-success cart_message mb-3">{{ session('success') }}</div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger cart_message mb-3">{{ session('error') }}</div>
        @endif
        <div>
            {{--photo + ФИО + кнопка "добавить рецепт" + программы + изменить фото + поменять пароль + выход--}}
            <div class="account_div_background">
                <div class="account_left_menu">
                    <div class="account_img_user">
                        <img class="account-page-avatar_photo" src="{{ asset('storage/account/'.$data -> photo)}}" width="140" alt="Ваше фото">
                    </div>
                    <div class="account_info_user">
                        <div>{{ $data -> name }} {{$data -> surname}}</div>
                    </div>
                    <div class="account_user_program">
                        <button>Мои программы</button>
                    </div>
                    <div class="account_user_add_recipe">
                        <button>Добавить рецепт</button>
                    </div>
                    <div class="account_functional_buttons">
                        <button class="change_img">Изменить фото</button>
                        <button class="change_password">Изменить пароль</button>
                        <a href="{{ route('logout') }}"><button>Выход</button></a>
                    </div>
                </div>

                <div class="account_right_menu">
                    <div class="account-page-right_menu-title_blocks fs-4">Информация будет появляться после нажатия кнопки</div>
                    <div class="account-page-right_menu-info">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.change_img').click(function (event) {
                let id = {{ $data -> id }};
                ChangePhoto(id);
            });
            $('.change_password').click(function (event) {
                let id = {{ $data -> id }};
                ChangePassword(id);
            });
            $('.account_user_add_recipe').click(function (event) {
                let id = {{ $data -> id }};
                AddUserRecipe(id);
            });
            $('.account_user_program').click(function (event) {
                let id = {{ $data -> id }};
                UserProgramShow(id);
            });
        })

        function UserProgramShow(id){
            $.ajax({
                url: '{{ route('account.showProgram') }}',
                type: 'POST',
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('.account-page-right_menu-title_blocks').html('Мои купленные программы');
                    $('.account-page-right_menu-info').html(data.options);
                },
                error: (error) => {
                    console.log(JSON.stringify(error));
                }
            });
        }


        function AddUserRecipe(id){
            $.ajax({
                url: '{{ route('account.AddRecipeUserForm') }}',
                type: 'POST',
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('.account-page-right_menu-title_blocks').html('Добавление рецепта');
                    $('.account-page-right_menu-info').html(data.options);
                },
                error: (error) => {
                    console.log(JSON.stringify(error));
                }
            });
        }

        function ChangePhoto(id){
            $.ajax({
                url: '{{ route('account.changePhotoForm') }}',
                type: 'POST',
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('.account-page-right_menu-title_blocks').html('Изменение фотографии профиля');
                    $('.account-page-right_menu-info').html(data.options);
                },
                error: (error) => {
                    console.log(JSON.stringify(error));
                }
            });
        }

        function ChangePassword(id){
            $.ajax({
                url: '{{ route('account.changePasswordForm')}}',
                type: "POST",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('.account-page-right_menu-title_blocks').html('Изменение пароля');
                    $('.account-page-right_menu-info').html(data.options);
                }
            });
        }
    </script>
@endsection
