@extends('layout.layout')
@section('content')
    <style>
        .spk__list {
            margin: 0 auto;
            width: 100%;
            max-width: 700px;
        }

        .spk-item {
            display: flex;
            justify-content: space-between;
        }

        .spk__controls {
            display: flex;
            align-items: center;
        }
    </style>
    <section class="spk__list">
        <h3>
            <a href="{{ route('spk.add') }}">Добавить сертификат</a>
        </h3>
        <br><br>

        <div>
            @foreach ($spk as $spkItem)
                <div class="spk-item">
                    <div>
                        <p>ФИО: {{ $spkItem->employee->FIO() }}</p>
                        <p>Сертификат: {{ $spkItem->title }}, {{ $spkItem->profDocType->title }}</p>
                        <br>
                    </div>
                    <div class="spk__controls">
                        <form method="GET" action="{{ route('spk.update-form', ['id' => $spkItem->id]) }}">
                            <button type="submit">
                                Редактировать
                            </button>
                        </form>
                        /
                        <form method="POST" action="{{ route('spk.remove', ['id' => $spkItem->id]) }}">
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
