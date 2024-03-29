// import Swiper JS
import Swiper, {
	Navigation,
	Autoplay,
	Pagination,
	Parallax,
	EffectFade,
	Lazy
} from "swiper";
// import Swiper styles
import "swiper/swiper-bundle.css";

document.addEventListener("DOMContentLoaded", () => {
	Swiper.use([Navigation, Autoplay, Pagination, Parallax, EffectFade, Lazy]);

	var mySwiper = new Swiper(".swiper-container-main-carousel", {
		direction: "horizontal",
		loop: true,
		parallax: true,
		effect: "fade",
		fadeEffect: {
			crossFade: true
		},
		speed: 700,
		autoplay: {
			delay: 3000
		},

		grabCursor: true,

		pagination: {
			el: ".swiper-pagination"
		},

		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev"
		}
	});

	const shortcode_1_title = document.querySelector("#shortcode_1_title")
		.innerHTML;
	const shortcode_2_title = document.querySelector("#shortcode_2_title")
		.innerHTML;
	const shortcode_3_title = document.querySelector("#shortcode_3_title")
		.innerHTML;

	let menu = [shortcode_1_title, shortcode_2_title, shortcode_3_title];

	var myCategoriesSwiper = new Swiper(".swiper-container-categories", {
		direction: "horizontal",
		speed: 350,
		effect: "fade",
		fadeEffect: {
			crossFade: true
		},

		simulateTouch: false,

		pagination: {
			el: ".swiper-pagination-categories",
			clickable: true,
			renderBullet: (index, className) =>
				'<span class="' + className + '">' + menu[index] + "</span>"
		},

		lazy: true,

		navigation: {
			nextEl: ".swiper-button-next-categories",
			prevEl: ".swiper-button-prev-categories"
		}
	});

	var myBrandsSwiper = new Swiper(".swiper-container-brands", {
		direction: "horizontal",
		loop: true,
		centeredSlides: true,
		slidesPerView: 3,
		speed: 3500,
		autoplay: {
			delay: 0
		},
		breakpoints: {
			992: {
				slidesPerView: 5
			}
		},
		autoplayDisableOnInteraction: false,
		grabCursor: true,
		simulateTouch: false,

		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev"
		}
	});

	// function infinite() {
	// 	myBrandsSwiper.slideTo(swiper.slides.length);
	// 	myBrandsSwiper.once('transitionEnd', function(){
	// 		myBrandsSwiper.slideTo(myBrandsSwiper.params.slidesPerView, 0, false);
	// 		setTimeout(function () {
	// 			infinite();
	// 		}, 0);
	// 	});
	// }
	// infinite();
});
