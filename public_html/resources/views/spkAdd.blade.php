@extends('layout.layout')
@section('content')
<a href="{{route('spk.list')}}">Вернуться к списку СПК</a>

    <h3>Добавить Сертификат/Диплом</h3>
    <form action="{{ route('spk.send') }}" method="post">
        @if (count($errors) > 0)
            <div style="background-color:lightcoral">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: red;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif (session('success'))
            <div style="background-color: lightgreen;">
                <p style="color: green;">{{ session('success') }}</p>
            </div>
        @endif

        <select id="empls__list" name="emplId">
            @foreach ($empls as $empl)
                <option value="{{ $empl->id }}">{{ $empl->FIO() }}</option>
            @endforeach
        </select>

        <div id="sertificate__num">
            <label for="sert-num_input">Номер сертификата</label>
            <input type="text" id="sert-num_input" name="sertNum" value="{{ old('sertNum') }}" pattern="^[0-9]+$"
                title="Используйте числовой формат">
        </div>

        <div id="given__date">
            <label for="given-date_input">Дата выдачи</label>
            <input type="date" id="given-date_input" name="givenDate" value="{{ old('givenDate') }}">
        </div>

        <select id="doc-types__list" name="docTypeId">
            @foreach ($docTypes as $type)
                <option value="{{ $type->id }}">{{ $type->title }}</option>
            @endforeach
        </select>

        <div id="sertificate__title">
            <label for="sert-title__input">Наименование</label>
            <input type="text" id="sert-title__input" name="sertTitle" value="{{ old('sertTitle') }}">
        </div>

        <div id="n-hours-training">
            <label for="n-hours__input">Количество часов</label>
            <input type="number" id="n-hours__input" name="nHours" value="{{ old('nHours') }}">
        </div>

        <div id="organization">
            <label for="organization__input">Организация</label>
            <input type="text" id="organization__input" name="organization" value="{{ old('organization') }}">
        </div>

        <button type="submit">Добавить</button>
    </form>
@endsection
