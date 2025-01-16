@extends('home')
@section('title', $program -> name)
@section('content')
    <div class="program_show_one container_content">
        <div class="h-program">
            Индивидуальная программа - 	&laquo;{{ $program -> name }}&raquo;
        </div>
        @if($program->old_price != null)
            <script>
                $(document).ready(function () {
                    let price = {{ $program -> price }};
                    let old_price = {{ $program -> old_price}};
                    let total = (((old_price/price)*100)-100).toFixed();
                    $('.program_price_info').html('Скидка ' + total + '%');
                })
            </script>
            <div class="program_price_info"></div>
        @endif

        {{--Проверка на то что куплена у пользователя программа или нет--}}
        @if(count($program->orders) > 0)
            @foreach($program->orders as $program_order)
                @if($program_order -> program -> id === $program -> id and $data->id === $program_order -> user -> id)
                    <div style="width: 20%;">
                        <span class="program_button">Программа уже куплена</span>
                    </div>
                @else
                    <form class="program_buy_form" action="{{ route('FormBuy') }}" method="POST">
                        @csrf
                        <input type="hidden" name="program_id" value="{{ $program->id }}">
                        <button type="submit" class="program_button" >Купить программу</button>
                        @if($program->old_price != null)
                            <div class="program_price">{{ $program -> price }} ₽</div>
                            <div class="program_old-price">{{ $program ->old_price }}</div>
                        @else
                            <div class="program_price">{{ $program -> price }} ₽</div>
                        @endif
                    </form>
                @endif
            @endforeach
        @else
            <form class="program_buy_form" action="{{ route('FormBuy') }}" method="POST">
                @csrf
                <input type="hidden" name="program_id" value="{{ $program->id }}">
                <button type="submit" class="program_button" >Купить программу</button>
                @if($program->old_price != null)
                    <div class="program_price">{{ $program -> price }} ₽</div>
                    <div class="program_old-price">{{ $program ->old_price }}</div>
                @else
                    <div class="program_price">{{ $program -> price }} ₽</div>
                @endif
            </form>
        @endif



        <div class="b-program">
            <div>Описание программы:</div>
            <div class="b-program_text-program">{{ $program -> description }}</div>
        </div>
        <div>
            <div class="about_program_style">Плюсы данной программы:</div>
            <div class="about_program_style_text">- Данная программа поможет Вам в осуществлении Вашей цели</div>
            <div class="about_program_style_text">- Подарит Вам незабываемые вкусовые впечатления и хороший результат</div>
        </div>
        <div class="consultation_text">Сомневаетесь в выборе программы? Проконсультируйтесь с нашим специалистом!</div>
        <div class="consultation_form">
            <div class="consultation_worker">
                <div class="circle9 photo_doc">
                </div>
                <div class="consultation_worker_name">Елена Румянцева</div>
                <div class="consultation_worker_about">Член ассоциации специалистов Prevent Ageмедицины, спортивный нутрициолог, член Национального общества диетологов.</div>
            </div>
            <form class="consultation_form_style" method="post">
                @csrf
                    <div class="consultation_row-input">
                        <label for="user_name" class="l-user_name">Ваше имя:</label>
                        <input id="user_name" class="i-user_name" type="text" name="user_name" placeholder="Иван">
                    </div>
                    <div class="consultation_row-input">
                        <label for="user_phone" class="l-user_phone">Ваше номер телефона:</label>
                        <input id="user_phone" class="i-user_phone" type="text" name="user_phone" placeholder="+7(900)123-45-67">
                    </div>
                    <div class="consultation_row-input consultation_rule">
                        <input type="checkbox" name="rules" checked>
                        <div>Я принимаю политику конфиденциальности</div>
                    </div>
                    <div class="consultation_row-input">
                        <button class="program_button" type="submit">Оставить заявку</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
