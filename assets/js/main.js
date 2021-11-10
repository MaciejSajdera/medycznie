/**
 * Main JavaScript file.
 */
import Navigation from "./navigation.js";
import smoothscroll from "smoothscroll-polyfill";
import scrollAnimations from "./scrollAnimations.js";
import {
	isElementInViewport,
	addSelfDestructingEventListener
} from "../js/helperFunctions";

window.addEventListener("DOMContentLoaded", event => {
	const navigation = new Navigation();
	navigation.setupNavigation();

	smoothscroll.polyfill();
	scrollAnimations();

	const siteHeader = document.querySelector(".site-header");
	const myPreloader = document.querySelector(".my-preloader");
	const page = document.querySelector("#page");
	const topPromoItems = document.querySelectorAll(".top-promo-item");

	setTimeout(() => {
		myPreloader.classList.add("my-preloader-off");
	}, 200);

	setTimeout(() => {
		myPreloader.classList.add("my-preloader-none");
		page.classList.add("page-loaded");

		if (topPromoItems) {
			topPromoItems.forEach(element => {
				element.classList.add("top-promo-items-loaded");
			});
		}
	}, 300);

	setTimeout(() => {
		cookiesNotification();
	}, 1000);

	const cookiesNotification = () => {
		const cookiesInfo = document.querySelector(".cookie-law-notification");
		const cookiesAcceptButton = document.querySelector("#cookie-law-button");

		if (localStorage.getItem("cookiesAreAccepted")) {
			return;
		} else {
			cookiesInfo.classList.add("cookies-notification-on");
			cookiesAcceptButton &&
				cookiesAcceptButton.addEventListener("click", () => {
					localStorage.setItem("cookiesAreAccepted", "1");
					cookiesInfo.classList.add("cookies-notification-off");
				});
			return;
		}

		//temp
		// cookiesInfo.classList.add("cookies-notification-on");
	};

	//Lazy Loading

	const imagesLazyLoading = function() {
		let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
		let active = false;

		const lazyLoad = function() {
			if (active === false) {
				active = true;

				setTimeout(function() {
					lazyImages.forEach(function(lazyImage) {
						if (
							lazyImage.getBoundingClientRect().top <= window.innerHeight &&
							lazyImage.getBoundingClientRect().bottom >= 0 &&
							getComputedStyle(lazyImage).display !== "none"
						) {
							lazyImage.src = lazyImage.dataset.src;
							lazyImage.srcset = lazyImage.dataset.srcset;
							lazyImage.classList.remove("lazy");

							lazyImages = lazyImages.filter(function(image) {
								return image !== lazyImage;
							});

							if (lazyImages.length === 0) {
								document.removeEventListener("scroll", lazyLoad);
								window.removeEventListener("resize", lazyLoad);
								window.removeEventListener("orientationchange", lazyLoad);
							}
						}
					});

					active = false;
				}, 200);
			}
		};

		lazyLoad();
	};

	imagesLazyLoading();
	document.addEventListener("scroll", imagesLazyLoading);
	window.addEventListener("resize", imagesLazyLoading);
	window.addEventListener("orientationchange", imagesLazyLoading);

	const allCategoriesDropdowns = document.querySelectorAll(
		".woof_container_mselect"
	);

	const hideEmptyFilters = () => {
		if (allCategoriesDropdowns && allCategoriesDropdowns.length < 1) {
			return;
		}

		allCategoriesDropdowns &&
			allCategoriesDropdowns.forEach(dropdown => {
				const dropdownList = dropdown.querySelector(".woof_mselect");
				const optionsAvailable = dropdownList.options;
				const inputText = dropdown.querySelector("input[type=text]");

				// console.log(dropdown);

				inputText.readOnly = true;

				let isEmpty;

				let isOptionDisabled = [];

				Object.entries(optionsAvailable)
					.slice(1)
					.map(option => {
						isOptionDisabled.push(option[1].disabled);
					});

				isEmpty = isOptionDisabled.every(boolean => {
					return boolean === true;
				});

				isEmpty ? (dropdown.style.display = "none") : "";
			});
	};

	allCategoriesDropdowns && setTimeout(() => hideEmptyFilters(), 10);

	//"Woof filter" plugin renders HTML elements on the client side so setTimeout is set to get them.

	const selectProductsPerPage = document.querySelector("#products-per-page");

	const handleSelectProductsPerPage = () => {
		selectProductsPerPage.addEventListener("change", e => {
			e.target.closest("FORM").submit();
		});
	};

	selectProductsPerPage && handleSelectProductsPerPage();

	jQuery(document).on("woof_ajax_done", woof_ajax_done_handler);

	function woof_ajax_done_handler(e) {
		imagesLazyLoading();
		const pagination = document.querySelector(".woocommerce-pagination");

		if (window.pageYOffset > 1000) {
			window.scrollTo({
				top: 100,
				behavior: "smooth"
			});
		}

		hideEmptyFilters();

		handleSelectProductsPerPage();
	}

	const mobileMenu = () => {
		const nav = document.querySelector(".mobile-menu");
		const allMenuItemsWithChildren = nav.querySelectorAll(
			".menu-item-has-children"
		);

		const wooMenu = document.querySelector("#menu-woomenu");

		allMenuItemsWithChildren.forEach(item => {
			const link = item.querySelector("A");
			link.style.pointerEvents = "none";
		});

		// Flags
		let backButtonAppended = false;

		document.addEventListener("click", function(e) {
			// console.log(e.target);

			if (e.target.classList.contains("menu-item-has-children")) {
				//hide main menu

				const expandSubMenu = e.target.querySelector(".show-submenu");

				expandSubMenu.querySelector("#back-button")
					? expandSubMenu.querySelector("#back-button").remove()
					: "";

				const myBackButton = document.createElement("LI");
				myBackButton.id = "back-button";
				myBackButton.classList.add("back-button", "menu-item");

				const myBackButtonAnchor = document.createElement("A");
				myBackButtonAnchor.setAttribute("href", "#");
				myBackButtonAnchor.innerText =
					expandSubMenu.previousElementSibling.innerText;

				const myBackButtonSpan = document.createElement("SPAN");
				myBackButtonSpan.classList.add("hide-submenu");

				myBackButton.appendChild(myBackButtonAnchor);
				myBackButton.appendChild(myBackButtonSpan);

				const submenu = expandSubMenu.nextElementSibling;

				const appendButton = () => {
					if (!backButtonAppended) {
						submenu.appendChild(myBackButton);
						backButtonAppended = true;
					}
				};

				appendButton();

				// expandSubMenu.closest("UL").classList.add("move-back");

				submenu.classList.add("sub-menu--expanded");

				// console.log(wooMenu.getBoundingClientRect().height);
				submenu.style.minHeight = `${wooMenu.getBoundingClientRect().height}`;

				//delay
				if (wooMenu) {
					setTimeout(function() {
						wooMenu.scrollTop = 0;
					}, 0);
				}
			}

			if (e.target.classList.contains("back-button")) {
				const submenuExpanded = e.target.closest(".sub-menu--expanded");
				submenuExpanded.classList.remove("sub-menu--expanded");

				// const menuMovedBack = document.querySelector(".move-back");
				// menuMovedBack.classList.remove("move-back");

				setTimeout(() => {
					e.target.remove();
				}, 100);

				backButtonAppended = false;
			}

			const searchMobileHolder = document.querySelector(".search-panel");
			const searchFormMobileTrigger = searchMobileHolder.querySelector(
				".dgwt-wcas-enable-mobile-form"
			);

			if (e.target.matches("#search-icon")) {
				// searchModal.classList.add("open");
				searchFormMobileTrigger.click();
			} else {
				return;
			}
		});
	};

	const mediaQueryMobile = window.matchMedia("(max-width: 992px)");

	let mobileMenuWasAlreadyFired = false;

	function handleMobileChange(e) {
		// Check if the media query is true
		if (e.matches && !mobileMenuWasAlreadyFired) {
			// Then log the following message to the console
			console.log("Media Query Mobile Matched!");
			mobileMenu();
			mobileMenuWasAlreadyFired = true;
		}
	}

	mediaQueryMobile.addListener(handleMobileChange);
	handleMobileChange(mediaQueryMobile);

	function collapseSection(element) {
		// get the height of the element's inner content, regardless of its actual size
		var sectionHeight = element.scrollHeight;

		// temporarily disable all css transitions
		var elementTransition = element.style.transition;
		element.style.transition = "";

		// on the next frame (as soon as the previous style change has taken effect),
		// explicitly set the element's height to its current pixel height, so we
		// aren't transitioning out of 'auto'
		requestAnimationFrame(function() {
			element.style.height = sectionHeight + "px";
			element.style.transition = elementTransition;

			// on the next frame (as soon as the previous style change has taken effect),
			// have the element transition to height: 0
			requestAnimationFrame(function() {
				element.style.height = 0 + "px";
			});
		});

		// mark the section as "currently collapsed"
		element.setAttribute("data-collapsed", "true");
	}

	function expandSection(element) {
		// get the height of the element's inner content, regardless of its actual size
		var sectionHeight = element.scrollHeight;

		// have the element transition to the height of its inner content
		element.style.height = sectionHeight + "px";

		// when the next css transition finishes (which should be the one we just triggered)
		const removeHeight = function(e) {
			element.style.height = null;
		};

		addSelfDestructingEventListener(element, "transitionend", removeHeight);

		// mark the section as "currently not collapsed"
		element.setAttribute("data-collapsed", "false");
	}

	const desktopMenu = () => {
		const nav = document.querySelector("#menu-woomenu-1");
		const allMenuLinks = nav.querySelectorAll("LI");
		const linksWithChildren = nav.querySelectorAll(".menu-item-has-children");

		// const wooMenu = document.querySelector("#menu-woomenu");

		linksWithChildren.forEach(link => {
			// const submenu = link.querySelector(".sub-menu");
			// submenu.setAttribute("data-collapsed", "true");
			// console.log(link);
			if (link.querySelector(".sub-menu")) {
				const submenu = link.querySelector(".sub-menu");

				submenu.setAttribute("data-collapsed", "true");
			}
		});

		nav.addEventListener("click", function(e) {
			// console.log(e.target);

			if (e.target.classList.contains("show-submenu")) {
				const expandSubMenuTrigger = e.target;
				expandSubMenuTrigger.classList.toggle("show-submenu__toggled");
				const submenu = expandSubMenuTrigger.nextElementSibling;
				// submenu.classList.toggle("sub-menu--expanded");
				// const submenuExpanded = this.closest(".sub-menu--expanded");
				// submenuExpanded.classList.remove("sub-menu--expanded");

				var isCollapsed = submenu.getAttribute("data-collapsed") === "true";

				if (isCollapsed) {
					expandSection(submenu);
					submenu.setAttribute("data-collapsed", "false");
					submenu.classList.add("sub-menu--expanded");
				} else {
					collapseSection(submenu);
				}
			}
		});

		//AT ARCHIVE TEMPLATE

		const currentMenuItem = nav.querySelector(".current-menu-item");
		const currentCategoryAncestor = nav.querySelector(".current-menu-ancestor");

		//if current menu item is an ancestor with no submenu
		if (
			currentMenuItem &&
			!currentCategoryAncestor &&
			!currentMenuItem.querySelector(".sub-menu")
		) {
			console.log("no submenu");
			return;
		}

		//if is an ancestor with submenu
		if (currentMenuItem && !currentCategoryAncestor) {
			const currentSubMenu = currentMenuItem.querySelector(".sub-menu");

			currentSubMenu.classList.add("sub-menu--expanded");

			currentSubMenu.setAttribute("data-collapsed", "false");

			const currentExpandMenuToggle = currentMenuItem.querySelector(
				".show-submenu"
			);

			currentExpandMenuToggle.classList.add("show-submenu__toggled");

			// console.log("test3");
		}

		//if is nested and has its own submenu

		if (
			currentMenuItem &&
			currentMenuItem.classList.contains("menu-item-has-children") &&
			currentCategoryAncestor
		) {
			const directAncestor = currentMenuItem.closest(".current-menu-ancestor");
			console.log(directAncestor);

			const currentExpandMenuToggle = directAncestor.querySelector(
				".show-submenu"
			);
			const currentSubMenu = directAncestor.querySelector(".sub-menu");

			currentSubMenu.classList.add("sub-menu--expanded");
			currentSubMenu.setAttribute("data-collapsed", "false");
			currentExpandMenuToggle.classList.add("show-submenu__toggled");

			const childrenSubMenu = currentMenuItem.querySelector(".sub-menu");
			const childrenExpandMenuToggle = currentMenuItem.querySelector(
				".show-submenu"
			);

			childrenSubMenu.classList.add("sub-menu--expanded");
			childrenSubMenu.setAttribute("data-collapsed", "false");
			childrenExpandMenuToggle.classList.add("show-submenu__toggled");
		}

		//if is nested and doesn't have its own submenu

		if (
			currentMenuItem &&
			!currentMenuItem.classList.contains("menu-item-has-children") &&
			currentCategoryAncestor
		) {
			const directAncestor = currentMenuItem.closest(".current-menu-ancestor");
			const currentExpandMenuToggle = directAncestor.querySelector(
				".show-submenu"
			);
			const currentSubMenu = directAncestor.querySelector(".sub-menu");

			currentSubMenu.classList.add("sub-menu--expanded");
			currentSubMenu.setAttribute("data-collapsed", "false");
			currentExpandMenuToggle.classList.add("show-submenu__toggled");

			const grandparentAncestor = directAncestor.parentElement.closest(
				".menu-parent-link"
			);

			if (grandparentAncestor) {
				const grandparentSubMenu = grandparentAncestor.querySelector(
					".sub-menu"
				);
				const grandparentExpandMenuToggle = grandparentAncestor.querySelector(
					".show-submenu"
				);

				grandparentSubMenu.classList.add("sub-menu--expanded");
				grandparentSubMenu.setAttribute("data-collapsed", "false");
				grandparentExpandMenuToggle.classList.add("show-submenu__toggled");
			}
		}

		//AT SINGLE PRODUCT TEMPLATE

		const currentProductParent = nav.querySelector(".current-product-parent");
		const currentProductAncestor = nav.querySelector(
			".current-product-ancestor"
		);

		//if current menu item is an ancestor with no submenu
		if (
			currentProductParent &&
			currentProductAncestor &&
			!currentProductParent.querySelector(".sub-menu")
		) {
			console.log("no submenu");
			return;
		}

		//if is an ancestor with submenu
		if (currentProductParent && !currentProductAncestor) {
			const currentSubMenu = currentProductParent.querySelector(".sub-menu");

			currentSubMenu.classList.add("sub-menu--expanded");

			currentSubMenu.setAttribute("data-collapsed", "false");

			const currentExpandMenuToggle = currentProductParent.querySelector(
				".show-submenu"
			);

			currentExpandMenuToggle.classList.add("show-submenu__toggled");

			// console.log("test3");
		}

		//if is nested and has its own submenu

		if (
			currentProductParent &&
			currentProductParent.classList.contains("menu-item-has-children") &&
			currentProductAncestor
		) {
			const directAncestor = currentProductParent.closest(
				".current-product-ancestor"
			);

			const currentExpandMenuToggle = directAncestor.querySelector(
				".show-submenu"
			);
			const currentSubMenu = directAncestor.querySelector(".sub-menu");

			currentSubMenu.classList.add("sub-menu--expanded");
			currentSubMenu.setAttribute("data-collapsed", "false");
			currentExpandMenuToggle.classList.add("show-submenu__toggled");

			const childrenSubMenu = currentProductParent.querySelector(".sub-menu");
			const childrenExpandMenuToggle = currentProductParent.querySelector(
				".show-submenu"
			);

			childrenSubMenu.classList.add("sub-menu--expanded");
			childrenSubMenu.setAttribute("data-collapsed", "false");
			childrenExpandMenuToggle.classList.add("show-submenu__toggled");
		}

		//if is nested and doesn't have its own submenu

		if (
			currentProductParent &&
			!currentProductParent.classList.contains("menu-item-has-children") &&
			currentProductAncestor
		) {
			const directAncestor = currentProductParent.closest(
				".menu-item-has-children"
			);

			const currentExpandMenuToggle = directAncestor.querySelector(
				".show-submenu"
			);
			const currentSubMenu = directAncestor.querySelector(".sub-menu");

			currentSubMenu.classList.add("sub-menu--expanded");
			currentSubMenu.setAttribute("data-collapsed", "false");
			currentExpandMenuToggle.classList.add("show-submenu__toggled");

			const grandparentAncestor = directAncestor.parentElement.closest(
				".menu-parent-link"
			);

			if (grandparentAncestor) {
				const grandparentSubMenu = grandparentAncestor.querySelector(
					".sub-menu"
				);
				const grandparentExpandMenuToggle = grandparentAncestor.querySelector(
					".show-submenu"
				);

				grandparentSubMenu.classList.add("sub-menu--expanded");
				grandparentSubMenu.setAttribute("data-collapsed", "false");
				grandparentExpandMenuToggle.classList.add("show-submenu__toggled");
			}
		}

		const searchPanel = document.querySelector(".search-panel");
		const searchIconDesktop = document.querySelector(
			".header-top-wrapper-desktop #search-icon"
		);

		document.addEventListener("click", e => {
			console.log(e.target);

			if (e.target.matches("#search-icon")) {
				searchPanel.classList.toggle("search-panel--toggled");
				searchIconDesktop.classList.toggle("search-icon--clicked");
			} else {
				return;
			}
		});
	};

	const mediaQueryDesktop = window.matchMedia("(min-width: 992px)");

	const asideDesktopMenu = document.querySelector("#aside-menu");
	let desktopMenuWasAlreadyFired = false;

	function handleDesktopChange(e) {
		// Check if the media query is true
		if (asideDesktopMenu && e.matches && !desktopMenuWasAlreadyFired) {
			console.log("Media Query Desktop Matched!");

			desktopMenu();
			desktopMenuWasAlreadyFired = true;
		}

		const desktopMenuNavigation = document.querySelector(".desktop-menu");
		let lastScrollTop = 0;

		window.addEventListener(
			"scroll",
			() => {
				let st = window.pageYOffset || document.documentElement.scrollTop; // Credits: "https://github.com/qeremy/so/blob/master/so.dom.js#L426"
				if (st > lastScrollTop) {
					desktopMenuNavigation.classList.add("hide");
				} else {
					desktopMenuNavigation.classList.remove("hide");
				}
				lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
			},
			false
		);
	}

	mediaQueryDesktop.addListener(handleDesktopChange);
	handleDesktopChange(mediaQueryDesktop);

	const switchSignIn = document.querySelector("#switch-sign-in");
	const switchSignUp = document.querySelector("#switch-sign-up");
	const signInWrapper = document.querySelector(".sign-in-wrapper");
	const signUpWrapper = document.querySelector(".sign-up-wrapper");

	if (switchSignIn) {
		switchSignUp.addEventListener("click", () => {
			signInWrapper.classList.remove("form-active");
			signUpWrapper.classList.add("form-active", "choose-customer-type");

			switchSignIn.classList.remove("switch-active");
			switchSignUp.classList.add("switch-active");
		});

		switchSignIn.addEventListener("click", () => {
			signUpWrapper.classList.remove("form-active", "choose-customer-type");
			signInWrapper.classList.add("form-active");

			switchSignUp.classList.remove("switch-active");
			switchSignIn.classList.add("switch-active");
		});
	}

	const toggleFilters = document.querySelector("#toggle-filters");

	if (toggleFilters) {
		const woofFilters = document.querySelector(".woof");
		toggleFilters.addEventListener("click", e => {
			woofFilters.classList.toggle("woof__show");
		});
	}

	document.addEventListener("scroll", () => {
		const scrollToTopBtn = document.querySelector(".scrollToTopBtn");

		const searchHasBoxShadow = document.querySelector(
			".search-panel--box-shadow"
		);

		const isMobileNavOpen = document.querySelector(".main-navigation--open");

		if (pageYOffset > 0 && !searchHasBoxShadow && !isMobileNavOpen) {
			!siteHeader.classList.contains("site-header--toggled")
				? siteHeader.classList.add("site-header--toggled")
				: "";
		}

		if (pageYOffset === 0) {
			siteHeader.classList.contains("site-header--toggled")
				? siteHeader.classList.remove("site-header--toggled")
				: "";
		}

		if (scrollToTopBtn) {
			if (pageYOffset > window.innerHeight) {
				scrollToTopBtn.classList.add("showBtn");
			} else {
				scrollToTopBtn.classList.remove("showBtn");
			}
			scrollToTopBtn.addEventListener("click", () => {
				window.scrollTo({
					top: 0,
					behavior: "smooth"
				});
			});
		}
	});

	const showActiveShippingMethod = () => {
		const allShippingMethods = document.querySelectorAll(".shipping_method");

		allShippingMethods &&
			allShippingMethods.forEach(method => {
				method && method.checked && method.closest("LI")
					? method.closest("LI").classList.add("shipping-method--active")
					: "";
			});
	};

	showActiveShippingMethod();
	jQuery(document).on("updated_shipping_method", showActiveShippingMethod);
	jQuery(document).on("updated_checkout", showActiveShippingMethod);
});

// const closePromo = document.querySelector("#close-promo");

// closePromo.addEventListener("click", () => {
// 	const siteNavigation = document.querySelector("#site-navigation");
// 	const topPromo = document.querySelector(".top-promo");

// 	siteNavigation.classList.remove("promo-navigation");
// 	topPromo.parentNode.removeChild(topPromo);
// });

// function debounce(func, wait, immediate) {
// 	var timeout;

// 	return function executedFunction() {
// 		var context = this;
// 		var args = arguments;

// 		var later = function() {
// 			timeout = null;
// 			if (!immediate) func.apply(context, args);
// 		};

// 		var callNow = immediate && !timeout;

// 		clearTimeout(timeout);

// 		timeout = setTimeout(later, wait);

// 		if (callNow) func.apply(context, args);
// 	};
// }

// document.addEventListener("click", e => {
// 	console.log(e.target);
// });
