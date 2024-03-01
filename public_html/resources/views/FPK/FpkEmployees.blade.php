@extends('layout.layout')
@section('content')
    <style>
        .empls{
            display: flex;
            flex-direction: column;
        }
    </style>
    <section>
        <h3>
            <a href="{{ route('fpk.add') }}">Добавить сертификат</a>
        </h3>
        <div class="empls">
            @foreach ($employees as $empl)
                <a href="{{ route('fpk.empl', ['id' => $empl->id]) }}">{{ $empl->FIO() }}</a>
            @endforeach
        </div>
    </section>
@endsection
