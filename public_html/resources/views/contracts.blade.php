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
    </style>

    <section class="contracts">
        <a href="{{ route('contracts.add') }}">Добавить договор</a>
        <table class="contracts__content">
            <tr>
                <th class="contract__field">
                    №
                </th>
                <th class="contract__field">
                    Номер
                </th>
                <th class="contract__field">
                    ФИО
                </th>
                <th class="contract__field">
                    Должность
                </th>
                <th class="contract__field">
                    Действует с
                </th>
                <th class="contract__field">
                    Действует по
                </th>
            </tr>
            @foreach ($contracts as $key => $contract)
                <tr class="contract">
                    <td class="contract__field">
                        {{ ++$key }}
                    </td>
                    <td class="contract__field">
                        {{ $contract->number }}
                    </td>
                    <td class="contract__field">
                        <?php
                        $emplId = $contract->employee_id - 1;
                        $employee = $employees[$emplId];
                        $fio = sprintf('%s %s %s', $employee->surname, $employee->name, $employee->patronimyc);
                        echo $fio;
                        ?>
                    </td>
                    <td class="contract__field">
                        <?php
                        $positionId = $contract->position_id - 1;
                        $position = $positions[$positionId];
                        echo $position->title;
                        ?>
                    </td>
                    <td class="contract__field">
                        {{ $contract->date_from }}
                    </td>
                    <td class="contract__field">
                        {{ $contract->date_to }}
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
