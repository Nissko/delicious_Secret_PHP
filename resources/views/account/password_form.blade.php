<link href="{{ asset( 'style/bootstrap/bootstrap.css' ) }}" rel="stylesheet">
<script src="{{ asset( 'js/bootstrap/bootstrap.min.js' ) }}"></script>
<link rel="stylesheet" href="{{ asset('style/account-new_password.css') }}">

<form id="change_password_form" action="{{ route('account.changePasswordLogic', $data->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-line">
        <label for="password" class="form-label fs-5">Введите новый пароль:</label>
        <input class="form-control" id="password" type="password" name="password" required>
        <div class="password_err"></div>
    </div>
    <div class="form-line">
        <label for="new_password" class="form-label fs-5">Повторите новый пароль:</label>
        <input class="form-control" id="new_password" type="password" name="new_password">
        <div class="password_err_new"></div>
    </div>
    <div>
        <div class="btn btn-outline-primary">Изменить</div>
        <div class="error_button"></div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#password').on('keyup', function(){
            if ($(this).val().length === 0){
                $('.password_err').html('Это поле обязательное')
                $(this).css('border', '2px solid red');
            } else if ($(this).val().length < 6){
                $('.password_err').html('Пароль должен быть больше 6 символов')
                $(this).css('border', '2px solid red');
            } else if ($(this).val().length > 20){
                $('.password_err').html('Пароль должен быть меньше 20 символов')
                $(this).css('border', '2px solid red');
            } else{
                $('.password_err').html('');
                $(this).css('border', '2px solid forestgreen');
            }
            if ($(this).val() !== $('#new_password').val()){
                $('.password_err_new').html('Пароли отличаются')
                $(this).css('border', '2px solid red');
            } else{
                $('.password_err_new').html('');
                $('#new_password').css('border', '2px solid forestgreen');
            }
        });
        $('#new_password').on('keyup', function(){
            if ($(this).val() !== $('#password').val()){
                $('.password_err_new').html('Пароли отличаются')
                $(this).css('border', '2px solid red');
            } else if ($(this).val().length < 6){
                $('.password_err_new').html('Пароль должен быть больше 6 символов')
                $(this).css('border', '2px solid red');
            } else if ($(this).val().length > 20){
                $('.password_err_new').html('Пароль должен быть меньше 20 символов')
                $(this).css('border', '2px solid red');
            } else{
                $('.password_err_new').html('');
                $(this).css('border', '2px solid forestgreen');
                $('#password').css('border', '2px solid forestgreen');
            }
        });
        /*Проверка после нажатия кнопки*/
        $('.account-file-btn-sub').click(function (event) {
            if($('#new_password').val() === $('#password').val() && $('#password').val().length >= 6 && $('#password').val().length <= 20){
                $( "#change_password_form" ).submit();
            }
            else{
                $('.error_button').html('Проверьте правильность введенных паролей!');
            }
        });
    });
</script>
