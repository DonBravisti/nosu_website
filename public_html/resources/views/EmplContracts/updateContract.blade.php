@extends('layout.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/EmplContracts/updateContract.css') }}">
@endsection
@section('content')
    <section>
        <a href="{{ route('contracts.list') }}">Вернуться к договорам</a>
        <form class="contract__update" action="{{ route('contracts.update', ['id' => $contract->id]) }}" method="POST">

            @method('PUT')
            @include('partial.errorChecking')

            <label for="">ФИО</label>
            <select name="emplId" id="emplId">
                @foreach ($employees as $empl)
                    <option @selected($empl->id == $contract->employee->id) value="{{ $empl->id }}">{{ $empl->FIO() }}</option>
                @endforeach
            </select>

            <label for="">Номер</label>
            <input name="number" type="text" value="{{ $contract->number }}">

            <label for="">Кафедра</label>
            <select name="department_id" id="department_id">
                @foreach ($departments as $dep)
                    <option @selected($dep->id == $contract->department->id) value="{{ $dep->id }}">{{ $dep->title }}</option>
                @endforeach
            </select>

            <label for="">Должность</label>
            <select name="position_id" id="position_id">
                @foreach ($positions as $pos)
                    <option @selected($pos->id == $contract->position->id) value="{{ $pos->id }}">{{ $pos->title }}</option>
                @endforeach
            </select>

            <label for="">Действует с</label>
            <input name="date_from" type="date" value="{{ $contract->date_from }}">

            <label for="">Действует по</label>
            <input name="date_to" type="date" value="{{ $contract->date_to }}">

            <label for="">Тип сотрудника</label>
            <select name="empl-type_id" id="empl-type_id">
                @foreach ($emplTypes as $type)
                    <option @selected($type->id == $emplTypeId) value="{{ $type->id }}">
                        {{ $type->title }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Обновить данные</button>
        </form>
    </section>
@endsection
