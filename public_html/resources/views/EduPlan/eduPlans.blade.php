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

        td {
            text-align: center;
        }

        .pagination {
            list-style: none;
            display: flex;
            justify-content: center;
        }

        .page-item {
            margin-right: 5px;
        }
    </style>

    <section>
        <a href="{{ route('edu-plan.add') }}">Новый план</a>
        <h2 class="title">Учебные планы</h2>
        <table class="plans__table">
            <tr class="table__headers">
                <th>№</th>
                <th>Предмет</th>
                <th>Кафедра</th>
                <th>Тиутльный лист(есть\нет)</th>
            </tr>
            @foreach ($plans as $plan)
                <tr class="plans-table__row">
                    <td>{{ $plan->id }}</td>
                    <td>{{ $plan->subject->title }}</td>
                    <td>{{ $plan->department->title }}</td>
                    <td>{{ $plan->title_plan_id == '0' ? 'нет' : 'есть' }}</td>
                </tr>
            @endforeach
        </table>
        {{ $plans->links() }}
    </section>
@endsection
