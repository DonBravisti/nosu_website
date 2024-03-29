@extends('layout.layout')
@section('content')
    <style>
        .actions {
            display: flex;
            justify-content: space-evenly;
            margin: 150px 0;
        }

        .action__link {
            background-color: rgba(30, 84, 193, 1);
            border-radius: 10px;
            padding: 5px;
            text-align: center;
        }

        .action__link p {
            color: white;
        }
    </style>

    <section class="actions">
        <a class="action__link" href="{{ route('empls.list') }}">
            <p>Сотрудники</p>
        </a>
        <a class="action__link" href="{{ route('edu-plan.list') }}">
            <p>Учебные планы</p>
        </a>
        <a class="action__link" href="{{ route('fpk.list') }}">
            <p>ФПК</p>
        </a>
        <a class="action__link" href="{{ route('contracts.list') }}">
            <p>Трудовые договоры</p>
        </a>
        <a class="action__link" href="{{ route('publs.list') }}">
            <p>Публикации</p>
        </a>
        <a class="action__link" href="/logout">
            <p>Выйти из аккаунта</p>
        </a>
    </section>
@endsection
