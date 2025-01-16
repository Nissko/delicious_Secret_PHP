@extends('home')
@section('title', 'Админ-панель - Редактирование программ')
@section('content')
    <link href="{{ asset( 'style/bootstrap/bootstrap.css' ) }}" rel="stylesheet">
    <script src="{{ asset( 'js/bootstrap/bootstrap.min.js' ) }}"></script>
    <link rel="stylesheet" href="{{ asset('style/account_style.css') }}">
    <div class="container_content main_account min-vh-100">
        <div class="fs-4 fw-bold pb-4">Редактирование программ</div>
        {{--Добавление программы--}}
        <div class="mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Добавить программу
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Редактирование программы</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.program.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body text-start">
                                {{--Название--}}
                                <label class="form-label text-start">Название</label>
                                <input type="text" class="form-control mb-2" name="name" value="">
                                {{----}}

                                {{--Описание--}}
                                <label class="form-label text-start">Описание</label>
                                <textarea class="form-control mb-2" name="description" rows="1"></textarea>
                                {{----}}

                                {{--Срок действия--}}
                                <label class="form-label text-start">Срок действия</label>
                                <input class="form-control mb-2" type="number" name="day" min="1" max="30" value="">
                                {{----}}

                                {{--Калории--}}
                                <label class="form-label text-start">Калорийность</label>
                                <input class="form-control mb-2" type="number" name="calories" value="">
                                {{----}}

                                {{--Актуальная цена--}}
                                <label class="form-label text-start">Стоимость</label>
                                <input class="form-control mb-2" type="number" name="price" value="">
                                {{----}}

                                {{--Старая цена(без скидки)--}}
                                <label class="form-label text-start">Цена до акции</label>
                                <input class="form-control mb-2" type="number" name="old_price" min="1" value="">
                                {{----}}

                                {{--Файл программы--}}
                                <label class="form-label text-start">Файл с программой</label>
                                <input class="form-control mb-2" type="file" name="program_file" required>
                                {{----}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{----}}
        @foreach($programs as $program)
            <div class="card text-center mb-5">
                <div class="card-header">
                    Программа
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $program -> name }}</h5>
                    <p class="card-text text-start">{{ $program -> description }}</p>
                    {{--Изменение программы--}}
                    <div class="">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $program -> id }}">
                            Редактировать информацию
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop{{ $program -> id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Редактирование программы</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.program.update', $program -> id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body text-start">
                                            {{--Название--}}
                                            <label class="form-label text-start">Название</label>
                                            <input type="text" class="form-control mb-2" name="name" value="{{ $program -> name }}">
                                            {{----}}

                                            {{--Описание--}}
                                            <label class="form-label text-start">Описание</label>
                                            <textarea class="form-control mb-2" name="description" rows="2">{{ $program -> description }}</textarea>
                                            {{----}}

                                            {{--Срок действия--}}
                                            <label class="form-label text-start">Срок действия</label>
                                            <input class="form-control mb-2" type="number" name="day" min="1" max="30" value="{{ $program -> day }}">
                                            {{----}}

                                            {{--Калории--}}
                                            <label class="form-label text-start">Калорийность</label>
                                            <input class="form-control mb-2" type="number" name="calories" value="{{ $program -> calories }}">
                                            {{----}}

                                            {{--Актуальная цена--}}
                                            <label class="form-label text-start">Стоимость</label>
                                            <input class="form-control mb-2" type="number" name="price" value="{{ $program -> price }}">
                                            {{----}}

                                            {{--Старая цена(без скидки)--}}
                                            <label class="form-label text-start">Цена до акции</label>
                                            <input class="form-control mb-2" type="number" name="old_price" min="1" value="{{ $program -> old_price }}">
                                            {{----}}

                                            {{--Файл программы--}}
                                            <label class="form-label text-start">Файл с программой</label>
                                            <input class="form-control mb-2" type="file" name="program_file">
                                            {{----}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                            <button type="submit" class="btn btn-primary">Изменить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{----}}
                </div>
                <div class="card-footer text-muted">
                    Дата добавления - {{ $program -> created_at -> format('d.m.Y') }}
                </div>
            </div>
        @endforeach
    </div>
@endsection
