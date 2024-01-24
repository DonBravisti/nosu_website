@extends('layout.layout')
@section('content')
    <section class="publications">
        <a href="{{ route('publs.add') }}">Добавить публикацию</a>
        @foreach ($publs as $publ)
            <div class="publ">
                {{ $publ->title }}
            </div>
        @endforeach
    </section>
@endsection
