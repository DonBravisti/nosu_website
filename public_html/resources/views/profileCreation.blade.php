@extends('layout.layout')
@section('content')
    @include('partial.navPath')
    <div class="content-container">
        <div class="general-info">
            <h2 class="section-title">Добавить нового сотрудника</h2>
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
                    <form method="post" action="/create">

                        @include('partial.errorChecking')

                        <p class="general-info-input__name big-general-info-input__name">ФИО</p>
                        <input type="text" class="general-info__input big-general-info__input" name="FIO"
                            value="{{ old('FIO') }}" placeholder="не заполнено">
                        <p class="general-info-input__name big-general-info-input__name">Пол</p>
                        <div class="radio-buttons">
                            <div class="radio-button">
                                <input type="radio" name="sex" value="1" id="male" checked>
                                <label for="male">Мужчина</label>
                            </div>
                            <div class="radio-button">
                                <input type="radio" name="sex" value="0" id="female">
                                <label for="female">Женщина</label>
                            </div>
                        </div>
                        <p class="general-info-input__name big-general-info-input__name">Адрес</p>
                        <input type="text" name="address" id=""
                            class="general-info__input big-general-info__input" value="{{ old('address') }}">
                        <p class="general-info-input__name big-general-info-input__name">Дата рождения</p>
                        <input type="date" name="birthdate" id=""
                            class="general-info__input big-general-info__input" value="{{ old('birthdate') }}">
                        <p class="general-info-input__name big-general-info-input__name">Телефон</p>
                        <input type="tel" name="phone" id=""
                            class="general-info__input big-general-info__input" value="{{ old('phone') }}">
                        <p class="general-info-input__name big-general-info-input__name">Email</p>
                        <input type="email" name="email" id=""
                            class="general-info__input big-general-info__input" value="{{ old('email') }}">


                        <!-- <p class="general-info-input__name big-general-info-input__name">Должность</p> -->
                        <!-- <input type="text" class="general-info__input big-general-info__input" placeholder="не заполнено"> -->
                        <p class="general-info-input__name">Ученое звание</p>
                        <select name="selectTitle" id="">
                            @foreach ($titles as $title)
                                <option value="{{ $title->id }}">{{ $title->title }}</option>
                            @endforeach
                        </select>
                        <p class="general-info-input__name">Ученая степень</p>
                        <select name="selectDegree" id="">
                            @foreach ($degrees as $degree)
                                <option value="{{ $degree->id }}">{{ $degree->title }}</option>
                            @endforeach
                        </select>
                        <p class="general-info-input__name">Базовое образование</p>
                        <input type="text" class="general-info__input" name="baseEdu" placeholder="не заполнено"
                            value="{{ old('baseEdu') }}">
                        <label for="qualification" class="general-info-input__name">Квалификация</label>
                        <input type="text" class="general-info__input" name="qualification" id="qualification"
                            placeholder="не заполнено" value="{{ old('qualification') }}">



                        <div class="math-websites-editing">
                            <div class="math-websites-editing-body">
                                <div class="math-websites-editing-el">
                                    <p class="math-websites-editing__text">Укажите URL - адрес для Orcid</p>
                                    <div class="math-websites-editing-input-block">
                                        <!-- <form action="#" class="math-websites-editing-form"> -->
                                        <div class="math-websites-editing-form-input-block">
                                            <input name="orcid" type="text" class="math-websites-editing__input"
                                                value="{{ old('orcid') }}">
                                            <button class="clip__btn" type="submit"></button>
                                        </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                                <div class="math-websites-editing-el">
                                    <p class="math-websites-editing__text">Укажите URL - адрес для Elsevier Scopus</p>
                                    <div class="math-websites-editing-input-block">
                                        <!-- <form action="#" class="math-websites-editing-form"> -->
                                        <div class="math-websites-editing-form-input-block">
                                            <input name="scopus" type="text" class="math-websites-editing__input"
                                                value="{{ old('scopus') }}">
                                            <button class="clip__btn" type="submit"></button>
                                        </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                                <div class="math-websites-editing-el">
                                    <p class="math-websites-editing__text">Укажите URL - адрес для Math-Net.ru</p>
                                    <div class="math-websites-editing-input-block">
                                        <!-- <form action="#" class="math-websites-editing-form"> -->
                                        <div class="math-websites-editing-form-input-block">
                                            <input name="math-net" type="text" class="math-websites-editing__input"
                                                value="{{ old('math-net') }}">
                                            <button class="clip__btn" type="submit"></button>
                                        </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                                <div class="math-websites-editing-el">
                                    <p class="math-websites-editing__text">Укажите URL - адрес для Clarivate</p>
                                    <div class="math-websites-editing-input-block">
                                        <!-- <form action="#" class="math-websites-editing-form"> -->
                                        <div class="math-websites-editing-form-input-block">
                                            <input name="clarivate" type="text" class="math-websites-editing__input"
                                                value="{{ old('clarivate') }}">
                                            <button class="clip__btn" type="submit"></button>
                                        </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                            </div>
                        </div>



                        <button class="login-btn" type="submit">
                            <div class="login-btn__text">Добавить</div>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="detail-info-editing">
            <div class="detail-info">
                <h2 class="detail-info-editing__text">Повышение квалификации</h2>
                <a href="">Открыть форму</a>
            </div>
            <div class="detail-info">
                <h2 class="detail-info-editing__text">Основные публикации</h2>
                <a href="">Открыть форму</a>
            </div>
            <div class="detail-info">
                <h2 class="detail-info-editing__text">Награды и почетные звания</h2>
                <a href="">Открыть форму</a>
            </div>
            <div class="detail-info">
                <h2 class="detail-info-editing__text">Трудовые договора</h2>
                <a href="">Открыть форму</a>
            </div>
        </div>
    </div>
@endsection
