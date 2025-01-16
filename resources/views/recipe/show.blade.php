@extends('home')
@section('content')
    <link rel="stylesheet" href="{{ asset('style/recipe_show_style.css') }}">
    <link href="{{ asset( 'style/bootstrap/bootstrap.css' ) }}" rel="stylesheet">
    <script src="{{ asset( 'js/bootstrap/bootstrap.min.js' ) }}"></script>
    <div class="header-receipt_legend">
        {{$recipe_show -> name}}
    </div>

    <div class="output-receipt container_content">
        <div class="output-block_receipt">
            {{--Вывод иконки ИЗБРАННОЕ--}}
            <div id="no_favorite-{{$recipe_show->id}}" class="position-absolute favotite_recipe_block" title="Добавить в избранное">
                <input class="recipe_id-{{$recipe_show->id}}" type="hidden" name="recipe_id" value="{{ $recipe_show->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-bookmark-heart" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"/>
                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                </svg>
            </div>

            {{--Изменение иконки, если у пользователя рецепт в избранном--}}
            @foreach($recipe_show -> favorites as $re)
                @if($re -> user -> id === $data->id and $re -> recipe -> id === $recipe_show -> id)
                    <a href="{{ route('favorite.index') }}" class="position-absolute favotite_recipe_block" title="В избранном">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-bookmark-heart-fill" viewBox="0 0 16 16">
                            <path d="M2 15.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v13.5zM8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"/>
                        </svg>
                    </a>
                @endif
            @endforeach
            <div class="output-block-1_receipt">
                <div>
                    <img src="{{asset('storage/recipes/'. $recipe_show -> img)}}" width="550" alt="Обложка рецепта">
                </div>
                @if($data->role === 'user' or $data->role === 'admin')
                    @if(count($rates_user) > 0)
                        <div class="fs-5">Оценка пользователей:</div>
                        <div class="rating-result">
                            @for($i = 1; $i <= 5; $i++)
                                @if($rates > 0)
                                    <span class="active"></span>
                                    <?php $rates--; ?>
                                @else
                                    <span></span>
                                @endif
                            @endfor
                        </div>
                    @else
                        <div class="fs-5">Оставьте свое мнение:</div>
                        <form class="rating-area" action="{{ route('AddRate', $recipe_show -> id) }}" method="post">
                            @csrf
                            <input type="radio" id="star-5" name="rating" value="5">
                            <label for="star-5" title="Оценка «5»"></label>
                            <input type="radio" id="star-4" name="rating" value="4">
                            <label for="star-4" title="Оценка «4»"></label>
                            <input type="radio" id="star-3" name="rating" value="3">
                            <label for="star-3" title="Оценка «3»"></label>
                            <input type="radio" id="star-2" name="rating" value="2">
                            <label for="star-2" title="Оценка «2»"></label>
                            <input type="radio" id="star-1" name="rating" value="1">
                            <label for="star-1" title="Оценка «1»"></label>
                        </form>
                    @endif
                @else
                    <div class="fs-5">Оценка пользователей:</div>
                    <div class="rating-result">
                        @for($i = 1; $i <= 5; $i++)
                            @if($rates > 0)
                                <span class="active"></span>
                                    <?php $rates--; ?>
                            @else
                                <span></span>
                            @endif
                        @endfor
                    </div>
                @endif
            </div>
            <div class="output-block-2_receipt">
                <div class="output-block-2_info">
                    <div>
                        <div class="output-block-2_info-name_receipt">
                            {{ $recipe_show -> name }}
                        </div>
                        <div class="output-block-2_info-name_author">
                            Автор : {{ $recipe_show -> user -> last_name }} {{ $recipe_show -> user -> first_name }}
                        </div>
                    </div>
                    <div>
                        <div class="output-block-2_info-count_prod">
                            <img src="{{ asset('img/dinner.png') }}" height="50">{{ $recipe_show -> person }} порций
                        </div>
                        <div class="output-block-2_info-time_cook">
                            <img src="{{ asset('img/clock.png') }}" height="50">{{ $recipe_show -> time }}
                        </div>
                    </div>
                </div>
                <div class="output-block-2_info-ingredients">
                    <div class="output-block-2_info-ingredients_legend">
                        Ингредиенты
                    </div>
                    @foreach ($recipe_show -> ingredients as $ingredient)
                        <div class="output-block-2_info-ingredients_slot">
                            {{ $ingredient->name }}
                            <div>{{ $ingredient -> qty }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="output-receipt_step container_content">
            <span class="output-receipt_step-legend">Инструкция приготовления</span>

            @foreach ($recipe_show -> staps as $step)
                <div class="output-receipt_step-block">
                    <div class="output-receipt_step-block_img">
                        @if($step->step_img)
                            <img src="{{ asset('storage/recipes/steps/'. $step -> step_img) }}" width="450">
                        @endif
                    </div>
                    <div class="output-receipt_step-block_text"><b>{{$step -> step_number}}.</b> {{$step -> description}}</div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        $(document).ready(function() {
            for(let i = 0; i <= 99; i++)
            {
                $("#no_favorite-"+i).on("click", function() {
                    let recipe_id = $(".recipe_id-"+i).val();
                    let user_id = {{ $data -> id }};
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
                    window.location.href = '/recipe'+'/'+{{ $recipe_show -> id }};
                },
                error: (error) => {
                    console.log(JSON.stringify(error));
                }
            });
        }
    </script>
    <script>
        $(".rating-area").on("click", function(){
            $( ".rating-area" ).trigger( "submit" );
        });
    </script>

@endsection
