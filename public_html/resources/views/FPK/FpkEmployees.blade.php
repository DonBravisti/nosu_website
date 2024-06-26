@extends('layout.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/FPK/fpkEmployees.css') }}">
@endsection
@section('content')
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
