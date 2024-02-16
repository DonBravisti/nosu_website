@extends('layout.layout')
@section('content')
    <style>
        .title {
            margin: 0 auto;
            width: fit-content;
        }

        .field {
            margin-bottom: 20px;
        }

        section {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        button[type='submit'] {
            display: block;
            font-size: 20px;
            margin: 20px auto 0;
            width: 300px;
            height: 50px;
        }

        .included__option {
            display: flex;
            align-items: center;
        }
    </style>

    <section>
        <a href="{{ route('edu-plan.list') }}">Вернуться к списку Учебных планов</a>

        <h2 class="title">Новый учебный план</h2>
        <form action="{{ route('edu-plan.send') }}" method="POST">

            @include('partial.errorChecking')
            <div class="edu-plan__block">
                <div class="field">
                    <label for="block">Блок плана</label>
                    <select name="blockId" id="block">
                        @foreach ($blocks as $block)
                            <option value="{{ $block->id }}">{{ $block->block_title }} - {{ $block->part_title }}
                            </option>
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
                    <input id="code-subject" name="codeSubject" type="text" value="{{ old('codeSubject') }}">
                </div>
                <input type="text" value="0" name="titlePlanId" hidden>
            </div>

            <h2 class="title">Титульный лист учебного плана</h2>
            <div class="title-plan__block">
                <div class="field">
                    <label for="spec">Специальность</label>
                    <select name="spec" id="spec">
                        @foreach ($specs as $spec)
                            <option value="{{ $spec->id }}">{{ $spec->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="profile">Профиль</label>
                    <input type="text" id="profile" name="profile" value="{{ old('profile') }}">
                </div>
                <div class="field">
                    <label for="date-uhsovet">Дата протокола ученого совета</label>
                    <input type="date" id="date-uhsovet" name="dateUchsovet" value="{{ old('dateUchsovet') }}">
                </div>
                <div class="field">
                    <label for="number-uhsovet">Номер протокола ученого совета</label>
                    <input type="number" id="number-uhsovet" name="numberUchsovet" value="{{ old('numberUchsovet') }}">
                </div>
                <div class="field">
                    <label for="current-year">Текущий год</label>
                    <select name="currentYear" id="current-year"></select>
                </div>
                <div class="field">
                    <label for="date-enter">Год поступления учащихся</label>
                    <select name="dateEnter" id="date-enter"></select>
                </div>
                <div class="field">
                    <label for="date-fgos">Дата протокола ФГОС</label>
                    <input type="date" id="date-fgos" name="dateFgos" value="{{ old('dateFgos') }}">
                </div>
                <div class="field">
                    <label for="number-fgos">Номер протокола ФГОС</label>
                    <input type="number" id="number-fgos" name="numberFgos" value="{{ old('numberFgos') }}">
                </div>
                <div class="field">
                    <fieldset>
                        <legend>Статус титульного листа</legend>

                        <div class="included__option">
                            <input type="radio" name="included" id="active" value="1">
                            <label for="active">Активный</label>
                        </div>
                        <div class="included__option">
                            <input type="radio" name="included" id="draft" value="0">
                            <label for="draft">Черновик</label>
                        </div>
                    </fieldset>
                </div>
            </div>

            <button type="submit">Добавить план</button>
        </form>
    </section>

    <script>
        let currentYear = new Date().getFullYear();
        for (let year = currentYear - 20; year <= currentYear; year++) {
            let optionCurrYear = document.createElement("OPTION");
            let optionDateEnter = document.createElement("OPTION");
            document.getElementById("current-year").appendChild(optionCurrYear).innerHTML = year;
            document.getElementById("date-enter").appendChild(optionDateEnter).innerHTML = year;
        }
    </script>
@endsection
