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
					<p class="general-info-input__name big-general-info-input__name">ФИО</p>
					<input type="text" class="general-info__input big-general-info__input" name="FIO" value="" placeholder="не заполнено">
					<p class="general-info-input__name big-general-info-input__name">Должность</p>
					<input type="text" class="general-info__input big-general-info__input" placeholder="не заполнено">
					<p class="general-info-input__name">Ученое звание</p>
					<input type="text" class="general-info__input" value="" placeholder="не заполнено">
					<p class="general-info-input__name">Ученая степень</p>
					<input type="text" class="general-info__input" placeholder="не заполнено">
					<p class="general-info-input__name">Базовое образование</p>
					<input type="text" class="general-info__input" placeholder="не заполнено">

					<button type="submit">Сохранить</button>
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