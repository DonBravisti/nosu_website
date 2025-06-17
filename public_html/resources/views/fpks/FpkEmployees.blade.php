@extends('layout.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/FPK/fpkEmployees.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filter-sidebar/sidebar.css') }}">
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="fpk__controls">
                <a class="action__link" href="{{ route('fpk.add') }}">
                    <p>Добавить сертификат</p>
                </a>

                <button id="filters__btn" class="filters__btn action__link">
                    <p>Фильтры и Сортировка</p>
                </button>
            </div>

            <div class="swiper-wrapper workers-list">
                @foreach ($employees as $empl)
                    <div class="worker-card swiper-slide">
                        <div class="worker-card-container">
                            <img src="/images/avatar.jpg">
                            <h3 class="worker__name">
                                {{ $empl->FIO }}
                            </h3>
                            <p class="worker__status">{{ $empl->emplDegree->degree->title }}</p>
                            @if (Auth::check())
                                <button class="learn-more__btn edit__button">
                                    <a href="{{ route('fpk.empl', ['id' => $empl->id]) }}" class="learn-more__text">
                                        Посмотреть сертификаты
                                    </a>
                                    <div class="learn-more__icon"></div>
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div id="sidebar" class="sidebar">
        <button class="close-sidebar" id="close-sidebar">
            <p>&times;</p>
        </button>
        <form method="GET" action="{{ route('fpk.filter') }}">
            @csrf
            <h3>Фильтры</h3>
            <div class="filter-group">
                <label class="filter-group__header" for="fio">ФИО</label>
                <input type="text" name="fio" id="fio">
            </div>
            <div class="filter-group">
                <label class="filter-group__header" for="">Период</label>
                <div class="">
                    <label for="start_year">С</label>
                    <input type="number" name="start_year" id="start_year" min="1900" max="{{ date('Y') }}">
                </div>
                <div class="">
                    <label for="end_year">По</label>
                    <input type="number" name="end_year" id="end_year" min="1900" max="{{ date('Y') }}">
                </div>
            </div>

            <h3>Сортировка</h3>
            <div class="filter-group">
                <p><input type="radio" name="sort" value="fio-asc">А-Я ФИО</p>
                <p><input type="radio" name="sort" value="fio-desc">Я-А ФИО</p>
                <p><input type="radio" name="sort" value="year-asc">Год, по возрастанию</p>
                <p><input type="radio" name="sort" value="year-desc">Год, по убыванию</p>
            </div>

            <button type="submit">Применить</button>
        </form>
    </div>
@section('scripts')
    <script src="{{ asset('js/filter-sidebar/sidebar.js') }}"></script>
@endsection
@endsection
