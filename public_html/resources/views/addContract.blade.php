@extends('layout.layout')
@section('content')
    <style>
        .contract__creating {
            display: flex;
            flex-direction: column;
            width: fit-content;
            margin: 0 auto;
        }

        input,
        select {
            width: 500px;
            height: 30px;
            margin: 10px 0;
        }
    </style>

    <section>
        <form class="contract__creating" action="{{ route('contracts.add.send') }}" method="post">

            @include('partial.errorChecking')

            <label for="">ФИО</label>
            <select name="emplId" id="emplId">
                @foreach ($employees as $empl)
                    <option value="{{ $empl['id'] }}">{{ $empl['fio'] }}</option>
                @endforeach
            </select>

            <label for="">Номер</label>
            <input name="number" type="text" value="123">

            <label for="">Должность</label>
            <select name="position_id" id="position_id">
                @foreach ($positions as $pos)
                    <option value="{{ $pos->id }}">{{ $pos->title }}</option>
                @endforeach
            </select>

            <label for="">Действует с</label>
            <input name="date_from" type="date">

            <label for="">Действует по</label>
            <input name="date_to" type="date">

            <label for="">Конкурс</label>
            <select name="competition" id="competition">
                <option value="1">Выбран</option>
                <option value="0">Не выбран</option>
            </select>

            <button type="submit">Добавить договор</button>
        </form>
    </section>
@endsection
