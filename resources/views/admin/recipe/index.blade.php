@extends('home')
@section('title', 'Админ-панель - Редактирование рецептов')
@section('content')
    <link href="{{ asset( 'style/bootstrap/bootstrap.css' ) }}" rel="stylesheet">
    <script src="{{ asset( 'js/bootstrap/bootstrap.min.js' ) }}"></script>
    <link rel="stylesheet" href="{{ asset('style/account_style.css') }}">
    <div class="container_content min-vh-100">
        <div class="fs-4 fw-bold pt-4 pb-4">Редактирование рецептов</div>
        {{--Добавление рецепта--}}
        <container>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Добавить рецепт
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Добавление рецепта</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.recipe.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <container>
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
                                </container>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </container>
        {{----}}

        @foreach($recipes as $rec)
            <div class="output-block_receipt">
                <div class="output-block-1_receipt">
                    <div>
                        <img src="{{ asset('storage/recipes/'.$rec -> img) }}" width="550" alt="Обложка рецепта">
                    </div>
                    <div class="mt-4">
                        {{--Редактирование рецепта--}}
                        <container>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $rec -> id }}">
                                Редактировать рецепт
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop{{ $rec -> id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Редактирование рецепта</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.recipe.update') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <container>
                                                    <div class="mb-3">
                                                        <input type="hidden" name="id" value="{{ $rec -> id }}">
                                                        <label for="recipe-name" class="form-label">
                                                            Название
                                                        </label>
                                                        <div>
                                                            <input class="form-control" id="recipe-name" type="text" name="name" value="{{ $rec -> name }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="recipe-description" class="form-label">
                                                            Описание
                                                        </label>
                                                        <div>
                                                            <textarea class="form-control" id="recipe-description" name="description"  placeholder="Введите название рецепта" required rows="1">{{ $rec -> description }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="recipe-person" class="form-label">
                                                            Количество персон
                                                        </label>
                                                        <div>
                                                            <input class="form-control" min="1" max="99" id="recipe-person" type="number" name="person" value="{{ $rec -> person }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="recipe-time" class="form-label">
                                                            Время приготовления
                                                        </label>
                                                        <div>
                                                            <input class="form-control" id="recipe-time" type="text" name="time" value="{{ $rec -> time }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="recipe-calories" class="form-label">
                                                            Калории
                                                        </label>
                                                        <div>
                                                            <input class="form-control" min="1" max="9999" id="recipe-calories" type="number" name="calories" value="{{ $rec -> calories }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="recipe-img" class="form-label">
                                                            Фото блюда(обложка)
                                                        </label>
                                                        <div>
                                                            <input class="form-control" id="recipe-img" type="file" name="img">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="recipe-category" class="form-label">
                                                            Категория блюда
                                                        </label>
                                                        <div>
                                                            <select class="form-select" id="recipe-category" name="category" required>
                                                                <option selected disabled>{{ $rec -> Category -> name }}</option>
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
                                                            <select class="form-select" id="recipe-country" name="country" required>
                                                                <option selected disabled>{{ $rec -> Country -> name }}</option>
                                                                @foreach($countries as $country)
                                                                    <option value="{{ $country -> id }}">{{ $country -> name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="recipe-status" class="form-label">
                                                            Статус
                                                        </label>
                                                        <div>
                                                            <select class="form-select" id="recipe-status" name="status" required>
                                                                <option selected disabled>{{ $rec -> status }}</option>
                                                                <option value="Опубликован">Опубликован</option>
                                                                <option value="На проверке">На проверке</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </container>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                                <button type="submit" class="btn btn-primary">Изменить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </container>
                        {{----}}
                    </div>
                    <div class="mt-4">
                        {{--Редактирование ингредиента--}}
                        <container>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#IstaticBackdrop{{ $rec -> id }}">
                                Редактировать ингредиенты
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="IstaticBackdrop{{ $rec -> id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Редактирование ингредиентов</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.recipe.ingredient.update') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                @foreach($rec -> ingredients as $ing)
                                                <div class="mt-1 mb-2">
                                                    <input type="hidden" name="ingrediend_id[]" value="{{ $ing -> id }}">
                                                    <div class="d-flex">
                                                        <div class="w-75">
                                                            <input type="hidden" name="recipe_id" value="{{ $rec -> id }}">
                                                            <label for="recipe-ingredients" class="form-label">
                                                                Ингредиент
                                                            </label>
                                                            <input class="form-control rounded-0 rounded-start" type="text" id="recipe-ingredients" name="recipe_ingredients[]" value="{{ $ing -> name }}">
                                                        </div>
                                                        <div class="w-25">
                                                            <label for="recipe-ingredients-qty" class="form-label">Количество</label>
                                                            <input class="form-control rounded-0 rounded-end" type="text" id="recipe-ingredients-qty" name="recipe_ingredients_qty[]" value="{{ $ing -> qty }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                                <button type="submit" class="btn btn-primary">Изменить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </container>
                        {{----}}
                    </div>
                    <div class="mt-4">
                        {{--Редактирование шагов--}}
                        <container>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#StstaticBackdrop{{ $rec -> id }}">
                                Редактировать шаги
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="StstaticBackdrop{{ $rec -> id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Редактирование шагов</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.recipe.step.update') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                @foreach($rec -> staps as $step)
                                                    <input type="hidden" name="step_id[]" value="{{ $step -> id }}">
                                                    <div class="mt-1 mb-2">
                                                        <label for="recipe-steps-description" class="form-label">
                                                            Шаг {{ $step->step_number }}
                                                        </label>
                                                        <div>
                                                            <textarea class="form-control" id="recipe-steps-description" name="recipe_steps_description[]" placeholder="Введите пояснение к шагу приготовления" rows="1" required>{{ $step -> description }}</textarea>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                                <button type="submit" class="btn btn-primary">Изменить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </container>
                        {{----}}
                    </div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-danger">
                            Удалить рецепт
                        </button>
                    </div>
                </div>
                <div class="output-block-2_receipt">
                    <div class="output-block-2_info">
                        <div>
                            <a>
                                <div class="output-block-2_info-name_receipt">
                                    {{ $rec -> name }}
                                </div>
                            </a>
                            <div class="output-block-2_info-name_author">
                                Автор : {{ $rec -> user -> last_name }} {{ $rec -> user -> first_name }}
                            </div>
                        </div>
                        <div>
                            <div class="output-block-2_info-count_prod">
                                <img src="{{ asset('img/dinner.png') }}" height="50">{{ $rec -> person }} порций
                            </div>
                            <div class="output-block-2_info-time_cook">
                                <img src="{{ asset('img/clock.png') }}" height="50">{{ $rec -> time }}
                            </div>
                        </div>
                    </div>
                    <div class="output-block-2_info-ingredients">
                        <div class="output-block-2_info-ingredients_legend">
                            Ингредиенты
                        </div>
                        @foreach ($rec->ingredients as $ingredient)
                            <div class="output-block-2_info-ingredients_slot">
                                {{ $ingredient->name }}
                                <div>{{ $ingredient -> qty }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
        <div class="d-flex flex-column align-items-center justify-content-center">
            {{ $recipes->links() }}
        </div>
    </div>

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
@endsection
