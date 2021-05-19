window.addEventListener("DOMContentLoaded", event => {
	const productTypeVariable = document.querySelector(".variations_form");

	const singleAddToCartWithQty = document.querySelector(
		"#my_simple_add_to_cart_ajax"
	);

	// .single_add_to_cart_button

	const allStarLinks = document.querySelectorAll(".star-link");
	const reviewsTab = document.querySelector(".reviews_tab a");

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

	const formCart = document.querySelector("form.cart");

	formCart.addEventListener("click", function(e) {
		const qty = this.querySelector(".qty");

		const val = parseFloat(qty.getAttribute("value"));
		const max = parseFloat(qty.getAttribute("max"));
		const min = parseFloat(qty.getAttribute("min"));
		const step = parseFloat(qty.getAttribute("step"));

		console.log(`value: ${val}, max: ${max}, min: ${min}, step: ${step}`);

		if (
			e.target.classList.contains("plus") ||
			(e.target.closest("BUTTON") &&
				e.target.closest("BUTTON").classList.contains("plus"))
		) {
			singleAddToCartWithQty &&
			singleAddToCartWithQty.classList.contains("added")
				? singleAddToCartWithQty.classList.remove("added")
				: "";

			if (max && max <= val) {
				qty.setAttribute("value", max);
			} else {
				qty.setAttribute("value", parseFloat(val + step));
			}

			singleAddToCartWithQty.setAttribute(
				"data-quantity",
				parseFloat(val + step)
			);
		}

		if (
			e.target.classList.contains("minus") ||
			(e.target.closest("BUTTON") &&
				e.target.closest("BUTTON").classList.contains("minus"))
		) {
			singleAddToCartWithQty &&
			singleAddToCartWithQty.classList.contains("added")
				? singleAddToCartWithQty.classList.remove("added")
				: "";

			if (min && min >= val) {
				qty.setAttribute("value", min);
			} else if (val > 1) {
				qty.setAttribute("value", parseFloat(val - step));
			}

			singleAddToCartWithQty.setAttribute(
				"data-quantity",
				parseFloat(val - step)
			);
		}

		// if (!productTypeVariable) {
		// singleAddToCartWithQty.setAttribute("data-quantity", qty.value);
		// }
	});

	const qtyInput = document.querySelector(".input-text");

	// if (!productTypeVariable) {
	qtyInput.addEventListener("change", e => {
		singleAddToCartWithQty.setAttribute("data-quantity", e.target.value);
	});
	// }
});
