@extends('layout.layout')
@section('content')
    <style>
        .contracts__content {
            width: 1200px;
            margin: 0 auto;
        }

        .contract__field {
            text-align: left;
        }

        .contract__controls {
            display: flex;
            align-items: center;
        }
    </style>

    <section class="contracts">
        <a href="{{ route('contracts.add') }}">Добавить договор</a>
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
                <tr class="contract">
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
                    <td class="contract__field">
                        {{ $contract->date_to }}
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

    <script>
        function ConfirmDelete() {
            return confirm('Вы уверены? Договор будет удалён безвозвратно.');
        }
    </script>
@endsection
