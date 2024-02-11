@extends('layout.layout')
@section('content')
    <style>
        .title {
            margin: 0 auto;
            width: fit-content;
        }

        .field {
            margin-top: 20px;
        }

        section{
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        button[type='submit']{
            margin-top: 20px;
            width: 150px;
            height: 30px;
        }
    </style>

    <section>
        <a href="{{ route('edu-plan.list') }}">Вернуться к списку Учебных планов</a>

        <h2 class="title">Новый учебный план</h2>
        <form action="{{ route('edu-plan.send') }}" method="POST">

            @include('partial.errorChecking')

            <div class="field">
                <label for="block">Блок плана</label>
                <select name="blockId" id="block">
                    @foreach ($blocks as $block)
                        <option value="{{ $block->id }}">{{ $block->block_title }} - {{ $block->part_title }}</option>
                        <p>bla</p>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label for="subject">Дисциплина</label>
                <select name="subjectId" id="subject">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label for="department">Кафедра</label>
                <select name="departmentId" id="department">
                    @foreach ($departments as $dep)
                        <option value="{{ $dep->id }}">{{ $dep->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label for="code-subject">Код дисциплины</label>
                <input id="code-subject" name="codeSubject" type="text">
            </div>
            <input type="text" value="0" name="titlePlanId" hidden>

            <button type="submit">Добавить план</button>
        </form>
    </section>
@endsection
