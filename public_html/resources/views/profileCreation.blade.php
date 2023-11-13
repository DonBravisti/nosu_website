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
					@if (count($errors) > 0)
					<div style="background-color:lightcoral">
						<ul>
							@foreach ($errors->all() as $error)
							<li style="color: red;">{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@elseif (session('success'))
					<div style="background-color: lightgreen;">
						<p style="color: green;">{{ session('success') }}</p>
					</div>
					@endif

					<p class="general-info-input__name big-general-info-input__name">ФИО</p>
					<input type="text" class="general-info__input big-general-info__input" name="FIO" value="{{ old('FIO') }}" placeholder="не заполнено">
					<p class="general-info-input__name big-general-info-input__name">Пол</p>
					<div>
						<input type="radio" name="sex" value="1" id="male" checked>
						<label for="male">Мужчина</label>
					</div>
					<div>
						<input type="radio" name="sex" value="0" id="female">
						<label for="female">Женщина</label>
					</div>
					<p class="general-info-input__name big-general-info-input__name">Адрес</p>
					<input type="text" name="address" id="" class="general-info__input big-general-info__input" value="{{ old('address') }}">
					<p class="general-info-input__name big-general-info-input__name">Дата рождения</p>
					<input type="date" name="birthdate" id="" class="general-info__input big-general-info__input" value="{{ old('birthdate') }}">
					<p class="general-info-input__name big-general-info-input__name">Телефон</p>
					<input type="tel" name="phone" id="" class="general-info__input big-general-info__input" value="{{ old('phone') }}">
					<p class="general-info-input__name big-general-info-input__name">Email</p>
					<input type="email" name="email" id="" class="general-info__input big-general-info__input" value="{{ old('email') }}">


					<p class="general-info-input__name big-general-info-input__name">Должность</p>
					<!-- <input type="text" class="general-info__input big-general-info__input" placeholder="не заполнено"> -->
					<p class="general-info-input__name">Ученое звание</p>
					<select name="selectTitle" id="">
						<option value="{{$titles[0]->id}}">{{$titles[0]->title}}</option>
						<option value="{{$titles[1]->id}}">{{$titles[1]->title}}</option>
					</select>
					<p class="general-info-input__name">Ученая степень</p>
					<select name="selectDegree" id="">
						<option value="{{$degrees[0]->id}}">{{$degrees[0]->title}}</option>
						<option value="{{$degrees[1]->id}}">{{$degrees[1]->title}}</option>
					</select>
					<p class="general-info-input__name">Базовое образование</p>
					<!-- <input type="text" class="general-info__input" placeholder="не заполнено"> -->

					<button type="submit">Добавить</button>
				</form>
			</div>
		</div>
	</div>
	<div class="math-websites-editing">
		<div class="math-websites-editing-body">
			<div class="math-websites-editing-el">
				<div class="math-websites-editing-icon-block">
					<img src="/images/orcid.png" class="math-websites-editing__icon">
				</div>
				<p class="math-websites-editing__text">Укажите URL - адрес</p>
				<div class="math-websites-editing-input-block">
					<form action="#" class="math-websites-editing-form">
						<div class="math-websites-editing-form-input-block">
							<input type="text" class="math-websites-editing__input">
							<button class="clip__btn" type="submit"></button>
						</div>
					</form>
				</div>
			</div>
			<div class="math-websites-editing-el">
				<div class="math-websites-editing-icon-block">
					<img src="/images/elsevier.png" class="math-websites-editing__icon">
				</div>
				<p class="math-websites-editing__text">Укажите URL - адрес</p>
				<div class="math-websites-editing-input-block">
					<form action="#" class="math-websites-editing-form">
						<div class="math-websites-editing-form-input-block">
							<input type="text" class="math-websites-editing__input">
							<button class="clip__btn" type="submit"></button>
						</div>
					</form>
				</div>
			</div>
			<div class="math-websites-editing-el">
				<div class="math-websites-editing-icon-block">
					<img src="/images/math-net.png" class="math-websites-editing__icon">
				</div>
				<p class="math-websites-editing__text">Укажите URL - адрес</p>
				<div class="math-websites-editing-input-block">
					<form action="#" class="math-websites-editing-form">
						<div class="math-websites-editing-form-input-block">
							<input type="text" class="math-websites-editing__input">
							<button class="clip__btn" type="submit"></button>
						</div>
					</form>
				</div>
			</div>
			<div class="math-websites-editing-el">
				<div class="math-websites-editing-icon-block">
					<img src="/images/clarivate.png" class="math-websites-editing__icon">
				</div>
				<p class="math-websites-editing__text">Укажите URL - адрес</p>
				<div class="math-websites-editing-input-block">
					<form action="#" class="math-websites-editing-form">
						<div class="math-websites-editing-form-input-block">
							<input type="text" class="math-websites-editing__input">
							<button class="clip__btn" type="submit"></button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<form action="#">
			<button class="editing-add__btn" type="submit">+ Добавить</button>
		</form>
	</div>
	<div class="detail-info-editing">
		<h2 class="detail-info-editing__text">Повышение квалификации</h2>
		<form action="#">
			<input type="text" class="detail-info-editing__input">
			<button class="editing-add__btn" type="submit">+ Добавить</button>
		</form>
		<h2 class="detail-info-editing__text">Основные публикации</h2>
		<form action="#">
			<input type="text" class="detail-info-editing__input">
			<button class="editing-add__btn" type="submit">+ Добавить</button>
		</form>
		<h2 class="detail-info-editing__text">Награды и почетные звания</h2>
		<form action="#">
			<input type="text" class="detail-info-editing__input">
			<button class="editing-add__btn" type="submit">+ Добавить</button>
		</form>
		<h2 class="detail-info-editing__text">Трудовые договора</h2>
		<form action="#">
			<input type="text" class="detail-info-editing__input">
			<button class="editing-add__btn" type="submit">+ Добавить</button>
		</form>
	</div>
</div>
@endsection