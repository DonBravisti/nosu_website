@extends('layout.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/EduPlan/plans.css') }}">
@endsection

@section('content')
    <section>
        <a href="{{ route('edu-plan.titles', $title->spec_id) }}">Вернуться к титульным листам</a>

        <h2 class="title">
            Учебные планы для титула:
            "{{ $title->speciality->cod }} {{ $title->speciality->title }} / {{ $title->profile }} / Год поступления:
            {{ $title->date_enter }}"
        </h2>

        <a href="{{ route('edu-plan.plan.create', $title->id) }}" class="btn-add">Добавить план</a>

        <table class="plans__table">
            <thead>
                <tr>
                    <th>Дисциплина</th>
                    <th>Кафедра</th>
                    <th>Блок</th>
                    <th>Код дисциплины</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                    <tr>
                        <td>{{ $plan->subject->title ?? '—' }}</td>
                        <td>{{ $plan->department->title ?? '—' }}</td>
                        <td>{{ $plan->block->block_title ?? '—' }} {{ $plan->block->part_title ?? '' }}</td>
                        <td>{{ $plan->code_subject }}</td>
                        <td>
                            <a href="{{ route('edu-plan.plan.edit', $plan->id) }}">Редактировать</a> |
                            <form action="{{ route('edu-plan.plan.delete', $plan->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete" type="submit" onclick="return confirm('Удалить учебный план?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
