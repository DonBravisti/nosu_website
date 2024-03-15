@extends('layout.layout')
@section('content')
    <style>
        .action__link {
            display: block;
            background-color: rgba(30, 84, 193, 1);
            border-radius: 10px;
            padding: 5px;
            text-align: center;
            width: fit-content;
        }

        .action__link p {
            color: white;
        }
    </style>

    <section>
        <a class="action__link" href="/create-user">
            <p>Создать сотрудника</p>
        </a>
        <div>
            @foreach ($empls as $empl)
                <p>{{ $empl->FIO() }}</p>
            @endforeach
        </div>
    </section>
@endsection
