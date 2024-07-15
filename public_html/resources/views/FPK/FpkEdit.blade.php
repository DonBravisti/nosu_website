@extends('layout.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/FPK/fpkEdit.css') }}">
@endsection
@section('content')
    <section class="content-container">
        <a href="{{ route('fpk.list') }}" class="back-link">Вернуться ко всем сертификатам</a>
        <h3 class="form-title">Редактировать Сертификат/Диплом</h3>
        <form action="{{ route('fpk.update', ['id' => $sertificate->id]) }}" method="post" enctype="multipart/form-data"
            class="styled-form">

            @method('PUT')
            @include('partial.errorChecking')

            <div class="form-group">
                <label for="empls__list">Сотрудник</label>
                <select id="empls__list" name="emplId" class="form-control">
                    @foreach ($empls as $empl)
                        <option @selected($empl->id == $sertificate->employee->id) value="{{ $empl->id }}">{{ $empl->FIO() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="sert-num_input">Номер сертификата</label>
                <input type="text" id="sert-num_input" name="sertNum" value="{{ $sertificate->number }}"
                    pattern="^[0-9]+$" title="Используйте числовой формат" class="form-control">
            </div>
            <div class="form-group">
                <label for="given-date_input">Дата выдачи</label>
                <input type="date" id="given-date_input" name="givenDate" value="{{ $sertificate->date }}"
                    class="form-control">
            </div>
            <div class="form-group">
                <label for="doc-types__list">Тип документа</label>
                <select id="doc-types__list" name="docTypeId" class="form-control">
                    @foreach ($docTypes as $type)
                        <option @selected($type->id == $sertificate->profDocType->id) value="{{ $type->id }}">{{ $type->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="sert-title__input">Наименование</label>
                <input type="text" id="sert-title__input" name="sertTitle" value="{{ $sertificate->title }}"
                    class="form-control">
            </div>
            <div class="form-group">
                <label for="n-hours__input">Количество часов</label>
                <input type="number" id="n-hours__input" name="nHours" value="{{ $sertificate->n_hours }}"
                    class="form-control">
            </div>
            <div class="form-group">
                <label for="organization__input">Организация</label>
                <input type="text" id="organization__input" name="organization" value="{{ $sertificate->organization }}"
                    class="form-control">
            </div>
            <div class="form-group">
                <label for="image">Загрузить фото сертификата</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn-submit">Сохранить изменения</button>
        </form>
    </section>
@endsection
