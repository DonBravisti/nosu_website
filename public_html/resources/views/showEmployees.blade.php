@extends('layout.layout')
@section('content')
    <style>
        .action__link {
            display: block;
            background-color: rgba(30, 84, 193, 1);
            border-radius: 10px;
            padding: 5px;
            text-align: center;
            width: fit-content;
            cursor: pointer;
        }

        .action__link p {
            color: white;
        }

        .filter select {
            /* height: 100px; */
        }

        .sort-filter {
            width: 50%;
        }

        .sort-filter_container {
            display: flex;
            align-items: center;
        }

        .sort-filter_container div {
            width: 50%;
        }

        .sort-filter_container select {
            height: 20px;
        }

        .controls_container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
    </style>

    <section>
        <div class="workers-container">
            <div class="controls_container">
                <a class="action__link" href="/create-user">
                    <p>Создать сотрудника</p>
                </a>

                <form class="sort-filter" action="{{ route('empls.sort-filter') }}" method="post">
                    <div class="sort-filter_container">
                        <div class="sort">
                            <label for="sort">Сортировка по ФИО</label>
                            <select name="sort" id="sort">
                                <option value="0" selected>А-Я</option>
                                <option value="1"
                                    @isset($sortBy)
                                        @selected($sortBy)
                                    @endisset>
                                    Я-А</option>
                            </select>
                        </div>
                        <div class="filter">
                            <label for="filter">Сортировка по кафедре</label>
                            <select name="filter" id="filter">
                                <option value="0" selected>Нет</option>
                                @foreach ($departments as $dep)
                                    <option
                                        @isset($depId)
                                            @selected($depId == $dep->id)
                                        @endisset
                                        value="{{ $dep->id }}">{{ $dep->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="action__link" type="submit"><p>Применить</p></button>
                    </div>

                </form>
            </div>
            <div class="swiper-wrapper workers-list">
                @foreach ($empls as $empl)
                    <div class="worker-card swiper-slide">
                        <div class="worker-card-container">
                            <img src="/images/avatar.jpg">
                            <h3 class="worker__name">
                                {{ $empl->FIO }}
                            </h3>
                            <p class="worker__status">{{ $empl->emplDegree->degree->title }}</p>
                            <button class="learn-more__btn">
                                <a href="/kafedra-prikladnoj-matematiki-i-informatiki/{{ $empl->id }}"
                                    class="learn-more__text">
                                    Узнать больше
                                </a>
                                <div class="learn-more__icon"></div>
                            </button>
                            @if (Auth::check())
                                <button class="learn-more__btn edit__button">
                                    <a href="/edit/{{ $empl->id }}" class="learn-more__text">
                                        Редактировать
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
@endsection
