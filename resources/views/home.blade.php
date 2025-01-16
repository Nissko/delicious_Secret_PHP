@section('content')
    <div class="foto1">
        <div class="block1 container_content">
            <div class="flower"><img src="{{asset('img/flower.png')}}" height="110px" width="110px"></div>
            <div class="name1"><span class="name1-text">Подбери свой план питания</span></div>
            <div class="name2"><span class="name2-text">Заполни свои данные в специальную форму</span></div>
            <div class="block2 container_content">
                <div class="block2-row1">
                    <div class="name3"><p>Парамерты</p></div>
                    <div class="name3"><p>Цель</p></div>
                    <div class="name3"><p>Активность</p></div>
                </div>
                <div class="block2-row2">
                    <div class="circle1"><img src="{{asset('img/apple.png')}}" height="80px" width="80px"></div>
                    <div class="circle2"><img src="{{asset('img/star.png')}}" height="80px" width="80px"></div>
                    <div class="circle3"><img src="{{asset('img/fitness.png')}}" height="80px" width="80px"></div>
                </div>
            </div>
        </div>
        <div class="block3 container_content">
            <div class="block3-row1">
                <div><p>ПОДРОБНЕЕ</p></div>
            </div>
        </div>
    </div>
    <div class="foto2">
        <div class="animation1 container_content">
            <div class="text"><p><b class="text-b">Вкусный секрет</b> - это профессиональный сервис<br>по составлению планов питания,<br> а также объединению людей в сообщества<br>по приготовлению вкусных блюд.</p></div>
            <div class="fotochka">
                <div class="circle4"></div>
                <div class="circle5"></div>
                <div class="circle6"></div>

                <div class="dop">
                    <div class="circle_dop1"></div>
                    <div class="circle_dop2"></div>
                    <div class="circle_dop3"></div>
                </div>

            </div>
        </div>
        <div class="animation2 container_content">
            <div class="text"><p><b class="text-b">Индивидуальный план</b> - Вы вводите свои данные в специальную форму.<br>На основе этого, Вам выдаются программы.<br>Ваша программа корректируется под наблюдением врача диетолога.</p></div>
            <div class="fotochka2">
                <img class="fotochka2-img" src="{{asset('img/salad.png')}}" width="400">
            </div>
        </div>

    </div>
{{--    <div class="animation3 container_content">
        <div class="text"><p><b class="text-b">Экономия времени</b> - больше не нужно тратить часы на составление плана вручную.</p></div>
    </div>--}}
    <div class="foto3">
        <div class="team_block">
            <div class="team-row1 container_content">
                <span class="team-legend-text">МЫ - КОМАНДА!</span>
                <div class="team_block_circle">
                    <div class="circle7"></div>
                    <div class="circle8"></div>
                    <div class="circle9"></div>
                </div>

                <div class="team-row2">
                    <div class="team-row2-text">Калашникова Вероника</div>
                    <div class="team-row2-text">Горелов Юрий</div>
                    <div class="team-row2-text">Овсянникова Дарья</div>
                </div>

                <div class="team-row3">
                    <div class="team-row3-text">Менеджер</div>
                    <div class="team-row3-text">Основатель</div>
                    <div class="team-row3-text">Доктор</div>
                </div>
            </div>

        </div>
    </div>

    <div class="FAQ">
        <div class="FAQ_block container_content">
            <div class="FAQ-row1"><p>FAQ</p></div>
            <div class="faq-block-details">
                <details>
                    <summary>Делаете ли вы программы для людей с заболеваниями?</summary>
                    <em><strong>Нет, наш сайт не предназначен для создания рациона питания для людей с острым течением заболеваний.</strong></em>
                </details>
            </div>
            <div class="faq-block-details">
                <details>
                    <summary>Делаете ли вы программы для вегетарианцев?</summary>
                    <em><strong>Да, здесь Вы можете найти для себя рацион питания для вегетарианцев. Более того, вы сможете выбрать для себя нужный рацион по калорийности.</strong></em>
                </details>
            </div>
            <div class="faq-block-details">
                <details>
                    <summary>Возможен ли быстрый результат от программ?</summary>
                    <em><strong>Наша задача заключается не в быстром результате, а в качественном и правильном подходе. Если соблюдать все требования и не отклоняться от Вами поставленной задачи, то Вы обязательно достигните результата.</strong></em>
                </details>
            </div>
            <div class="faq-block-details">
                <details>
                    <summary>Есть ли у вас скидки на программы?</summary>
                    <em><strong>На наши программы есть скидки, правда только по праздничным дням. Не пропустите!</strong></em>
                </details>
            </div>
        </div>
    </div>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Вкусный секрет | @yield('title', 'Главная')</title>
    <link rel="stylesheet" href="{{asset('style/style.css')}}">
    <link rel="stylesheet" href="{{asset('style/menu_style.css')}}">
    <script src="{{ asset('js/jquery-3.6.3.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400&display=swap" rel="stylesheet">
</head>
<body>
        <div class="content">
            <nav class="menu_container">
                <div class="header container_content">
                    <div class="text-tab">
                        <a href="{{ route('indexRecipe') }}"><div class="btn_menu"><p>Рецепты</p></div></a>
                        <a href="{{route('indexIdea')}}"><div class="btn_menu"><p>Идеи</p></div></a>
                        <a href="{{ route('indexProgram') }}"><div class="btn_menu"><p>Программы</p></div></a>
                    </div>

                    <a href="{{ route('indexHome') }}"><div class="logo_header">
                        <div class="img_logo"></div>
                    </div></a>

                    <div class="icons">
                        <a href="{{ route('favorite.index') }}" class="favorite-ico">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-bookmark-heart" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"/>
                                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                            </svg>
                        </a>
                        <div class="search_img"><img src="{{asset('img/search.png')}}" height="50px" width="50px"></div>
                        <div>
                            <div class="menu-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <main class="main-content">
                <div class="container_content">
                    <div class="burger_style">
                        @if($data -> role == 'Гость')
                            <a href="{{ route('login') }}">Вход</a>
                            <a href="{{ route('registration') }}">Регистрация</a>
                        @endif
                        @if($data -> role == 'user' or $data -> role == 'admin')
                            <a href="{{ route('indexAccount') }}">Личный кабинет</a>
                            <a href="{{ route('logout') }}">Выход</a>
                        @endif
                    </div>
                </div>
                @yield('content')
            </main>
            <footer class="container_footer">
                <div class="footer_content">
                    <div class="logo_footer">
                    </div>
                    <div class="contact">
                        <div class="contact_btn">Наши контакты</div>
                        <div class="contact_btn">Телефон: 89515595321</div>
                        <div class="contact_btn">Почта: delicious.secret@inbox.ru</div>
                    </div>
                    <div class="network">
                        <div>Наши социальные сети</div>
                        <div class="one"><img src="{{asset('img/vk.png')}}" height="30px" width="30px"></div>
                        <div class="two"><img src="{{asset('img/tiktok.png')}}" height=30px" width="30px"></div>
                    </div>
                </div>
            </footer>
        </div>
</body>
<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $('.menu-icon').click(function() {
                $(this).toggleClass('open');
                $('.burger_style').slideToggle();
            });
        });
    });
</script>
</html>
