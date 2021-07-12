window.addEventListener("DOMContentLoaded", event => {
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
	const singleAddToCartWithQty = document.querySelector(
		"#my_simple_add_to_cart_ajax"
	);

	const productTypeVariable = document.querySelector(".variations_form");
	const quantityControls = document.querySelector(".quantity-controls");

	let isPopUpActive = false;

	formCart &&
		formCart.addEventListener("click", function(e) {
			const qty = this.querySelector(".qty");
			const val = parseFloat(qty.getAttribute("value"));
			const max = parseFloat(qty.getAttribute("max"));
			const min = parseFloat(qty.getAttribute("min"));
			const step = parseFloat(qty.getAttribute("step"));

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
					qty.value = max;
					singleAddToCartWithQty.setAttribute("data-quantity", parseFloat(max));
				} else {
					qty.setAttribute("value", parseFloat(val + step));
					qty.value = parseFloat(val + step);
					singleAddToCartWithQty.setAttribute(
						"data-quantity",
						parseFloat(val + step)
					);
				}

				if (max === val && !isPopUpActive) {
					showMaxQtyPopUp();
				}
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
					qty.value = min;
					singleAddToCartWithQty.setAttribute("data-quantity", parseFloat(min));
				}

				if (val > 1) {
					qty.setAttribute("value", parseFloat(val - step));
					qty.value = parseFloat(val - step);
					singleAddToCartWithQty.setAttribute(
						"data-quantity",
						parseFloat(val - step)
					);
				}
			}
		});

	const showMaxQtyPopUp = () => {
		let maxQtyPopUp = document.createElement("DIV");
		maxQtyPopUp.classList.add("pop-up");

		let maxQtyArrow = document.createElement("SPAN");
		maxQtyArrow.classList.add("pop-up__arrow");

		let maxQtyParagraph = document.createElement("P");
		maxQtyParagraph.innerText = "Osiągnięto maksymalną dostępną ilość";

		maxQtyPopUp.appendChild(maxQtyArrow);
		maxQtyPopUp.appendChild(maxQtyParagraph);
		quantityControls.appendChild(maxQtyPopUp);

		setTimeout(() => {
			maxQtyPopUp.style.opacity = 1;
		}, 100);

		isPopUpActive = true;
	};

	document.addEventListener("click", e => {
		if (
			(isPopUpActive && !e.target.closest("BUTTON")) ||
			(isPopUpActive &&
				e.target.closest("BUTTON") &&
				!e.target.closest("BUTTON").classList.contains("plus"))
		) {
			let maxQtyPopUp = document.querySelector(".pop-up");

			maxQtyPopUp ? (maxQtyPopUp.style.opacity = 0) : "";

			setTimeout(() => {
				maxQtyPopUp.remove();
				isPopUpActive = false;
			}, 300);
		}
	});

	const qtyInput = document.querySelector(".quantity input");

	qtyInput &&
		qtyInput.addEventListener("change", function(e) {
			const val = parseFloat(this.getAttribute("value"));
			const max = parseFloat(this.getAttribute("max"));
			const min = parseFloat(this.getAttribute("min"));
			const step = parseFloat(this.getAttribute("step"));

			if (max && max <= e.target.value) {
				this.setAttribute("value", max);
				this.value = max;
			}

			if (min && min > e.target.value) {
				this.setAttribute("value", min);
				this.value = min;
			} else {
				this.setAttribute("value", e.target.value);
				this.value = e.target.value;
				singleAddToCartWithQty.setAttribute("data-quantity", e.target.value);
			}
		});
});
