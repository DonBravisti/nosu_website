@extends('layout.layout')
@section('content')
    <style>
        .fpk__list {
            margin: 0 auto;
            width: 100%;
            max-width: 700px;
        }

        .fpk-item {
            display: flex;
            justify-content: space-between;
        }

        .fpk__controls {
            display: flex;
            align-items: center;
        }
    </style>
    <section class="fpk__list">
        <h3>
            <a href="{{ route('fpk.add') }}">Добавить сертификат</a>
        </h3>
        <br><br>

        <div>
            @foreach ($fpk as $fpkItem)
                <div class="fpk-item">
                    <div>
                        <p>ФИО: {{ $fpkItem->employee->FIO() }}</p>
                        <p>Сертификат: {{ $fpkItem->title }}, {{ $fpkItem->profDocType->title }}</p>
                        <br>
                    </div>
                    <div class="fpk__controls">
                        <form method="GET" action="{{ route('fpk.update-form', ['id' => $fpkItem->id]) }}">
                            <button type="submit">
                                Редактировать
                            </button>
                        </form>
                        /
                        <form method="POST" action="{{ route('fpk.remove', ['id' => $fpkItem->id]) }}">
                            @method('DELETE')

                            <button type="submit" onclick="return ConfirmDelete()">
                                Удалить
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <script>
        function ConfirmDelete() {
            return confirm('Вы уверены? Сертификат будет удалён безвозвратно.');
        }
    </script>
@endsection
