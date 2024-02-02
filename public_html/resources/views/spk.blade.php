@extends('layout.layout')
@section('content')
    <div>
        <a href="{{ route('spk.add') }}">Добавить сертификат</a>
    </div>

    <div>
        @foreach ($spk as $spkItem)
            <p>ФИО: {{ $spkItem->employee->FIO() }}</p>
            <p>Сертификат: {{ $spkItem->title }}, {{ $spkItem->profDocType->title }}</p>
            <br>
        @endforeach
    </div>
@endsection
