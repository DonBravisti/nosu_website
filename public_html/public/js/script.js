let screenWidth = window.innerWidth;
let swiper = document.querySelector('.swiper');
let swiperWrapper = document.querySelector('.swiper-wrapper');

if (screenWidth > 700) {
	swiper.classList.remove('swiper');
	swiperWrapper.classList.remove('swiper-wrapper');
}
if (screenWidth <= 700) {
	new Swiper('.swiper', {
		slidesPerView: 1,
		slidesPerGroup: 1,
		loop: true,
		loopedSlides: 1,
		spaceBetween: 30,
		centeredSlides: true,
		scrollbar: {
			el: '.swiper-scrollbar',
			draggable: true
		}
	});
	swiperWrapper.classList.add('mobile-workers-body');
}
