import smoothscroll from "smoothscroll-polyfill";

window.addEventListener("DOMContentLoaded", event => {
	const productTypeVariable = document.querySelector(".product-type-variable");

	const singleAddToCartWithQty = document.querySelector(
		"#my_simple_add_to_cart_ajax"
	);

	const allStarLinks = document.querySelectorAll(".star-link");
	const reviewsTab = document.querySelector(".reviews_tab a");

	smoothscroll.polyfill();

	if (allStarLinks) {
		allStarLinks.forEach(starlink => {
			starlink.addEventListener("click", e => {
				e.preventDefault();

				reviewsTab.scrollIntoView({
					behavior: "smooth",
					block: "center"
				});

				reviewsTab.click();
			});
		});
	}

	const qtyInput = document.querySelector(".input-text");

	if (!productTypeVariable) {
		qtyInput.addEventListener("input", e => {
			singleAddToCartWithQty.setAttribute("data-quantity", e.target.value);
		});
	}
});
