@extends('home')
@section('content')
    <link href="{{ asset( 'style/bootstrap/bootstrap.css' ) }}" rel="stylesheet">
    <script src="{{ asset( 'js/bootstrap/bootstrap.min.js' ) }}"></script>
    <link href="{{ asset( 'style/program_style.css' ) }}" rel="stylesheet">
    <div class="recipe_block1">
        <div class="recipe_name1">Расчет программы</div>
        <div class="recipe_block_one container_content">
            <div class="program-first_block">
                <div class="square1">
                    <div class="mb-2">
                        <label for="gender" class="fs-4">Пол:</label>
                        <select id="gender" class="gender form-select">
                            <option value="male">Мужчина</option>
                            <option value="female">Женщина</option>
                        </select>
                    </div>
                    <div class="high_mass d-flex mb-2">
                        <div class="h w-50">
                            <label for="height" class="fs-4">Рост:</label>
                            <input class="form-control" type="number" id="height" placeholder="Введите ваш рост (см)">
                        </div>
                        <div class="m w-50">
                            <label for="weight" class="fs-4">Вес:</label>
                            <input class="form-control" type="number" id="weight" placeholder="Введите ваш вес (кг)">
                        </div>
                    </div>
                    <div class="high_mass d-flex mb-1">
                        <div class="w-25">
                            <label for="weight" class="fs-4">Возраст:</label>
                            <input class="form-control" type="number" id="age" placeholder="Возраст">
                        </div>
                        <div class="w-75">
                            <label for="weight" class="fs-4">Тренировки:</label>
                            <select id="activity-level" class="form-select">
                                <option value="1.2">Минимальная активность (сидячий образ жизни)</option>
                                <option value="1.375">Низкая активность (1-2 тренировки в неделю)</option>
                                <option value="1.55">Средняя активность (3-5 тренировок в неделю)</option>
                                <option value="1.725">Высокая активность (6-7 тренировок в неделю)</option>
                                <option value="1.9">Очень высокая активность (тяжелая физическая работа или тренировки 2 раза в день)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="recipe_btn container_content">
                    <button class="recipe_btn-input" id="calculate-button" type="submit">Рассчитать</button>
                </div>
            </div>


            <div class="recipe_block2">
                <div class="recipe_block_two container_content">
                    <div class="recipe_name2">Вам могут подойти такие программы</div>
                    <div class="square2" id="result">

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Функция для расчета дневной нормы калорий
        function calculateCalories(gender, weight, height, age, activityLevel) {
            var bmr;
            if (gender === 'male') {
                bmr = 88.36 + (13.4 * weight) + (4.8 * height) - (5.7 * age);
            } else if (gender === 'female') {
                bmr = 447.6 + (9.2 * weight) + (3.1 * height) - (4.3 * age);
            }
            var tdee = bmr * activityLevel;
            return tdee;
        }

        // Функция для вывода результата
        function displayResult() {
            var gender = $('#gender').val();
            var weight = $('#weight').val();
            var height = $('#height').val();
            var age = $('#age').val();
            var activityLevel = $('#activity-level').val();

            var calories = calculateCalories(gender, weight, height, age, activityLevel);
            /*$('#result').text('Ваша дневная норма калорий: ' + calories.toFixed() + ' ккал.');*/

            return displayProgram(calories);
        }

        // Обработчик события для кнопки "Рассчитать"
        $('#calculate-button').click(displayResult);

        function displayProgram(calories){
            console.log(calories);
            $.ajax({
                url: '{{ route('showProgram') }}',
                type: "POST",
                data: {
                    calories: calories,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $("#result").html(data.options);
                }
            });
        }
    </script>
@endsection
