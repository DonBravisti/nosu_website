@extends('layout.layout')
@section('content')
    <a href="{{ route('fpk.list') }}">Вернуться к списку ФПК</a>

    <h3>Добавить Сертификат/Диплом</h3>
    <form action="{{ route('fpk.send') }}" method="post" enctype="multipart/form-data">

        @include('partial.errorChecking')

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

        <div>
            <label for="image">Загрузить фото сертификата: </label>
            <input type="file" name="image" id="image">
        </div>

        @isset($imgPath)
            {{ $imgPath }}
        @endisset

        <button type="submit">Добавить</button>
    </form>
@endsection
