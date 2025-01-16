<div>
    @foreach($program as $prog)
        <a href="{{ route('showOneProgram', $prog->id) }}" class="div_program">
            <div class="name_program">
                Программа {{ $prog -> name }}
            </div>
            <div class="energy_program"> Калории: {{ $prog -> calories }}</div>
        </a>
    @endforeach
</div>
