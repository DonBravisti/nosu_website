@extends('layout.layout')
@section('content')
<div class="nav-path-container">
	<div class="nav-path">
		<a href="#" class="nav-path__link not-mobile__link">Главная</a>
		<span class="nav-path__img not-mobile__link"></span>
		<a href="#" class="nav-path__link not-mobile__link">Факультет математики и компьютерных наук</a>
		<span class="nav-path__img not-mobile__link"></span>
		<a href="#" class="nav-path__link not-mobile__link">Структура</a>
		<span class="nav-path__img not-mobile__link"></span>
		<span class="nav-path__img mobile__link"></span>
		<a href="#" class="nav-path__link">Кафедра прикладной математики и информатики</a>
	</div>
</div>
<div class="department-container">
	<div class="department-block">
		<h2 class="section-title">Кафедра прикладной математики и информатики</h2>
		<h3 class="director-info__title mobile-director-info__title">Заведующий кафедрой</h3>
		<div class="department-body">
			<div class="director-info">
				<h3 class="director-info__title pc-director-info__title">Заведующий кафедрой</h3>
				<a href="#" class="director-info__name">Басаева Елена Казбековна</a>
				<p class="director-info__el">Доцент</p>
				<p class="director-info__el">Кандидат физико-математических наук</p>
				<p class="director-info__el">Базовое образование: Высшее. Математик.</p>
				<p class="director-info__el">Преподаватель</p>
				<p class="director-info__el">Общий стаж работы: 29</p>
				<a href="/kafedra-prikladnoj-matematiki-i-informatiki/basaeva-elena-kazbekovna" class="director-info-link">
					<button class="director-info-btn">
						<p class="info-btn__text">Узнать больше</p>
						<div class="info-btn__icon"></div>
					</button>
				</a>
			</div>
			<div class="director-photo-block">
				<img src="/images/avatar.jpg" class="director__photo"></img>
			</div>
		</div>
	</div>
	<div class="directions-block">
		<h2 class="section-title">Основные направления кафедры:</h2>
		<div class="directions-body">
			<div class="direction-body__el">
				<p class="direction-body__text">Математическое моделирование</p>
			</div>
			<div class="direction-body__el">
				<p class="direction-body__text">качественная теория дифференциальных уравнений</p>
			</div>
			<div class="direction-body__el">
				<p class="direction-body__text">численные методы</p>
			</div>
			<div class="direction-body__el">
				<p class="direction-body__text">анализ данных и машинное обучение</p>
			</div>
			<div class="direction-body__el">
				<p class="direction-body__text">программирование и информационные технологии</p>
			</div>
			<div class="direction-body__el">
				<p class="direction-body__text">методика преподавания информатики</p>
			</div>
		</div>
	</div>
	<div class="academic-degrees-block">
		<h2 class="section-title">Основные направления кафедры:</h2>
		<div class="academic-degrees-body">
			<div class="study-type">
				<h2 class="study-type__title">Бакалавриат</h2>
				<div class="study-type-text-container">
					<p class="study-type__text">Кафедра ведет подготовку студентов по направлениям:</p>
					<p class="study-type__text"><a href="#" class="study-type__link">01.03.02</a>«Прикладная математика и информатика»,</p>
					<p class="study-type__text"><a href="#" class="study-type__link">профиль:</a>«Программирование, анализ данных и математическое моделирование»,</p>
					<p class="study-type__text"><a href="#" class="study-type__link"> 09.03.01</a>«Информатика и вычислительная техника»,</p>
					<p class="study-type__text"><a href="#" class="study-type__link">профиль</a>«Информатика и вычислительная техника»</p>
				</div>
			</div>
			<div class="study-type">
				<h2 class="study-type__title">Магистратура</h2>
				<div class="study-type-text-container">
					<p class="study-type__text">На кафедре ведется подготовка магистров по направлению</p>
					<p class="study-type__text"><a href="#" class="study-type__link"> 01.04.02</a>«Прикладная математика и информатика»,</p>
					<p class="study-type__text"><a href="#" class="study-type__link">профиль:</a>«Математическое и информационное обеспечение экономической деятельности».</p>
					<p class="study-type__text"> Руководителями магистратуры является доктор физико-математических наук, профессор<a href="#" class="study-type__link"> Р.Ч. Кулаев.</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="workers-container">
	<div class="workers-block">
		<h2 class="section-title">Сотрудники кафедры</h2>
		<div class="workers-body slider-container">
			<div class="swiper">
				<div class="swiper-wrapper workers-list">
					@foreach($emplFIOs as $key => $employee)
					<div class="worker-card swiper-slide">
						<div class="worker-card-container">
							<img src="/images/avatar.jpg">
							<h3 class="worker__name">
								{{$employee['fio']}}
							</h3>
							<p class="worker__status">{{$employee['degree']}}</p>
							<button class="learn-more__btn">
								<a href="/kafedra-prikladnoj-matematiki-i-informatiki/{{$employee['id']}}" class="learn-more__text">
									Узнать больше
								</a>
								<div class="learn-more__icon"></div>
							</button>
							@if(Auth::check())
							<button class="learn-more__btn">
								<a href="/edit/{{$employee['id']}}" class="learn-more__text">
									Редактировать
								</a>
								<div class="learn-more__icon"></div>
							</button>
							@endif
						</div>
					</div>
					@endforeach
					<!-- <div class="worker-card swiper-slide">
						<div class="worker-card-container">
							<img src="/images/avatar.jpg">
							<h3 class="worker__name">Баззаев Александр Казбекович</h3>
							<p class="worker__status">Кандидат физико-математических наук</p>
							<button class="learn-more__btn">
								<a class="learn-more__text">Узнать больше</a>
								<div class="learn-more__icon"></div>
							</button>
						</div>
					</div>
					<div class="worker-card swiper-slide">
						<div class="worker-card-container">
							<img src="/images/avatar.jpg">
							<h3 class="worker__name">Биткина Виктория Васильевна</h3>
							<p class="worker__status">Кандидат физико-математических наук</p>
							<button class="learn-more__btn">
								<a class="learn-more__text">Узнать больше</a>
								<div class="learn-more__icon"></div>
							</button>
						</div>
					</div>
					<div class="worker-card swiper-slide">
						<div class="worker-card-container">
							<img src="/images/avatar.jpg">
							<h3 class="worker__name">Воронцова Ирина Александровна</h3>
							<p class="worker__status">Кандидат физико-математических наук</p>
							<button class="learn-more__btn">
								<a class="learn-more__text">Узнать больше</a>
								<div class="learn-more__icon"></div>
							</button>
						</div>
					</div>
					<div class="worker-card swiper-slide">
						<div class="worker-card-container">
							<img src="/images/avatar.jpg">
							<h3 class="worker__name">Гамаонов Владимир Георгиевич</h3>
							<p class="worker__status">Кандидат физико-математических наук</p>
							<button class="learn-more__btn">
								<a class="learn-more__text">Узнать больше</a>
								<div class="learn-more__icon"></div>
							</button>
						</div>
					</div>
					<div class="worker-card swiper-slide">
						<div class="worker-card-container">
							<img src="/images/avatar.jpg">
							<h3 class="worker__name">Гудиев Тимур Владимирович</h3>
							<p class="worker__status">Кандидат физико-математических наук</p>
							<button class="learn-more__btn">
								<a class="learn-more__text">Узнать больше</a>
								<div class="learn-more__icon"></div>
							</button>
						</div>
					</div> -->
				</div>
				<div class="swiper-scrollbar scrollbar"></div>
			</div>
		</div>
		<div class="workers-pagination">
			<a href="#" class="workers-pagination__link">1</a>
			<a href="#" class="workers-pagination__link">2</a>
			<a href="#" class="workers-pagination__link">3</a>
			<a href="#" class="workers-pagination__link">4</a>
			<a href="#" class="workers-pagination__img"></a>
		</div>
	</div>
	<div class="contacts-block">
		<h2 class="section-title">Контактные данные</h2>
		<div class="contacts-body">
			<div class="contacts-container">
				<div class="contacts-info">
					<div class="contacts-text">
						<p class="contacts__title">НОМЕР ТЕЛЕФОНА</p>
						<a href="#" class="contacts__link">+7 (8672) 33-33-73</a>
					</div>
					<div class="contacts-text">
						<p class="contacts__title">E-MAIL</p>
						<a href="#" class="contacts__link">kpm@nosu-team.ru</a>
					</div>
					<div class="contacts-text">
						<p class="contacts__title">ГРАФИК РАБОТЫ</p>
						<p class="contacts__link">Пн - пт: 09:00 - 17:00</p>
					</div>
				</div>
				<div class="contacts-address">
					<p class="contacts__title">АДРЕС КАФЕДРЫ</p>
					<p class="contacts__link contacts-address__link">362040, РСО-Алания, г. Владикавказ, ул. Церетели 16, СОГУ, факультет математики и информационных технологи, ауд. 511</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection