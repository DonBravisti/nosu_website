@extends('layout.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/EduPlan/titles.css') }}">
@endsection

@section('content')
    <section>
        <a href="{{ route('edu-plan.specialities') }}">Вернуться к списку специальностей</a>

        <h2 class="title">Титульные листы для специальности: {{ $speciality->cod }} "{{ $speciality->title }}"</h2>

        <a href="{{ route('edu-plan.title.create', $speciality->id) }}" class="btn-add">Добавить титул</a>

        <table class="titles__table">
            <thead>
                <tr>
                    <th>Профиль</th>
                    <th>Год поступления</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($titles as $title)
                    <tr>
                        <td>{{ $title->profile }}</td>
                        <td>{{ $title->date_enter }}</td>
                        <td>{{ $title->included ? 'Активный' : 'Черновик' }}</td>
                        <td>
                            <a href="{{ route('edu-plan.plans', $title->id) }}">Учебные планы</a> |
                            <a href="{{ route('edu-plan.title.edit', $title->id) }}">Редактировать</a> |
                            <form action="{{ route('edu-plan.title.delete', $title->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete" type="submit" onclick="return confirm('Удалить титул?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
