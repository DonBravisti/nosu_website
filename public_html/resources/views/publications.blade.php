@extends('layout.layout')
@section('content')
    <style>
        .publs__table {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .publ__table-cell {
            text-align: center;
            padding-bottom: 15px;
        }

        .plan__controls {
            display: flex;
            align-items: center;
        }
    </style>

    <section class="publications">
        <a href="{{ route('publs.add') }}">Добавить публикацию</a>
        <table class="publs__table">
            <tr>
                <th>Авторы</th>
                <th>Выходные данные</th>
                <th>Год издания</th>
                <th>Уровень</th>
            </tr>
            @foreach ($publs as $publ)
                <tr>
                    <td class="publ__table-cell">
                        @foreach ($publ->authors as $author)
                            {{ $author->FIO() }}<br>
                        @endforeach
                    </td>
                    <td class="publ__table-cell">{{ $publ->imprint }}</td>
                    <td class="publ__table-cell">{{ $publ->publication_year }}</td>
                    <td class="publ__table-cell">
                        @foreach ($publ->publLevels as $level)
                            <p>{{ $level->title }};</p>
                        @endforeach

                    </td>
                    <td class="plan__controls publ__table-cell">
                        <form method="GET" action="{{ route('publs.update-form', ['id' => $publ->id]) }}">
                            <button type="submit">
                                Редактировать
                            </button>
                        </form>
                        /
                        <form method="POST" action="{{ route('publs.remove', ['id' => $publ->id]) }}">
                            @method('DELETE')

                            <button type="submit" onclick="return ConfirmDelete()">
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>

    <script>
        function ConfirmDelete() {
            return confirm('Вы уверены? Публикация будет удалена безвозвратно.');
        }
    </script>
@endsection
