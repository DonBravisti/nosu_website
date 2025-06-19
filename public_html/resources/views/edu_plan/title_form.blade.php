@extends('layout.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/EduPlan/title_form.css') }}">
@endsection

@section('content')
    <section>
        <a href="{{ route('edu-plan.titles', $speciality->id) }}">Вернуться к титульным листам</a>

        <h2 class="title">
            {{ isset($title) ? 'Редактирование титула' : 'Создание титула' }} для спец-ти {{ $speciality->cod }} "{{ $speciality->title }}"
        </h2>

        <form method="POST"
            action="{{ isset($title) ? route('edu-plan.title.update', $title->id) : route('edu-plan.title.store', $speciality->id) }}">
            @csrf
            @if (isset($title))
                @method('PUT')
            @endif

            @include('partial.errorChecking')

            <div class="field">
                <label>Профиль</label>
                <input required type="text" name="profile" value="{{ old('profile', $title->profile ?? '') }}">
            </div>

            <div class="field">
                <label>Год поступления</label>
                <input required type="text" name="date_enter" maxlength="4"
                    value="{{ old('date_enter', $title->date_enter ?? '') }}">
            </div>

            <div class="field">
                <label>Текущий год</label>
                <input required type="text" name="current_year" maxlength="4"
                    value="{{ old('current_year', $title->current_year ?? '') }}">
            </div>

            <div class="field">
                <label>Дата протокола ученого совета</label>
                <input required type="date" name="date_uchsovet" value="{{ old('date_uchsovet', $title->date_uchsovet ?? '') }}">
            </div>

            <div class="field">
                <label>Номер протокола ученого совета</label>
                <input required type="number" name="number_uchsovet"
                    value="{{ old('number_uchsovet', $title->number_uchsovet ?? '') }}">
            </div>

            <div class="field">
                <label>Дата протокола ФГОС</label>
                <input required type="date" name="date_fgos" value="{{ old('date_fgos', $title->date_fgos ?? '') }}">
            </div>

            <div class="field">
                <label>Номер протокола ФГОС</label>
                <input required type="number" name="number_fgos" value="{{ old('number_fgos', $title->number_fgos ?? '') }}">
            </div>

            <div class="field">
                <label>Статус</label>
                <select name="included">
                    <option value="1" @selected(old('included', $title->included ?? '') == 1)>Активный</option>
                    <option value="0" @selected(old('included', $title->included ?? '') == 0)>Черновик</option>
                </select>
            </div>

            <button type="submit">{{ isset($title) ? 'Сохранить' : 'Создать' }}</button>
        </form>
    </section>
@endsection
