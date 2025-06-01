@extends('layout.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/Empls/showEmployees.css') }}">
@endsection

@section('content')
    <section>
        <div class="workers-container">
            <div class="controls_container">
                <a class="action__link" href="{{ route('empls.add') }}">
                    <p>Создать сотрудника</p>
                </a>

                <form class="sort-filter" action="{{ route('empls.sort-filter') }}" method="post">
                    @csrf
                    <div class="sort-filter_container">
                        <div class="sort">
                            <label for="sort">Сортировка по ФИО</label>
                            <select name="sort" id="sort">
                                <option value="0" selected>А-Я</option>
                                <option value="1"
                                    @isset($sortBy)
                                        @selected($sortBy)
                                    @endisset>
                                    Я-А
                                </option>
                            </select>
                        </div>
                        <div class="filter">
                            <label for="filter">Фильтр по кафедре</label>
                            <select name="filter" id="filter">
                                <option value="0" selected>Нет</option>
                                @foreach ($departments as $dep)
                                    <option
                                        @isset($depId)
                                            @selected($depId == $dep->id)
                                        @endisset
                                        value="{{ $dep->id }}">{{ $dep->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Чекбокс для показа удаленных сотрудников -->
                        <div class="show-deleted">
                            <label for="show_deleted">Показывать удаленных</label>
                            <input type="checkbox" name="show_deleted" id="show_deleted"
                                {{ isset($showDeleted) && $showDeleted ? 'checked' : '' }}>
                        </div>

                        <button class="action__link" type="submit">
                            <p>Применить</p>
                        </button>
                    </div>
                </form>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Учёная степень</th>
                        <th>Кафедра</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empls as $empl)
                        @if ($empl->id != 0)
                            <tr>
                                <td>{{ $empl->FIO }}</td>
                                <td>{{ $empl->emplDegrees[0]->degree->title }}</td>
                                <td>
                                    @if ($empl->departments->isNotEmpty())
                                        {{ $empl->departments->pluck('title')->join(', ') }}
                                    @else
                                        Кафедра не указана
                                    @endif
                                </td>

                                {{-- <td>{{ $empl->department->title }}</td> --}}
                                <td>
                                    <a href="{{ route('empls.edit', ['id' => $empl->id]) }}"
                                        class="btn btn-sm btn-warning">Редактировать</a>

                                    @if ($empl->deleted)
                                        <!-- Кнопка для безвозвратного удаления -->
                                        <button class="btn btn-sm btn-danger"
                                            onclick="confirmPermanentDelete({{ $empl->id }})">Удалить
                                            безвозвратно</button>
                                        <form id="permanent-delete-form-{{ $empl->id }}"
                                            action="{{ route('empls.permanentDelete', ['id' => $empl->id]) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <!-- Кнопка для восстановления сотрудника -->
                                        <button class="btn btn-sm btn-primary"
                                            onclick="confirmRestore({{ $empl->id }})">Восстановить</button>
                                        <form id="restore-form-{{ $empl->id }}"
                                            action="{{ route('empls.restore', ['id' => $empl->id]) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    @else
                                        <!-- Кнопка для пометки как удаленного -->
                                        <button class="btn btn-sm btn-secondary"
                                            onclick="confirmMarkAsDeleted({{ $empl->id }})">Пометить удаленным</button>
                                        <form id="mark-as-deleted-form-{{ $empl->id }}"
                                            action="{{ route('empls.markAsDeleted', ['id' => $empl->id]) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    @endif

                                    <a href={{ route('pers-card', ['id' => $empl->id]) }}
                                        class="btn btn-sm btn-info">Узнать больше</a>

                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Модальное окно для подтверждения безвозвратного удаления -->
        <div id="confirmDeleteModal" class="modal">
            <div class="modal-content">
                <h4>Вы уверены?</h4>
                <p>Вы хотите удалить этого сотрудника безвозвратно? Вся информация о нем будет также удалена безвозвратно.
                </p>
            </div>
            <div class="modal-footer">
                <button id="cancelDeleteButton" class="btn">Отмена</button>
                <button id="confirmDeleteButton" class="btn btn-danger">Да, удалить</button>
            </div>
        </div>

        <!-- Модальное окно для подтверждения пометки как удаленного -->
        <div id="confirmMarkAsDeletedModal" class="modal">
            <div class="modal-content">
                <h4>Вы уверены?</h4>
                <p>Вы хотите пометить этого сотрудника как удаленного? Вы сможете восстановить его позже.</p>
            </div>
            <div class="modal-footer">
                <button id="cancelMarkButton" class="btn">Отмена</button>
                <button id="confirmMarkButton" class="btn btn-secondary">Да, пометить</button>
            </div>
        </div>

        <!-- Модальное окно для подтверждения восстановления -->
        <div id="confirmRestoreModal" class="modal">
            <div class="modal-content">
                <h4>Вы уверены?</h4>
                <p>Вы хотите восстановить этого сотрудника?</p>
            </div>
            <div class="modal-footer">
                <button id="cancelRestoreButton" class="btn">Отмена</button>
                <button id="confirmRestoreButton" class="btn btn-secondary">Да, восстановить</button>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/Empls/showEmployees.js') }}"></script>
    <script>
        let employeeIdToDelete = null;
        let employeeIdToMark = null;
        let employeeIdToRestore = null;

        function confirmPermanentDelete(employeeId) {
            employeeIdToDelete = employeeId;
            document.getElementById('confirmDeleteModal').style.display = 'block';
        }

        function confirmMarkAsDeleted(employeeId) {
            employeeIdToMark = employeeId;
            document.getElementById('confirmMarkAsDeletedModal').style.display = 'block';
        }

        function confirmRestore(employeeId) {
            employeeIdToRestore = employeeId;
            document.getElementById('confirmRestoreModal').style.display = 'block';
        }

        document.getElementById('cancelDeleteButton').addEventListener('click', function() {
            document.getElementById('confirmDeleteModal').style.display = 'none';
            employeeIdToDelete = null;
        });

        document.getElementById('confirmDeleteButton').addEventListener('click', function() {
            if (employeeIdToDelete) {
                document.getElementById('permanent-delete-form-' + employeeIdToDelete).submit();
            }
        });

        document.getElementById('cancelMarkButton').addEventListener('click', function() {
            document.getElementById('confirmMarkAsDeletedModal').style.display = 'none';
            employeeIdToMark = null;
        });

        document.getElementById('confirmMarkButton').addEventListener('click', function() {
            if (employeeIdToMark) {
                document.getElementById('mark-as-deleted-form-' + employeeIdToMark).submit();
            }
        });

        document.getElementById('cancelRestoreButton').addEventListener('click', function() {
            document.getElementById('confirmRestoreModal').style.display = 'none';
            employeeIdToRestore = null;
        });

        document.getElementById('confirmRestoreButton').addEventListener('click', function() {
            if (employeeIdToRestore) {
                document.getElementById('restore-form-' + employeeIdToRestore).submit();
            }
        });
    </script>
@endsection
