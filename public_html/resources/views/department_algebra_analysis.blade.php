@extends('layout.layout')
@section('content')
    <div class="department-container">
        <div class="department-block">
            <h2 class="section-title">Кафедра алгебры и анализа</h2>
            <h3 class="director-info__title mobile-director-info__title">Заведующий кафедрой</h3>
            <div class="department-body">
                <div class="director-info">
                    <h3 class="director-info__title pc-director-info__title">Заведующий кафедрой</h3>
                    <a href="#" class="director-info__name">Иванов Иван Иванович</a>
                    <p class="director-info__el">Профессор</p>
                    <p class="director-info__el">Доктор физико-математических наук</p>
                    <p class="director-info__el">Базовое образование: Высшее. Математик.</p>
                    <p class="director-info__el">Преподаватель</p>
                    <p class="director-info__el">Общий стаж работы: 35 лет</p>
                    <a href={{ route('pers-card', ['id' => 1]) }} class="director-info-link">
                        <button class="director-info-btn">
                            <p class="info-btn__text">Узнать больше</p>
                            <div class="info-btn__icon"></div>
                        </button>
                    </a>
                </div>
                <div class="director-photo-block">
                    <img src="/images/avatar.jpg" class="director__photo"></img>
                </div>
            </div>
        </div>
        <div class="directions-block">
            <h2 class="section-title">Основные направления кафедры:</h2>
            <div class="directions-body">
                <div class="direction-body__el">
                    <p class="direction-body__text">Абстрактная алгебра</p>
                </div>
                <div class="direction-body__el">
                    <p class="direction-body__text">Функциональный анализ</p>
                </div>
                <div class="direction-body__el">
                    <p class="direction-body__text">Геометрия и топология</p>
                </div>
                <div class="direction-body__el">
                    <p class="direction-body__text">Дифференциальные уравнения</p>
                </div>
                <div class="direction-body__el">
                    <p class="direction-body__text">Математический анализ</p>
                </div>
            </div>
        </div>
        <div class="academic-degrees-block">
            <h2 class="section-title">Образовательные программы кафедры:</h2>
            <div class="academic-degrees-body">
                <div class="study-type">
                    <h2 class="study-type__title">Бакалавриат</h2>
                    <div class="study-type-text-container">
                        <p class="study-type__text">Кафедра ведет подготовку студентов по направлению:</p>
                        <p class="study-type__text"><a href="#" class="study-type__link">01.03.01</a> «Математика»,
                        </p>
                        <p class="study-type__text"><a href="#" class="study-type__link">профиль:</a> «Фундаментальная
                            и прикладная математика».</p>
                    </div>
                </div>
                <div class="study-type">
                    <h2 class="study-type__title">Магистратура</h2>
                    <div class="study-type-text-container">
                        <p class="study-type__text">На кафедре ведется подготовка магистров по направлению:</p>
                        <p class="study-type__text"><a href="#" class="study-type__link">01.04.01</a> «Математика»,
                        </p>
                        <p class="study-type__text"><a href="#" class="study-type__link">профиль:</a> «Современные
                            проблемы алгебры и анализа».</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="workers-container">
        <div class="workers-block">
            <h2 class="section-title">Сотрудники кафедры</h2>
            <div class="workers-body slider-container">
                <div class="swiper">
                    <div class="swiper-wrapper workers-list">
                        @foreach ($employees as $employee)
                            <div class="worker-card swiper-slide">
                                <div class="worker-card-container">
                                    <img src="/images/avatar.jpg">
                                    <h3 class="worker__name">
                                        {{ $employee['fio'] }}
                                    </h3>
                                    <p class="worker__status">{{ $employee['degree'] }}</p>
                                    {{-- <button class="learn-more__btn"> --}}
                                    <a class="learn-more__btn" href={{ route('pers-card', ['id' => $employee['id']]) }}
                                        class="learn-more__text">
                                        Узнать больше
                                        <div class="learn-more__icon"></div>
                                    </a>

                                    {{-- </button> --}}
                                    {{-- @if (Auth::check())
                                        <button class="learn-more__btn edit__button">
                                            <a href="/edit/{{ $employee['id'] }}" class="learn-more__text">
                                                Редактировать
                                            </a>
                                            <div class="learn-more__icon"></div>
                                        </button>
                                    @endif --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-scrollbar scrollbar"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
