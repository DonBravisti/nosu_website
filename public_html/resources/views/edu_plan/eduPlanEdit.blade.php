@extends('layout.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/EduPlan/eduPlanEdit.css') }}">
@endsection
@section('content')
    <section>
        <a href="{{ route('edu-plan.list') }}">Вернуться к списку Учебных планов(Изменения не сохранятся)</a>

        <h2 class="title">Редактирование учебного плана</h2>
        <form action="{{ route('edu-plan.update', ['id' => $eduPlan->id]) }}" method="POST">

            @method('PUT')
            @include('partial.errorChecking')

            <div class="edu-plan__block">
                <div class="field">
                    <label for="block">Блок плана</label>
                    <select name="blockId" id="block">
                        @foreach ($blocks as $block)
                            <option @selected($block->id == $eduPlan->block_id) value="{{ $block->id }}">
                                {{ $block->block_title }} - {{ $block->part_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="subject">Дисциплина</label>
                    <select name="subjectId" id="subject">
                        @foreach ($subjects as $subject)
                            <option @selected($subject->id == $eduPlan->subject_id) value="{{ $subject->id }}">
                                {{ $subject->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="department">Кафедра</label>
                    <select name="departmentId" id="department">
                        @foreach ($departments as $dep)
                            <option @selected($dep->id == $eduPlan->department_id) value="{{ $dep->id }}">
                                {{ $dep->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="code-subject">Код дисциплины</label>
                    <input id="code-subject" name="codeSubject" type="text" value="{{ $eduPlan->code_subject }}">
                </div>
                <input type="text" value="0" name="titlePlanId" hidden>
            </div>

            <h2 class="title">Титульный лист учебного плана</h2>
            <div class="title-plan__block">
                <div class="field">
                    <label for="spec">Специальность</label>
                    <select name="spec" id="spec">
                        @foreach ($specs as $spec)
                            <option @selected($spec->id == $titlePlan->spec_id) value="{{ $spec->id }}">{{ $spec->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="profile">Профиль</label>
                    <input type="text" id="profile" name="profile" value="{{ $titlePlan->profile }}">
                </div>
                <div class="field">
                    <label for="date-uhsovet">Дата протокола ученого совета</label>
                    <input type="date" id="date-uhsovet" name="dateUchsovet" value="{{ $titlePlan->date_uchsovet }}">
                </div>
                <div class="field">
                    <label for="number-uhsovet">Номер протокола ученого совета</label>
                    <input type="number" id="number-uhsovet" name="numberUchsovet"
                        value="{{ $titlePlan->number_uchsovet }}">
                </div>
                <div class="field">
                    <label for="current-year">Текущий год</label>
                    <input type="text" name="currentYear" id="current-year" maxlength="4"
                        value="{{ $titlePlan->current_year }}">
                </div>
                <div class="field">
                    <label for="date-enter">Год поступления учащихся</label>
                    <input type="text" name="dateEnter" id="date-enter" maxlength="4"
                        value="{{ $titlePlan->date_enter }}">
                </div>
                <div class="field">
                    <label for="date-fgos">Дата протокола ФГОС</label>
                    <input type="date" id="date-fgos" name="dateFgos" value="{{ $titlePlan->date_fgos }}">
                </div>
                <div class="field">
                    <label for="number-fgos">Номер протокола ФГОС</label>
                    <input type="number" id="number-fgos" name="numberFgos" value="{{ $titlePlan->number_fgos }}">
                </div>
                <div class="field">
                    <fieldset>
                        <legend>Статус титульного листа</legend>

                        <div class="included__option">
                            <input @checked($titlePlan->included == '1') type="radio" name="included" id="active"
                                value="1">
                            <label for="active">Активный</label>
                        </div>
                        <div class="included__option">
                            <input @checked($titlePlan->included == '0') type="radio" name="included" id="draft"
                                value="0">
                            <label for="draft">Черновик</label>
                        </div>
                    </fieldset>
                </div>
            </div>

            <button type="submit">Сохранить изменения</button>
        </form>
    </section>
@section('scripts')
    <script src="{{ asset('js/EduPlan/eduPlanEdit.js') }}"></script>
@endsection
@endsection
