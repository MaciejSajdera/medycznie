import { isElementInterSecting, RevealChildrenOf } from "./helperFunctions.js";

export default function scrollAnimations() {
	const allRevealTriggers = document.querySelectorAll(".reveal-from__trigger");

	const revealElement = element => {
		element.classList.add("revealed");
	};

	allRevealTriggers &&
		allRevealTriggers.forEach(element => {
			new isElementInterSecting(element, revealElement);
		});

	const allRevealChildrenOfTrigger = document.querySelectorAll(
		".reveal-children__trigger"
	);

	allRevealChildrenOfTrigger &&
		allRevealChildrenOfTrigger.forEach(element => {
			new RevealChildrenOf(element, 3);
		});
}
