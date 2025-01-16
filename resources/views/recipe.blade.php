@extends('home')
@section('title', 'Рецепты')
@section('content')
    <link href="{{ asset( 'style/recipe_style.css' ) }}" rel="stylesheet">
    <link href="{{ asset( 'style/bootstrap/bootstrap.css' ) }}" rel="stylesheet">
    <script src="{{ asset( 'js/bootstrap/bootstrap.min.js' ) }}"></script>

    <div class="foto1">
        <div class="block1 container_content">
            <div class="flower"><img src="{{asset('img/flower.png')}}" height="110px" width="110px"></div>
            <div class="name1"><span class="name1-text">Рецепты</span></div>
            <div class="receipt-text_desc"><span class="receipt-text_desc-text">Ищите рецепты, выбирая категорию блюда, его подкатегорию, кухню или меню. А в дополнительных фильтрах можно искать по нужному (или ненужному) ингредиенту: просто начните писать его название и сайт подберет соответствующий.</span></div>
        </div>
    </div>
    <div class="filter-receipt">
        <div class="filter-block_receipt container_content">
            <div class="filter-recipe">
                <div class="d-flex filter-recipe-style">
                    {{--Сортировать: по релевантности по популярности по дате добавления--}}
                    <div class="d-flex align-items-center filter-recipe-div">
                        <label class="fs-5" for="search_name_recide">Название: </label>
                        <input class="form-control" id="search_name_recide" type="text" name="search_name_recipe" placeholder="Название рецепта">
                    </div>
                    <div class="d-flex align-items-center filter-recipe-div">
                        <label class="fs-5" for="search_name_recide">Сортировка: </label>
                        <select class="form-select sort_param">
                            <option selected disabled>По умолчанию</option>
                            <option value="most_popular">Сначала популярные</option>
                            <option value="desc">Сначала новинки</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="filter-receipt-2">
        <div class="filter-block_receipt-2">
            <span class="filter-block_receipt_text-2">Фильтрация рецептов</span>
        </div>
    </div>

    <div class="output-receipt container_content">
        @foreach($recipe as $rec)
            <div class="output-block_receipt">

                {{--Вывод иконки ИЗБРАННОЕ--}}
                <div id="no_favorite-{{$rec->id}}" class="position-absolute favotite_recipe_block" title="Добавить в избранное">
                    <input class="recipe_id-{{$rec->id}}" type="hidden" name="recipe_id" value="{{ $rec->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-bookmark-heart" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"/>
                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                    </svg>
                </div>

                {{--Изменение иконки, если у пользователя рецепт в избранном--}}
                @foreach($rec -> favorites as $re)
                    @if($re -> user -> id === $data->id and $re -> recipe -> id === $rec -> id)
                        <a href="{{ route('favorite.index') }}" class="position-absolute favotite_recipe_block" title="В избранном">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-bookmark-heart-fill" viewBox="0 0 16 16">
                                <path d="M2 15.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v13.5zM8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"/>
                            </svg>
                        </a>
                    @endif
                @endforeach
                <div class="output-block-1_receipt">
                    <div>
                        <img src="{{ asset('storage/recipes/'.$rec -> img) }}" width="550" alt="Обложка рецепта">
                    </div>
                    <div class="fs-5">Оценка пользователей:</div>
                    <div class="rating-result">
                        @foreach($rec -> rate as $rate)
                            <?php $rates += $rate->value_rate ?>
                        @endforeach
                        <?php
                            //если есть несколько оценок, то ищем AVG
                            if ($rates > 0){
                                $rates = round($rates / count($rec -> rate), 0);
                            }
                        ?>
                        @for($i = 1; $i <= 5; $i++)
                            @if($rates > 0)
                                <span class="active"></span>
                                    <?php $rates--; ?>
                            @else
                                <span></span>
                            @endif
                        @endfor
                            <container class="count_rate_users">({{ count($rec -> rate) }})</container>
                    </div>
                </div>
                <div class="output-block-2_receipt">
                    <div class="output-block-2_info">
                        <div>
                            <a href="{{ route('showRecipe', $rec -> id) }}">
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
            {{ $recipe->links() }}
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(document).ready(function() {
                $('.filter-block_receipt-2').click(function() {
                    $(this).toggleClass('open');
                    $('.filter-recipe').slideToggle();
                });
            });

            $("#search_name_recide").on("change", function() {
                let value = $(this).val();
                SearchRecipes(value);
            });

            $(".sort_param").on("change", function() {
                let value = $(this).val();
                SortParam(value);
            });

            for(let i = 0; i <= 99; i++)
            {
                $("#no_favorite-"+i).on("click", function() {
                    let recipe_id = $(".recipe_id-"+i).val();
                    let user_id = {{ $data -> id }}
                    AddFavorite(recipe_id, user_id);
                });
            }
        });

        function AddFavorite(recite_id, user_id){
            $.ajax({
                url: '{{ route('favorite.store') }}',
                type: 'POST',
                data: {
                    recipe:recite_id,
                    user:user_id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $(".content").html(window.location.href = '/recipe');
                },
                error: (error) => {
                    console.log(JSON.stringify(error));
                }
            });
        }

        function SearchRecipes(value){
            $.ajax({
                url: '{{ route('search') }}',
                type: 'GET',
                data: {
                    value: value,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('.output-receipt').html(data.options);
                },
                error: (error) => {
                    console.log(JSON.stringify(error));
                }
            });
        }

        function SortParam(value){
            $.ajax({
                url: '{{ route('sort_param') }}',
                type: 'GET',
                data: {
                    value: value,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('.output-receipt').html(data.options);
                },
                error: (error) => {
                    console.log(JSON.stringify(error));
                }
            });
        }
    </script>
@endsection
