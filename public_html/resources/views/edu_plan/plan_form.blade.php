@extends('layout.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/EduPlan/plan_form.css') }}">
@endsection

@section('content')
    <section>
        <a
            href="{{ isset($plan) ? route('edu-plan.plans', $plan->title_plan_id) : route('edu-plan.plans', $title->id) }}">
            Вернуться к учебным планам
        </a>

        <h2 class="title">
            {{ isset($plan) ? 'Редактирование учебного плана' : 'Создание учебного плана' }}
        </h2>

        <form method="POST"
            action="{{ isset($plan) ? route('edu-plan.plan.update', $plan->id) : route('edu-plan.plan.store', $title->id) }}">
            @csrf
            @if (isset($plan))
                @method('PUT')
            @endif

            @include('partial.errorChecking')

            <div class="field">
                <label>Блок</label>
                <select name="block_id">
                    @foreach ($blocks as $block)
                        <option value="{{ $block->id }}" @selected(old('block_id', $plan->block_id ?? '') == $block->id)>
                            {{ $block->block_title }} - {{ $block->part_title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>Дисциплина</label>
                <select name="subject_id">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" @selected(old('subject_id', $plan->subject_id ?? '') == $subject->id)>
                            {{ $subject->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>Кафедра</label>
                <select name="department_id">
                    @foreach ($departments as $dep)
                        <option value="{{ $dep->id }}" @selected(old('department_id', $plan->department_id ?? '') == $dep->id)>
                            {{ $dep->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>Код дисциплины</label>
                <input required type="text" name="code_subject" value="{{ old('code_subject', $plan->code_subject ?? '') }}">
            </div>

            <button type="submit">{{ isset($plan) ? 'Сохранить' : 'Создать' }}</button>
        </form>
    </section>
@endsection
