@extends('home')
@section('title', 'Избранное')
@section('content')
    <link href="{{ asset( 'style/bootstrap/bootstrap.css' ) }}" rel="stylesheet">
    <script src="{{ asset( 'js/bootstrap/bootstrap.min.js' ) }}"></script>
    <link href="{{ asset( 'style/favorite_style.css' ) }}" rel="stylesheet">
    <div class="min-vh-100 output-receipt container_content">
        @if(count($favorites) > 0)
            <div class="fs-2 pt-3">Ваши избранные рецепты:</div>
            @foreach($favorites as $favorite)
            <div class="output-block_receipt">
                @if($favorite -> user -> id === $data->id)
                    <form action="{{ route('favorite.destroy') }}" method="post" class="position-absolute favotite_recipe_block" title="Удалить из избранного">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="favorite_id" value="{{ $favorite -> id }}">
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-bookmark-heart-fill" viewBox="0 0 16 16">
                                <path d="M2 15.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v13.5zM8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"/>
                            </svg>
                        </button>
                    </form>
                @endif
                <div class="output-block-1_receipt">
                    <div>
                        <img src="{{ asset('storage/recipes/'.$favorite -> recipe -> img) }}" width="550" alt="Обложка рецепта">
                    </div>
                    <div class="fs-5">Оценка пользователей:</div>
                    <div class="rating-result">
                        <?php $rates = 0; ?>
                        @foreach($favorite -> recipe -> rate as $rate)
                                <?php $rates += $rate->value_rate ?>
                        @endforeach
                            <?php
                            //если есть несколько оценок, то ищем AVG
                            if ($rates > 0){
                                $rates = round($rates / count($favorite -> recipe -> rate), 0);
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
                        <container class="count_rate_users">({{ count($favorite -> recipe -> rate) }})</container>
                    </div>
                </div>
                <div class="output-block-2_receipt">
                    <div class="output-block-2_info">
                        <div>
                            <a href="{{ route('showRecipe', $favorite -> recipe -> id) }}">
                                <div class="output-block-2_info-name_receipt">
                                    {{ $favorite -> recipe -> name }}
                                </div>
                            </a>
                            <div class="output-block-2_info-name_author">
                                Автор : {{ $favorite -> recipe -> user -> last_name }} {{ $favorite -> recipe -> user -> first_name }}
                            </div>
                        </div>
                        <div>
                            <div class="output-block-2_info-count_prod">
                                <img src="{{ asset('img/dinner.png') }}" height="50">{{ $favorite -> recipe -> person }} порций
                            </div>
                            <div class="output-block-2_info-time_cook">
                                <img src="{{ asset('img/clock.png') }}" height="50">{{ $favorite -> recipe -> time }}
                            </div>
                        </div>
                    </div>
                    <div class="output-block-2_info-ingredients">
                        <div class="output-block-2_info-ingredients_legend">
                            Ингредиенты
                        </div>
                        @foreach ($favorite -> recipe->ingredients as $ingredient)
                            <div class="output-block-2_info-ingredients_slot">
                                {{ $ingredient->name }}
                                <div>{{ $ingredient -> qty }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
        @else
            <div class="pt-5">
                <div class="alert alert-warning fs-2">
                    Список пуст! Добавьте рецепты в избранное во вкладке "РЕЦЕПТЫ".
                </div>
            </div>
        @endif
    </div>
@endsection
