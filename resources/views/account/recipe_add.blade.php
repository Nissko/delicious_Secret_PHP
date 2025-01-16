<form class="form-control" action="{{ route('account.addRecipe', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="recipe-name" class="form-label">
            Название
        </label>
        <div>
            <input class="form-control" id="recipe-name" type="text" name="recipe_name" placeholder="Введите название рецепта" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="recipe-description" class="form-label">
            Описание
        </label>
        <div>
            <textarea class="form-control" id="recipe-description" name="recipe_description"  placeholder="Введите название рецепта" required rows="1"></textarea>
        </div>
    </div>

    <div class="mb-3">
        <label for="recipe-person" class="form-label">
            Количество персон
        </label>
        <div>
            <input class="form-control" min="1" max="99" id="recipe-person" type="number" name="recipe_person" placeholder="1" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="recipe-time" class="form-label">
            Время приготовления
        </label>
        <div>
            <input class="form-control" id="recipe-time" type="text" name="recipe_time" placeholder="Например: 1 час" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="recipe-calories" class="form-label">
            Калории
        </label>
        <div>
            <input class="form-control" min="1" max="9999" id="recipe-calories" type="number" name="recipe_calories" placeholder="300" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="recipe-img" class="form-label">
            Фото блюда(обложка)
        </label>
        <div>
            <input class="form-control" id="recipe-img" type="file" name="recipe_img" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="recipe-category" class="form-label">
            Категория блюда
        </label>
        <div>
            <select class="form-select" id="recipe-category" name="recipe_category" required>
                <option selected disabled>Выберите категорию:</option>
                @foreach($categories as $category)
                    <option value="{{ $category -> id }}">{{ $category -> name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label for="recipe-country" class="form-label">
            Кухня
        </label>
        <div>
            <select class="form-select" id="recipe-country" name="recipe_country" required>
                <option selected disabled>Выберите кухную:</option>
                @foreach($countries as $country)
                    <option value="{{ $country -> id }}">{{ $country -> name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="recipe_ingredients_block mt-5 mb-5">
        <h5 class="form-label">Ингридиенты:</h5>
        <div>
            <div>
                <div class="d-flex">
                    <div class="w-75">
                        <label for="recipe-ingredients" class="form-label">
                            Ингредиент
                        </label>
                        <input class="form-control rounded-0 rounded-start" type="text" id="recipe-ingredients" name="recipe_ingredients[]" placeholder="Укажите ингредиент">
                    </div>
                    <div class="w-25">
                        <label for="recipe-ingredients-qty" class="form-label">Количество</label>
                        <input class="form-control rounded-0 rounded-end" type="text" id="recipe-ingredients-qty" name="recipe_ingredients_qty[]" placeholder="5 шт">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-2"> {{-- Блок для добавления ингридиентов js --}}
            <div id="inputContainer">
                <div class="d-flex mb-2">
                    <div class="w-75">
                        <label class="form-label">
                            Ингредиент
                        </label>
                        <input class="form-control rounded-0 rounded-start" type="text" name="recipe_ingredients[]" placeholder="Укажите ингредиент">
                    </div>
                    <div class="w-25">
                        <label class="form-label">Количество</label>
                        <input class="form-control rounded-0 rounded-end" type="text" name="recipe_ingredients_qty[]" placeholder="5 шт">
                    </div>
                </div>

            </div>
        </div>
        <div class="d-flex justify-content-center pt-3">
            <span class="btn btn-outline-success text-center" id="addButtonI">Добавить ингридиент</span>
        </div>
    </div>

    <div class="steps_block mb-3">
        <h5 class="form-label">Шаги приготовления:</h5>
        <label for="recipe-steps-description" class="form-label">
            Шаг
        </label>
        <div>
            <textarea class="form-control" id="recipe-steps-description" name="recipe_steps_description[]" placeholder="Введите пояснение к шагу приготовления" rows="1" required></textarea>

            <label for="recipe-steps-img" class="form-label mt-2">Фото шага:</label>
            <div>
                <input class="form-control" type="file" id="recipe-steps-img" name="recipe_steps_img[]">
            </div>
        </div>
        <div class="mt-2"> {{-- Блок для добавления шагов js --}}
            <div id="inputContainerItemStep">
                <label for="recipe-steps-description" class="form-label">
                    Шаг
                </label>
                <div>
                    <textarea class="form-control" id="recipe-steps-description" name="recipe_steps_description[]" placeholder="Введите пояснение к шагу приготовления" rows="1" required></textarea>

                    <label for="recipe-steps-img" class="form-label mt-2">Фото шага:</label>
                    <div>
                        <input class="form-control" type="file" id="recipe-steps-img" name="recipe_steps_img[]" value=" ">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center pt-3">
                <span class="btn btn-outline-success text-center" id="addButtonS">Добавить шаг</span>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <button class="btn btn-primary">Добавить рецепт</button>
    </div>
</form>
<script>
    $(document).ready(function () {

        // Добавление нового input Ингредиенты
        $('#addButtonI').click(function() {
            var divAdd = $('<div class="d-flex flex-wrap" id="inputContainerItem"></div>');
            var divIngredient = $('<div id="inputContainerItemIngredient" class="w-75">');
            var divQty = $('<div id="inputContainerItemQty" class="w-25 mb-2">');
            var labelIngridient = $('<label class="form-label mt-2">Ингредиент</label>');
            var newInput = $('<input class="form-control rounded-0 rounded-start" type="text" name="recipe_ingredients[]" placeholder="Укажите ингредиент" />');
            var labelQty = $('<label class="form-label mt-2">Количество</label>');
            var newInputQty = $('<input class="form-control rounded-0 rounded-end" type="text" name="recipe_ingredients_qty[]" placeholder="5 шт">');
            $('#inputContainer').append(divAdd);
            $('#inputContainerItem').append(divIngredient);
            $('#inputContainerItem').append(divQty);
            $('#inputContainerItemIngredient').append(labelIngridient);
            $('#inputContainerItemIngredient').append(newInput);
            $('#inputContainerItemQty').append(labelQty);
            $('#inputContainerItemQty').append(newInputQty);
        });

        // Добавление нового input Ингредиенты
        $('#addButtonS').click(function() {
            var labelStep = $('<label for="recipe-steps-description" class="form-label mt-2">Шаг</label>');
            var newTextarea = $('<textarea class="form-control" id="recipe-steps-description" name="recipe_steps_description[]" placeholder="Введите пояснение к шагу приготовления" rows="1" required></textarea>');
            var labelPhoto = $('<label for="recipe-steps-img" class="form-label mt-2">Фото шага:</label>');
            var newInputPhoto = $('<input class="form-control" type="file" id="recipe-steps-img" name="recipe_steps_img[]">');
            $('#inputContainerItemStep').append(labelStep);
            $('#inputContainerItemStep').append(newTextarea);
            $('#inputContainerItemStep').append(labelPhoto);
            $('#inputContainerItemStep').append(newInputPhoto);
        });

        // Удаление последнего input Ингредиенты
        /*$('#inputContainer').on('click', 'input', function() {
            $(this).remove();
        });*/
    })
</script>

