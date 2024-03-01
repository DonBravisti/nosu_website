@extends('layout.layout')
@section('content')
    <a href="{{ route('fpk.list') }}">Вернуться к списку ФПК</a>

    <h3>Добавить Сертификат/Диплом</h3>
    <form action="{{ route('fpk.update', ['id' => $sertificate->id]) }}" method="POST">

        @method('PUT')
        @include('partial.errorChecking')

        <select id="empls__list" name="emplId">
            @foreach ($empls as $empl)
                <option @selected($empl->id == $sertificate->employee->id) value="{{ $empl->id }}">{{ $empl->FIO() }}</option>
            @endforeach
        </select>

        <div id="sertificate__num">
            <label for="sert-num_input">Номер сертификата</label>
            <input type="text" id="sert-num_input" name="sertNum" value="{{ $sertificate->number }}" pattern="^[0-9]+$"
                title="Используйте числовой формат">
        </div>

        <div id="given__date">
            <label for="given-date_input">Дата выдачи</label>
            <input type="date" id="given-date_input" name="givenDate" value="{{ $sertificate->date }}">
        </div>

        <select id="doc-types__list" name="docTypeId">
            @foreach ($docTypes as $type)
                <option @selected($type->id == $sertificate->profDocType->id) value="{{ $type->id }}">{{ $type->title }}</option>
            @endforeach
        </select>

        <div id="sertificate__title">
            <label for="sert-title__input">Наименование</label>
            <input type="text" id="sert-title__input" name="sertTitle" value="{{ $sertificate->title }}">
        </div>

        <div id="n-hours-training">
            <label for="n-hours__input">Количество часов</label>
            <input type="number" id="n-hours__input" name="nHours" value="{{ $sertificate->n_hours }}">
        </div>

        <div id="organization">
            <label for="organization__input">Организация</label>
            <input type="text" id="organization__input" name="organization" value="{{ $sertificate->organization }}">
        </div>

        <div>
            <label for="image">Загрузить фото сертификата: </label>
            <input type="file" name="image" id="image" >
        </div>

        <button type="submit">Обновить</button>
    </form>
@endsection
