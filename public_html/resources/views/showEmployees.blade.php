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
        }

        .action__link p {
            color: white;
        }
    </style>

    <section>
        <div class="workers-container">
            <a class="action__link" href="/create-user">
                <p>Создать сотрудника</p>
            </a>
            <div class="swiper-wrapper workers-list">
                @foreach ($empls as $empl)
                    <div class="worker-card swiper-slide">
                        <div class="worker-card-container">
                            <img src="/images/avatar.jpg">
                            <h3 class="worker__name">
                                {{ $empl->FIO() }}
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
