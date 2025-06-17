@extends('layout.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/FPK/fpkFilter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/FPK/fpkEmployees.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filter-sidebar/sidebar.css') }}">
@endsection
@section('content')
    <section class="">
        <div class="fpk__controls">
            <a class="action__link" href="{{ route('fpk.add') }}">
                <p>Добавить сертификат</p>
            </a>

            <button id="filters__btn" class="filters__btn action__link">
                <p>Фильтры и Сортировка</p>
            </button>
        </div>

        <table class="fpk__content">
            <tr>
                <th class="fpk__field fpk__field--narrow">№</th>
                <th class="fpk__field">ФИО</th>
                <th class="fpk__field">Год</th>
                <th class="fpk__field">Организация</th>
                <th class="fpk__field">Номер</th>
                <th class="fpk__field">Кол-во часов</th>
                <th class="fpk__field">Название</th>
                <th class="fpk__field">Действия</th>
            </tr>

            @foreach ($fpk as $key => $fpkItem)
                <tr class="{{ $key % 2 == 0 ? 'alt-row' : '' }}">
                    <td class="fpk__field fpk__field--narrow">{{ ++$key }}</td>
                    <td class="fpk__field">{{ $fpkItem->employee->FIO() }}</td>
                    <td class="fpk__field">{{ date('Y', strtotime($fpkItem->date)) }}</td>
                    <td class="fpk__field">{{ $fpkItem->organization }}</td>
                    <td class="fpk__field">{{ $fpkItem->number }}</td>
                    <td class="fpk__field">{{ $fpkItem->n_hours }}</td>
                    <td class="fpk__field">{{ $fpkItem->title }}</td>
                    <td class="fpk__field">
                        <a href="{{ route('fpk.update-form', ['id' => $fpkItem->id]) }}" class="action__link-buttons">
                            <p>Редактировать</p>
                        </a>
                        <form action="{{ route('fpk.remove', ['id' => $fpkItem->id]) }}" method="POST"
                            onsubmit="return confirm('Вы уверены, что хотите удалить этот сертификат?');"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action__link-buttons">
                                <p>Удалить</p>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>

    <div id="sidebar" class="sidebar">
        <button class="close-sidebar" id="close-sidebar">
            <p>&times;</p>
        </button>
        <form method="GET" action="{{ route('fpk.filter') }}">
            @csrf
            <h3>Фильтры</h3>
            <div class="filter-group">
                <label class="filter-group__header" for="fio">ФИО</label>
                <input type="text" name="fio" id="fio">
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
                <p><input type="radio" name="sort" value="fio-asc">А-Я ФИО</p>
                <p><input type="radio" name="sort" value="fio-desc">Я-А ФИО</p>
                <p><input type="radio" name="sort" value="year-asc">Год, по возрастанию</p>
                <p><input type="radio" name="sort" value="year-desc">Год, по убыванию</p>
            </div>

            <button type="submit">Применить</button>
        </form>
    </div>
@section('scripts')
    <script src="{{ asset('js/filter-sidebar/sidebar.js') }}"></script>
@endsection
@endsection
