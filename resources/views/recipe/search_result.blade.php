@if ($results->isEmpty())
    <div class="fs-4 pt-4 pb-4">Нет рецептов по запросу "{{$query}}".</div>
@else
    <div class="fs-4 pt-4">Найденные рецепты:</div>
    @foreach($results as $rec)
        <div class="output-block_receipt">
            <div class="output-block-1_receipt">
                <div>
                    <img src="{{asset('storage/recipes/'.$rec -> img) }}" width="550" alt="Обложка рецепта">
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
                        Ингридиенты
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
@endif
