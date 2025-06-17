@extends('layout.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
@section('content')
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
