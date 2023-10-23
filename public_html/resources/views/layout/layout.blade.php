<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<title>Nosu</title>
</head>

<body>
	<div class="container">
		<header>
			<div class="header-top-container">
				<div class="header-top">
					<div class="header-info">
						<div>
							<img src="/images/gpsIcon.png" class="header__icon">
							<a href="#" class="header__item">ул. Церетели, 18, Владикавказ</a>
						</div>
						<div>
							<img src="/images/timeIcon.png" class="header__icon">
							<a href="#" class="header__item">Пн-пт: 10:00-17:00</a>
						</div>
					</div>
					<div class="header-contacts">
						<div>
							<img src="/images/mailIcon.png" class="header__icon">
							<a href="#" class="header__item">mit_nosu</a>
						</div>
						<div>
							<img src="/images/phoneIcon.png" class="header__icon">
							<a href="#" class="header__item">+7 (8672) 333-920</a>
						</div>
						<div class="language-block">
							<a href="#" class="header__item header__item-active language">Рус</a>
							<a href="#" class="header__item header__item-disabled language">Eng</a>
							<img src="/images/eye.png" class="header__icon eye-icon">
						</div>
					</div>
				</div>
			</div>
			<span class="border"></span>
			<div class="header-main-container">
				<div class="header-main">
					<div class="logo-block">
						<img src="/images/logo.png" class="logo-block__img">
					</div>
					<div class="menu">
						<div class="menu-top_container">
							<div class="menu-top">
								<form action="#" method="post" class="menu-search-block">
									<input type="text" class="search-input" name="search-input">
									<input type="submit" class="search-btn" value="">
								</form>
								@if(Auth::check())
								<button class="login-btn">
									<div class="login-btn__icon"></div>
									<a href="/profile" class="login-btn__text">{{Auth::user()->name}}</a>
								</button>
								@else
								<button class="login-btn">
									<div class="login-btn__icon"></div>
									<a href="/profile" class="login-btn__text">Войти</a>
								</button>
								@endif
							</div>
						</div>
						<nav class="navbar">
							<a href="#" class="navbar__item">Абитуриентам</a>
							<a href="#" class="navbar__item navbar__item-active">Обучающимся</a>
							<a href="#" class="navbar__item">Сотрудникам</a>
							<a href="#" class="navbar__item">Наука и образование</a>
							<a href="#" class="navbar__item">О факультете</a>
						</nav>
					</div>
				</div>
				<div class="header-main-mobile">
					<img src="/images/mobileLogo.png" class="mobile__logo">
					<div class="mobile-header-block">
						<div class="mobile-search-block">
							<input type="text" class="mabile-search__input" name="search-input" placeholder="Что будем искать?">
							<button class="mobile-search-icon"></button>
						</div>
						<img src="/images/burger.png" class="mabile-search__burger">
					</div>
				</div>
			</div>
		</header>
		<main>
			@yield('content')
		</main>
		<footer>
			<div class="soc-networks-block">
				<a href="#">
					<div class="soc-network">
						<img src="/images/vk.png" class="soc-network__img">
						<p class="soc-network__name">ВКонтакте</p>
					</div>
				</a>
				<a href="#">
					<div class="soc-network">
						<img src="/images/telegram.png" class="soc-network__img">
						<p class="soc-network__name">Telegram</p>
					</div>
				</a>
				<a href="#">
					<div class="soc-network">
						<img src="/images/youtube.png" class="soc-network__img">
						<p class="soc-network__name">Youtube</p>
					</div>
				</a>
			</div>
		</footer>
	</div>
	</div>
</body>

</html>