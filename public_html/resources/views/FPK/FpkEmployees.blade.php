@extends('layout.layout')
@section('content')
    <style>
        .container {
            max-width: 1100px;
            width: 100%;
            margin: 0 auto;

        }

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
    </style>
    <section>
        <div class="container">
            <h3>
                <a class="action__link" href="{{ route('fpk.add') }}">
                    <p>Добавить сертификат</p>
                </a>
            </h3>
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
@endsection
