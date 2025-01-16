<form action="{{ route('account.changePhotoLogic', $data->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <label class="account-file">
        <input class="form-control" type="file" name="photo" required>
        <span class="btn btn-success">Выберите файл</span>
        <span class="account-file-text">Максимум 10мб</span>
    </label>
    <div>
        <button class="btn btn-outline-primary mt-3 account-btn" type="submit">Выполнить</button>
    </div>
</form>

<script>
    $('.account-file input[type=file]').on('change', function(){
        let file = this.files[0];
        $(this).closest('.account-file').find('.account-file-text').html(file.name);
    });
</script>
