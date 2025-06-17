@extends('layout.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/EmplContracts/updateContract.css') }}">
@endsection
@section('content')
    <section class="container">
        <a href="{{ route('contracts.list') }}">Вернуться к книжкам</a>
        <form class="contract__update" action="{{ route('contracts.update', ['id' => $contract->id]) }}" method="POST">

            @method('PUT')
            @csrf
            @include('partial.errorChecking')

            <label for="emplId">ФИО</label>
            <select name="emplId" id="emplId">
                @foreach ($employees as $empl)
                    <option @selected($empl->id == $contract->employee->id) value="{{ $empl->id }}">{{ $empl->FIO() }}</option>
                @endforeach
            </select>

            <label for="department_id">Кафедра</label>
            <select name="department_id" id="department_id">
                @foreach ($departments as $dep)
                    <option @selected($dep->id == $contract->department->id) value="{{ $dep->id }}">{{ $dep->title }}</option>
                @endforeach
            </select>

            <label for="position_id">Должность</label>
            <select name="position_id" id="position_id">
                @foreach ($positions as $pos)
                    <option @selected($pos->id == $contract->position->id) value="{{ $pos->id }}">{{ $pos->title }}</option>
                @endforeach
            </select>

            <label for="date_from">Действует с</label>
            <input name="date_from" type="date" id="date_from" value="{{ $contract->date_from }}" min="1900-01-01" max="2100-12-31">

            <label for="date_to">Действует по</label>
            <input name="date_to" type="date" id="date_to" value="{{ $contract->date_to }}" min="1900-01-01" max="2100-12-31">

            <label for="empl-type_id">Тип сотрудника</label>
            <select name="empl-type_id" id="empl-type_id">
                @foreach ($emplTypes as $type)
                    <option @selected($type->id == $emplTypeId) value="{{ $type->id }}">{{ $type->title }}</option>
                @endforeach
            </select>

            <label for="rate">Ставка</label>
            <input name="rate" type="number" step="0.01" min="0" max="1" id="rate"
                value="{{ $contract->rate }}">

            <label for="pedagogical_experience">Педагогический стаж (в годах)</label>
            <input name="pedagogical_experience" type="number" step="0.1" min="0" id="pedagogical_experience"
                value="{{ $contract->pedagogical_experience }}">

            <label for="research_experience">Научно-исследовательский стаж (в годах)</label>
            <input name="research_experience" type="number" step="0.1" min="0" id="research_experience"
                value="{{ $contract->research_experience }}">

            <label for="workplace">Место работы</label>
            <input name="workplace" type="text" id="workplace" value="{{ $contract->workplace }}">

            <button type="submit">Обновить данные</button>
        </form>
    </section>
@endsection
