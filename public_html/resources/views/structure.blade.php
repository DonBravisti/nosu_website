@extends('layout.layout')
@section('content')
    <div class="nav-path-container _container">
        <div class="nav-path">
            <a href="#" class="nav-path__link not-mobile__link">Главная</a>
            <span class="nav-path__img not-mobile__link"></span>
            <a href="#" class="nav-path__link not-mobile__link">Факультет математики и компьютерных наук</a>
            <span class="nav-path__img not-mobile__link"></span>
            <a href="#" class="nav-path__link not-mobile__link">Структура</a>
        </div>
    </div>
    <section class="section__cards-block cards-block">
        <div class="section__inner _container">
            <div class="cards-block__title">
                <h1 class="cards-block__heading">Структура</h1>
            </div>
            <div class="cards-block__wrapper">
                <div class="card">
                    <div class="card__title">Кафедра алгебры и анализа</div>
                    <div class="card__text">Кафедра ведет подготовку студентов по направлениям 01.03.01 Математика, профиль:
                        «Кибербезопасность», 44.03.05 «Педагогическое образование» с двумя профилями подготовки «Математика.
                        Информатика».</div>
                    <div class="card__button">
                        <button><span>Узнать больше</span><img src="/images/arrow-right.svg" alt="Arrow-right"></button>
                    </div>
                </div>
                <div class="card">
                    <div class="card__title">Кафедра прикладной математики и информатики</div>
                    <div class="card__text">Кафедра ведет подготовку студентов по направлениям: 01.03.02 «Прикладная
                        математика и информатика», профиль: «Программирование, анализ данных и математическое
                        моделирование», 09.03.01 «Информатика и вычислительная техника», профиль «Информатика и
                        вычислительная техника».</div>
                    <div class="card__button">
                        <a href="/kafedra-prikladnoj-matematiki-i-informatiki"><button><span>Узнать больше</span><img
                                    src="/images/arrow-right.svg" alt="Arrow-right"></button></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card__title">Научно-образовательный математический центр СОГУ </div>
                    <div class="card__text">Научно-образовательный математический центр СОГУ (НОМЦ СОГУ) – создан в 2021 г.,
                        в целях реализации программы развития регионального научно-образовательного математического центра
                        «Северо-Кавказский центр математических исследований»</div>
                    <div class="card__button">
                        <button><span>Узнать больше</span><img src="/images/arrow-right.svg" alt="Arrow-right"></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
