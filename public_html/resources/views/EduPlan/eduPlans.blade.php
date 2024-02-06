@extends('layout.layout')
@section('content')
    <style>
        .title {
            margin: 0 auto;
            width: fit-content;
        }

        .plans__table {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        td{
            text-align: center;
        }

        .table__headers {}

        .plans-table__row {}
    </style>

    <section>
        <a href="{{route('edu-plan.add')}}">Новый план</a>
        <h2 class="title">Учебные планы</h2>
        <table class="plans__table">
            <tr class="table__headers">
                <th>№</th>
                <th>Предмет</th>
                <th>Кафедра</th>
                <th>Тиутльный лист(есть\нет)</th>
            </tr>
            @foreach ($plans as $id => $plan)
                <tr class="plans-table__row">
                    <td>{{ ++$id }}</td>
                    <td>{{ $plan->subject->title }}</td>
                    <td>{{ $plan->department->title }}</td>
                    <td>ниче не знаю</td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
