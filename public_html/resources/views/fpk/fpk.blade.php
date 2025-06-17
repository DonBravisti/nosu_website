@extends('layout.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/FPK/fpk.css') }}">
@endsection
@section('content')

    <section class="main-container">
        <a href="#" class="back-link">Вернуться к списку ФПК</a>
        <div class="form-title-container">
            <h3 class="form-title">{{ $empl->FIO()}}, Сертификаты</h3>
        </div>
        <div class="add-cert-container">
            <a href="{{ route('fpk.add') }}" class="btn-add-cert">Добавить сертификат</a>
        </div>
        @foreach ($fpk as $fpkItem)
            <div class="certificate">
                <div class="certificate-info">
                    <h3>{{ $fpkItem->profDocType->title }}</h3>
                    <p>Дата выдачи: {{ $fpkItem->date }}</p>
                    <p>Описание: {{ $fpkItem->title }}</p>
                </div>
                <div class="certificate-buttons">
                    <form method="GET" action="{{ route('fpk.update-form', ['id' => $fpkItem->id]) }}">
                        <button class="btn btn-edit">
                            <i class="fas fa-edit"></i> Редактировать
                        </button>
                    </form>
                    <form method="POST" action="{{ route('fpk.remove', ['id' => $fpkItem->id]) }}">
                        @method('DELETE')

                        <button class="btn btn-delete" onclick="return ConfirmDelete()">
                            <i class="fas fa-trash-alt"></i> Удалить
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </section>
@section('scripts')
    <script src="{{ asset('js/FPK/fpk.js') }}"></script>
@endsection
@endsection
