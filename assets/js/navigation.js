/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

export default class Navigation {
	constructor() {
		this.container = document.querySelector(".mobile-menu");
		this.button = document.querySelector(".menu-toggle");
		// this.menu = this.container.getElementsByTagName("ul")[0];
		this.svgButton = document.querySelector("#svgButton");
	}

	setupNavigation() {
		const siteNavigation = document.querySelector("#site-navigation");
		// const searchPanel = document.querySelector(".search-panel");
		// const searchToggleSVG = document.querySelector("#search-icon svg");

		let isMobileNavOpen = false;

		// Toggle mobile navigation
		this.button.onclick = () => {
			isMobileNavOpen = !isMobileNavOpen;

			siteNavigation.classList.toggle("main-navigation--open");

			siteNavigation.classList.contains("site-header--toggled")
				? siteNavigation.classList.remove("site-header--toggled")
				: "";

			// searchPanel.classList.contains("search-panel--box-shadow")
			// 	? searchPanel.classList.remove("search-panel--box-shadow")
			// 	: "";

			// if (!isMobileNavOpen) {
			// 	searchPanel.classList.remove("search-panel--toggled");
			// 	searchToggleSVG.classList.remove("search-icon-clicked");
			// }

			if (-1 !== this.container.className.indexOf("toggled")) {
				this.svgButton.classList.toggle("active");
				this.container.className = this.container.className.replace(
					" toggled",
					""
				);
				this.button.setAttribute("aria-expanded", "false");
				// this.menu.setAttribute("aria-expanded", "false");
			} else {
				this.svgButton.classList.toggle("active");
				this.container.className += " toggled";

				this.button.setAttribute("aria-expanded", "true");
			}
		};

		// document.addEventListener("click", e => {
		// 	siteNavigation.classList.contains("site-header--toggled")
		// 		? siteNavigation.classList.remove("site-header--toggled")
		// 		: "";

		// 	const searchToggleSVGPath = document.querySelectorAll(
		// 		"#search-icon svg path"
		// 	);
		// 	const searchToggleIcon = document.querySelector("#search-icon");
		// 	const searchToggleWrapper = document.querySelector(
		// 		".search-icon-wrapper"
		// 	);
		// 	const searchToggleSubText = document.querySelector(
		// 		".search-sub-icon-text"
		// 	);

		// 	const searchInput = document.querySelector(".dgwt-wcas-search-input");

		// 	if (
		// 		e.target === searchToggleSVG ||
		// 		e.target === searchToggleSVGPath[0] ||
		// 		e.target === searchToggleSVGPath[1] ||
		// 		e.target === searchToggleIcon ||
		// 		e.target === searchToggleSubText ||
		// 		e.target === searchToggleWrapper
		// 	) {
		// 		searchPanel.classList.toggle("search-panel--toggled");

		// 		if (!isMobileNavOpen) {
		// 			searchPanel.classList.toggle("search-panel--box-shadow");
		// 		}

		// 		searchToggleSVG.classList.toggle("search-icon-clicked");

		// 		if (window.innerWidth >= 992) {
		// 			searchInput.focus();
		// 		}
		// 	}
		// });
	}
}
