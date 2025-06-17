@extends('layout.layout')
@section('styles')
    <meta name="route_publs-filter" content="{{ route('publs.filter') }}">
    <link rel="stylesheet" href="{{ asset('css/Publs/publs.css') }}">
@endsection
@section('content')
    <section class="publications">
        <div class="publ__controls">
            <a class="action__link" href="{{ route('publs.add') }}">
                <p>Добавить публикацию</p>
            </a>

            <button id="filters__btn" class="filters__btn action__link">
                <p>Фильтры и Сортировка</p>
            </button>
        </div>
        <table class="publs__table">
            <thead>
                <tr>
                    <th class="sort__link" data-sort-by="authors">Авторы</th>
                    <th>Выходные данные</th>
                    <th class="sort__link" data-sort-by="publication_year">Год издания</th>
                    <th>Уровень</th>
                </tr>
            </thead>
            <tbody id="publications-table">
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
                                <button type="submit">Редактировать</button>
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
            </tbody>
        </table>

        <div id="sidebar" class="sidebar">
            <button class="close-sidebar" id="close-sidebar">
                <p>&times;</p>
            </button>
            <form method="GET" action="{{ route('publs.filter') }}">
                @csrf
                <h3>Фильтры</h3>
                <div class="filter-group">
                    <label class="filter-group__header" for="author">Автор</label>
                    <input type="text" name="author">
                </div>
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

                <h3>Сортировка</h3>
                <div class="filter-group">
                    <p><input type="radio" name="sort" value="authors-asc">А-Я Авторы</p>
                    <p><input type="radio" name="sort" value="authors-desc">Я-А Авторы</p>
                    <p><input type="radio" name="sort" value="publication_year-asc">Год издания, по возрастанию</p>
                    <p><input type="radio" name="sort" value="publication_year-desc">Год издания, по убыванию</p>
                </div>

                <button type="submit">Применить</button>
            </form>
        </div>
    </section>
@section('scripts')
    <script src="{{ asset('js/Publ/publs.js') }}"></script>
    <script src="{{ asset('js/filter-sidebar/sidebar.js') }}"></script>
@endsection
@endsection
