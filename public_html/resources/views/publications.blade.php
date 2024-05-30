@extends('layout.layout')
@section('content')
    <style>
        .action__link {
            display: block;
            background-color: rgba(30, 84, 193, 1);
            border-radius: 10px;
            padding: 5px;
            text-align: center;
            width: fit-content;
        }

        .action__link p {
            color: white;
        }

        .publications {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

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

        .publ__controls {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
        }

        .filters__btn {
            border: none;
            cursor: pointer;
        }

        .sidebar {
            position: fixed;
            top: 0;
            right: -300px;
            width: 300px;
            height: 100%;
            background-color: #fff;
            transition: right 0.3s ease;
            z-index: 999;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            /* Добавляем прокрутку */
        }

        .show-sidebar {
            right: 0;
        }

        .close-sidebar {
            position: relative;
            left: 10px;
            top: 5px;
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .close-sidebar p {
            font-size: 35px;
        }

        .filter-group {
            margin-bottom: 15px;
            padding: 0 15px;
            /* Чтобы содержимое не прилипало к краям */
        }

        .filter-group__header {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .filter-group input {
            margin-right: 5px;
        }

        .filter-group div {
            margin-bottom: 5px;
        }

        .filter-field {
            display: flex;
        }
    </style>


    <section class="publications">
        <div class="publ__controls">
            <a class="action__link" href="{{ route('publs.add') }}">
                <p>Добавить публикацию</p>
            </a>

            <button id="filters__btn" class="filters__btn action__link">
                <p>Фильтры</p>
            </button>
        </div>
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
                            @csrf
                            <button type="submit" onclick="return ConfirmDelete()">
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <div id="sidebar" class="sidebar">
            <button class="close-sidebar" id="close-sidebar">
                <p>&times;</p>
            </button>
            <form method="GET" action="{{ route('publs.filter') }}">
                @csrf
                <h3>Фильтры</h3>
                <div class="filter-group">
                    <label class="filter-group__header" for="authors">Авторы</label>
                    @foreach ($employees as $employee)
                        <div class="filter-field">
                            <input type="checkbox" name="authors[]" value="{{ $employee->id }}"
                                id="author_{{ $employee->id }}">
                            <label for="author_{{ $employee->id }}">{{ $employee->Fio }}</label>
                        </div>
                    @endforeach
                </div>
                {{-- <div class="filter-group">
                    <label class="filter-group__header" for="years">Годы</label>
                    @foreach ($years as $year)
                        <div class="filter-field">
                            <input type="checkbox" name="years[]" value="{{ $year }}"
                                id="year_{{ $year }}">
                            <label for="year_{{ $year }}">{{ $year }}</label>
                        </div>
                    @endforeach
                </div> --}}
                <div class="filter-group">
                    <label class="filter-group__header" for="">Период</label>
                    <div class="">
                        <label for="start_year">С</label>
                        <input type="number" name="start_year" id="start_year" min="1900" max="{{ date('Y') }}">
                    </div>
                    <div class="">
                        <label for="end_year">По</label>
                        <input type="number" name="end_year" id="end_year" min="1900" max="{{ date('Y') }}">
                    </div>
                </div>
                <button type="submit">Применить</button>
            </form>
        </div>
    </section>

    <script>
        document.getElementById('filters__btn').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show-sidebar');
        });

        document.getElementById('close-sidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show-sidebar');
        });

        function ConfirmDelete() {
            return confirm('Вы уверены? Публикация будет удалена безвозвратно.');
        }
    </script>
@endsection
