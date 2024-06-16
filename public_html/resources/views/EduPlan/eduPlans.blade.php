@extends('layout.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/eduPlans.css') }}">
@endsection

@section('content')
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
                    <td class="plan__controls">
                        <form method="GET" action="{{ route('edu-plan.update-form', ['id' => $plan->id]) }}">
                            <button type="submit">
                                Редактировать
                            </button>
                        </form>
                        /
                        <form method="POST" action="{{ route('edu-plan.delete', ['id' => $plan->id]) }}">
                            @method('DELETE')

                            <button type="submit" onclick="return ConfirmDelete()">
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $plans->links() }}
    </section>
@section('scripts')
    <script src="{{ asset('js/eduPlans.js') }}"></script>
@endsection
@endsection
