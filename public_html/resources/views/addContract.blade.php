@extends('layout.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/EmplContracts/addContract.css') }}">
@endsection
@section('content')
    <section>
        <a href="{{ route('contracts.list') }}">Вернуться к книжкам</a>
        <form class="contract__creating" action="{{ route('contracts.add.send') }}" method="post">

            @include('partial.errorChecking')

            <label for="emplId">ФИО</label>
            <select name="emplId" id="emplId">
                @foreach ($employees as $empl)
                    <option value="{{ $empl->id }}">{{ $empl->FIO() }}</option>
                @endforeach
            </select>

            <label for="department_id">Кафедра</label>
            <select name="department_id" id="department_id">
                @foreach ($departments as $dep)
                    <option value="{{ $dep->id }}">{{ $dep->title }}</option>
                @endforeach
            </select>

            <label for="position_id">Должность</label>
            <select name="position_id" id="position_id">
                @foreach ($positions as $pos)
                    <option value="{{ $pos->id }}">{{ $pos->title }}</option>
                @endforeach
            </select>

            <label for="date_from">Действует с</label>
            <input name="date_from" type="date" min="1900-01-01" max="2100-12-31">

            <label for="date_to">Действует по</label>
            <input name="date_to" type="date" min="1900-01-01" max="2100-12-31">

            <label for="empl-type_id">Тип сотрудника</label>
            <select name="empl-type_id" id="empl-type_id">
                @foreach ($emplTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->title }}</option>
                @endforeach
            </select>

            <label for="workplace">Место работы</label>
            <input name="workplace" id="workplace" type="text" placeholder="Введите место работы" value="СОГУ">

            <label for="rate">Ставка</label>
            <input name="rate" id="rate" type="number" step="0.01" min="0" placeholder="Введите ставку">

            <label for="pedagogical_experience">Педагогический стаж (в годах)</label>
            <input name="pedagogical_experience" id="pedagogical_experience" type="number" step="0.1" min="0"
                placeholder="Введите педагогический стаж">

            <label for="research_experience">Научно-исследовательский стаж (в годах)</label>
            <input name="research_experience" id="research_experience" type="number" step="0.1" min="0"
                placeholder="Введите научно-исследовательский стаж">

            <button type="submit">Добавить книжку</button>
        </form>
    </section>
@endsection
