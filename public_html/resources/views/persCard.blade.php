@extends('layout.layout')
@section('content')
@include('partial.navPath')
<div class="content-container">
	<div class="department-container">
		<div class="department-block">
			<h2 class="section-title perscard-section-title">{{$fio}}</h2>
			<h3 class="director-info__title mobile-director-info__title">Заведующий кафедрой</h3>
			<div class="department-body persCard-department-body">
				<div class="director-info persCard-director-info">
					<h3 class="director-info__title pc-director-info__title perscard-director-info__title">Заведующий кафедрой</h3>
					<p class="director-info__el perscard-director-info__el docent">{{$title}}</p>
					<p class="director-info__el perscard-director-info__el">{{$degree}}</p>
					<p class="director-info__el">Базовое образование</p>
					<p class="director-info__el perscard-director-info__el">Высшее. Математик. Преподаватель</p>
					<p class="director-info__el">Общий стаж работы: 29</p>
					<p class="director-info__el perscard-director-info__el">29</p>
				</div>
				<div class="director-photo-block persCard-director-photo-block">
					<img src="/images/avatar.jpg" class="director__photo"></img>
				</div>
			</div>
		</div>
	</div>
	<div class="math-websites">
		<div class="math-websites-icon-container">
			<a href="#"><img src="/images/orcid.png" class="math-websites__icon"></a>
		</div>
		<div class="math-websites-icon-container">
			<a href="#"><img src="/images/elsevier.png" class="math-websites__icon"></a>
		</div>
		<div class="math-websites-icon-container">
			<a href="#"><img src="/images/math-net.png" class="math-websites__icon"></a>
		</div>
		<div class="math-websites-icon-container">
			<a href="#"><img src="/images/clarivate.png" class="math-websites__icon"></a>
		</div>
	</div>
	<div class="subjects">
		<h2 class="section-title">Преподаваемые дисциплины:</h2>
		<div class="subjects-body">
			<p class="subjects-body__el">Прикладной статистический анализ (магистратура)</p>
			<p class="subjects-body__el">Выпуклый анализ и оптимизация (магистратура)</p>
			<p class="subjects-body__el">Негладкая оптимизация (магистратура)</p>
			<p class="subjects-body__el">Элементы теории двойственности (магистратура)</p>
			<p class="subjects-body__el">Математические методы многомерного статистического анализа (бакалавриат)</p>
			<p class="subjects-body__el">Некоторые математические модели экономики (бакалавриат)</p>
			<p class="subjects-body__el">Обработка и анализ данных (магистратура)</p>
		</div>
	</div>
	<div class="proffessional-development">
		<h2 class="section-title">Повышениe квалификации:</h2>
		<div class="proffessional-development-body">
			<div class="proffessional-development-el">
				<p class="proffessional-development__text">«Актуальная педагогика: проблемы современного образования и науки», 72ч., СОГУ, 2018</p>
			</div>
			<div class="proffessional-development-el">
				<p class="proffessional-development__text">«Информационно-коммуникационные технологии в системе высшего образования», 32 ч., СОГУ, 2019</p>
			</div>
			<div class="proffessional-development-el">
				<p class="proffessional-development__text">«Современные цифровые технологии», 24 ч., СОГУ, 2019</p>
			</div>
			<div class="proffessional-development-el">
				<p class="proffessional-development__text">«Организационные и психолого-педагогические основы инклюзивного образования в вузе», 20 ч., СОГУ, 2020</p>
			</div>
		</div>
	</div>
	<div class="basic-publications">
		<h2 class="section-title">Основные публикации:</h2>
		<div class="basic-publications-body">
			<ul class="basic-publications-list">
				<li class="basic-publications__el"><a href = "#">Басаева Е.К., Каменецкий Е.С., Хосаева З.Х. К вопросу о модели этногенеза Л.Н. Гумилева // Вестник Владикавказского научного центра. 2015. Т. 15. № 2. С. 21-23.</a></li>
				<li class="basic-publications__el"><a href = "#">Басаева Е.К., Каменецкий Е.С., Хосаева З.Х. Количественная оценка фоновой социальной напряженности // Информационные войны. 2015. № 2 (34). С. 25-28.</a></li>
				<li class="basic-publications__el"><a href = "#">Басаева Е.К., Каменецкий Е.С., Хосаева З.Х. О влиянии нелинейных эффектов на стабильность общества // Математические заметки СВФУ. 2015. Т.22, № 3 (87). С. 78-83.</a></li>
				<li class="basic-publications__el"><a href = "#">Басаева Е.К., Каменецкий Е.С., Хосаева З.Х. Математическое моделирование изменения социальной напряженности в СССР в послевоенные годы // Историческая информатика. 2016. № 1-2 (15-16). С. 12-19.</a></li>
				<li class="basic-publications__el"><a href = "#">Basaeva E.K., Kusraev A.G., Kutateledze S.S. Quaisidifferentials in Kantorovich Spaces // Journal of Optimization Theory and Applications. 2016. Т. 171. № 2. С. 365-383. DOI 10.1007/s10957-016-0899-9</a></li>
				<li class="basic-publications__el"><a href = "#">Басаева Е.К., Каменецкий Е.С., Хосаева З.Х. Математическое моделирование социальной напряженности взаимодействующих социальных групп // Анализ и моделирование мировой и страновой динамики: экономические и политические процессы. М., 2016. С.130-144.</a></li>
				<li class="basic-publications__el"><a href = "#">Басаева Е.К., Каменецкий Е.С., Хосаева З.Х. Математическая модель стачечного движения в России в конце XIX – начале XX века // Историческая информатика. 2017. № 1. С. 52-62.</a></li>
				<li class="basic-publications__el"><a href = "#">Басаева Е.К., Каменецкий Е.С., Хосаева З.Х. Террористическая активность в Кабардино-Балкарской республике в начале XXI в. // Вестник экспертного совета. 2017. № 2 (9). С. 149-155.</a></li>
				<li class="basic-publications__el"><a href = "#">Басаева Е.К., Каменецкий Е.С., Хосаева З.Х. Математическое моделирование изменения напряженности общества при взаимодействии центральной власти, местной элиты и трудящихся // В сб.: Межнац. согласие – социальный приоритет государствен-ти. 2018, С.228-235</a></li>
				<li class="basic-publications__el"><a href = "#">Басаева Е.К., Каменецкий Е.С., Хосаева З.Х. Статистические индика-торы социальной напряженности // В сб.: Межнац. согласие – социальный приоритет государствен-ти. 2018, С.236-244.</a></li>
				<li class="basic-publications__el"><a href = "#">Басаева Е.К., Каменецкий Е.С., Хосаева З.Х. К вопросу о краткосрочном прогнозировании массовых протестных акций // Вестник Владикавказского научного центра. 2018. Т. 18. № 4. С. 85-88.</a></li>
				<li class="basic-publications__el"><a href = "#">Basaeva E.K., Kamenetsky E.S., Khosaeva Z.Kh. Terrorist Activity in Dage-stan at Beginning of 21st Century // The European Proceedings of Social & Behavioural Sciences EpSBS Conference: SCTCGM 2018. 2019. С. 164-174.</a></li>
				<li class="basic-publications__el"><a href = "#">Басаева Е.К., Каменецкий Е.С. Об одном методе предсказания нерегулярной смены власти // Вопросы безопасности. 2019. № 6. С. 38-47. DOI: 10.25136/2409-7543.0.0.31061</a></li>
				<li class="basic-publications__el"><a href = "#">Basaeva E.K., Kamenetsky E.S. Influence of Historical Memory on the Dynamics of Social Tension // Advances in Economics, Business and Management Research. V.113: FRED. P. 550–554. DOI: https://doi.org/10.2991/fred-19.2020.112</a></li>
			</ul>
		</div>
	</div>
	<div class="awards">
		<h2 class="section-title">Награды и почетные звания:</h2>
		<div class="awards-body">
			<div class="awards-el-container">
				<div class="awards-el">
					<p class="awards-el__text">Почетная грамота Республики Северная Осетия-Алания, 2010 г.</p>
				</div>
			</div>
			<div class="awards-el-container">
				<div class="awards-el">
					<p class="awards-el__text">Благодарность Парламента РСО-А, 2019г.</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection