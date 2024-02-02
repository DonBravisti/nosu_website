@extends('layout.layout')
@section('content')
    <h3>Добавить Сертификат/Диплом</h3>
    <form action="{{ route('spk.send') }}" method="post">
        <select name="" id="">
            @foreach ($employees as $empl)
                <option value="{{ $empl->id }}">{{ $empl->FIO() }}</option>
            @endforeach
        </select>
    </form>
@endsection
