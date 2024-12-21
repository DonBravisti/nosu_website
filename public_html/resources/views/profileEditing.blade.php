@extends('layout.layout')
@section('content')
    @include('partial.navPath')
    <div class="content-container">
        <div class="general-info">
            <h2 class="section-title">Редактировать профиль сотрудника</h2>
            <div class="general-info-body">
                <div class="image-editing-block">
                    <div class="director-photo-block">
                        <img src="/images/avatar.jpg" class="image-editing__pic director__photo">
                    </div>
                    <form action="#">
                        <button class="image-editing-btn" type="submit">
                            <img src="/images/camera.png" class="image-editing-btn__pic">
                            <p class="image-editing-btn__text">Добавить фото</p>
                        </button>
                    </form>
                </div>
                <div class="general-info-editing-block">
                    <form method="post" action="/edit/{{ $id }}/update">

                        @include('partial.errorChecking')

                        <p class="general-info-input__name big-general-info-input__name">ФИО</p>
                        <input type="text" class="general-info__input big-general-info__input" name="FIO"
                            value="{{ $fio }}" placeholder="не заполнено">

                        <p class="general-info-input__name big-general-info-input__name">Пол</p>
                        <div class="radio-buttons">
                            <div class="radio-button">
                                <input type="radio" name="sex" value="1" id="male"
                                    @checked($sex == 1)>
                                <label for="male">Мужской</label>
                            </div>
                            <div class="radio-button">
                                <input type="radio" name="sex" value="0" id="female"
                                    @checked($sex == 0)>
                                <label for="female">Женский</label>
                            </div>
                        </div>

                        <p class="general-info-input__name big-general-info-input__name">Адрес</p>
                        <input type="text" name="address" class="general-info__input big-general-info__input"
                            value="{{ $address }}">

                        <p class="general-info-input__name big-general-info-input__name">Дата рождения</p>
                        <input type="date" name="birthdate" class="general-info__input big-general-info__input"
                            value="{{ $birthdate }}">

                        <p class="general-info-input__name big-general-info-input__name">Телефон</p>
                        <input type="tel" name="phone" class="general-info__input big-general-info__input"
                            value="{{ $phone }}">

                        <p class="general-info-input__name big-general-info-input__name">Email</p>
                        <input type="email" name="email" class="general-info__input big-general-info__input"
                            value="{{ $email }}">

                        <p class="general-info-input__name">Ученое звание</p>
                        <select name="selectTitle">
                            @foreach ($titles as $title)
                                <option @selected($title->id == $emplTitle->title_id) value="{{ $title->id }}">{{ $title->title }}
                                </option>
                            @endforeach
                        </select>

                        <p class="general-info-input__name">Ученая степень 1</p>
                        <select name="degree_1">
                            @foreach ($degrees as $degree)
                                <option @selected($degree->id == $emplDegree1->degree_id) value="{{ $degree->id }}">{{ $degree->title }}
                                </option>
                            @endforeach
                        </select>

                        <p class="general-info-input__name">Ученая степень 2</p>
                        <select name="degree_2">
                            @foreach ($degrees as $degree)
                                <option @selected($degree->id == $emplDegree2->degree_id) value="{{ $degree->id }}">{{ $degree->title }}
                                </option>
                            @endforeach
                        </select>

                        <p class="general-info-input__name edu-level__label">Уровень образования</p>

                        <p class="general-info-input__name edu-level__sublabel">Бакалавриат</p>
                        <p class="general-info-input__name">Специализация</p>
                        <input type="text" class="general-info__input" name="bachelor_speciality"
                            placeholder="не заполнено" value="{{ old('bachelor_speciality', $bachelor_speciality) }}">
                        <p class="general-info-input__name">Квалификация</p>
                        <input type="text" class="general-info__input" name="bachelor_qualification"
                            placeholder="не заполнено"
                            value="{{ old('bachelor_qualification', $bachelor_qualification) }}">

                        <p class="general-info-input__name edu-level__sublabel">Магистратура</p>
                        <p class="general-info-input__name">Специализация</p>
                        <input type="text" class="general-info__input" name="master_speciality"
                            placeholder="не заполнено" value="{{ old('master_speciality', $master_speciality) }}">
                        <p class="general-info-input__name">Квалификация</p>
                        <input type="text" class="general-info__input" name="master_qualification"
                            placeholder="не заполнено" value="{{ old('master_qualification', $master_qualification) }}">

                        <p class="general-info-input__name edu-level__sublabel">Специалитет</p>
                        <p class="general-info-input__name">Специализация</p>
                        <input type="text" class="general-info__input" name="specialist_speciality"
                            placeholder="не заполнено" value="{{ old('specialist_speciality', $specialist_speciality) }}">
                        <p class="general-info-input__name">Квалификация</p>
                        <input type="text" class="general-info__input" name="specialist_qualification"
                            placeholder="не заполнено"
                            value="{{ old('specialist_qualification', $specialist_qualification) }}">

                        <p class="general-info-input__name edu-level__sublabel">Аспирантура</p>
                        <p class="general-info-input__name">Специализация</p>
                        <input type="text" class="general-info__input" name="phd_speciality"
                            placeholder="не заполнено" value="{{ old('phd_speciality', $phd_speciality) }}">
                        <p class="general-info-input__name">Квалификация</p>
                        <input type="text" class="general-info__input" name="phd_qualification"
                            placeholder="не заполнено" value="{{ old('phd_qualification', $phd_qualification) }}">

                        <div class="math-websites-editing">
                            <div class="math-websites-editing-body">
                                <div class="math-websites-editing-el">
                                    <p class="math-websites-editing__text">Укажите URL - адрес для Orcid</p>
                                    <div class="math-websites-editing-input-block">
                                        <div class="math-websites-editing-form-input-block">
                                            <input name="orcid" type="text" class="math-websites-editing__input"
                                                value="{{ $orcid }}">
                                            {{-- <button class="clip__btn" type="submit"></button> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="math-websites-editing-el">
                                    <p class="math-websites-editing__text">Укажите URL - адрес для Elsevier Scopus</p>
                                    <div class="math-websites-editing-input-block">
                                        <div class="math-websites-editing-form-input-block">
                                            <input name="scopus" type="text" class="math-websites-editing__input"
                                                value="{{ $scopus }}">
                                            {{-- <button class="clip__btn" type="submit"></button> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="math-websites-editing-el">
                                    <p class="math-websites-editing__text">Укажите URL - адрес для Math-Net.ru</p>
                                    <div class="math-websites-editing-input-block">
                                        <div class="math-websites-editing-form-input-block">
                                            <input name="math-net" type="text" class="math-websites-editing__input"
                                                value="{{ $mathnet }}">
                                            {{-- <button class="clip__btn" type="submit"></button> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="math-websites-editing-el">
                                    <p class="math-websites-editing__text">Укажите URL - адрес для Clarivate</p>
                                    <div class="math-websites-editing-input-block">
                                        <div class="math-websites-editing-form-input-block">
                                            <input name="clarivate" type="text" class="math-websites-editing__input"
                                                value="{{ $clarivate }}">
                                            {{-- <button class="clip__btn" type="submit"></button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="login-btn" type="submit">
                            <div class="login-btn__text">Сохранить</div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
