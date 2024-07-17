@extends('layout.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/EmplContracts/contracts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filter-sidebar/sidebar.css') }}">
@endsection
@section('content')
    <section class="contracts">
        <div class="publ__controls">
            <a class="action__link" href="{{ route('contracts.add') }}">
                <p>Добавить договор</p>
            </a>

            <button id="filters__btn" class="filters__btn action__link">
                <p>Сортировка</p>
            </button>
        </div>

        <table class="contracts__content">
            <tr>
                <th class="contract__field">
                    №
                </th>
                <th class="contract__field">
                    ФИО
                </th>
                <th class="contract__field">
                    Кафедра
                </th>
                <th class="contract__field">
                    Должность
                </th>
                <th class="contract__field">
                    Действует по
                </th>
                <th class="contract__field">
                    Тип сотрудника
                </th>
            </tr>

            @foreach ($contracts as $key => $contract)
                <tr class="contract {{ $contract->warning_class }}">
                    <td class="contract__field">
                        {{ ++$key }}
                    </td>
                    <td class="contract__field">
                        {{ $contract->employee->FIO() }}
                    </td>
                    <td class="contract__field">
                        {{ $contract->department->title }}
                    </td>
                    <td class="contract__field">
                        {{ $contract->position->title }}
                    </td>
                    <td class="contract__field field-date_to">
                        <p>{{ $contract->date_to }}</p>
                        @if ($contract->warning_class)
                            <span class="warning-icon" title="{{ $contract->warning_message }}">⚠️</span>
                        @endif
                    </td>
                    <td class="contract__field">
                        {{ $contract->emplContractType->title }}
                    </td>
                    <td class="contract__controls">
                        <form method="GET" action="{{ route('contracts.update-form', ['id' => $contract->id]) }}">
                            <button type="submit">
                                Редактировать
                            </button>
                        </form>
                        /
                        <form method="POST" action="{{ route('contracts.delete', ['id' => $contract->id]) }}">
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

    <div id="sidebar" class="sidebar">
        <button class="close-sidebar" id="close-sidebar">
            <p>&times;</p>
        </button>
        <form method="GET" action="{{ route('contracts.filter') }}">
            @csrf
            {{-- <h3>Фильтры</h3>
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
            </div> --}}

            <h3>Сортировка</h3>
            <div class="filter-group">
                <p><input type="radio" name="sort" value="fio-asc">А-Я ФИО</p>
                <p><input type="radio" name="sort" value="fio-desc">Я-А ФИО</p>
                <p><input type="radio" name="sort" value="position-asc">А-Я Должность</p>
                <p><input type="radio" name="sort" value="position-desc">Я-А Должность</p>
                <p><input type="radio" name="sort" value="date_to-asc">Действует по, по возрастанию</p>
                <p><input type="radio" name="sort" value="date_to-desc">Действует по, по убыванию</p>
            </div>

            <button type="submit">Применить</button>
        </form>
    </div>
@section('scripts')
    <script src="{{ asset('js/EmplContracts/contracts.js') }}"></script>
    <script src="{{ asset('js/filter-sidebar/sidebar.js') }}"></script>
@endsection
@endsection
