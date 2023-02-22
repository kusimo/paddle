/**
 * Theme JavaScript
 */

['click', 'scroll', 'mousemove', 'touchstart'].forEach(function(e) {
    window.addEventListener(e, firstInteraction, {
        once: true
    });
});
var userInteracted = false;

function firstInteraction() {
    if (!userInteracted) {
        userInteracted = true;
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            'event': 'firstInteraction',
			'userInteracted': true
        });
    }
	if(userInteracted) {
		//replaceCommas('.cat-links');
		//replaceCommas('.tags-links');
	}
	
}

  function replaceCommas(divClass) {
	// Get the class name.
	let itemContainer = document.querySelectorAll(divClass);

	itemContainer.forEach(function (linksArray) {
		// Check if class exist on the page.
		if (!linksArray || undefined === linksArray) {
			return;
		}
		// Get the inner html.
		let linksArrayHtml = linksArray.innerHTML;
		// Check if the inner html has ',' if not bail.
		if (!linksArrayHtml.includes(',')) {
			return;
		}
		// Replace commas with empty.
		linksArray.innerHTML = linksArrayHtml.replace(/,/g, ' <span> </span> ');
	}); // Foreach.
} // replaceCommas.




/*-----------------------------------------------------------------------------------------------
	  Change Zoom image Magnifier
	------------------------------------------------------------------------------------------------- */
	/*
document.addEventListener('DOMContentLoaded', function (event) {

	(function () {
		"use strict";
		let haveWoo = document.querySelectorAll("body.woocommerce");
		if (!haveWoo) return;
		setTimeout(function () {
			let triggerContainer = document.getElementsByClassName("woocommerce-product-gallery__trigger")[0];

			if (!triggerContainer) return;


			let imageInner = triggerContainer.getElementsByTagName("img")
			for (let i = 0; i < imageInner.length; i++) {
				let x = imageInner[i];
				if (i === 0)
					x.setAttribute('src', 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBkPSJNMTMgMTBoLTN2M2gtMnYtM2gtM3YtMmgzdi0zaDJ2M2gzdjJ6bTguMTcyIDE0bC03LjM4Ny03LjM4N2MtMS4zODguODc0LTMuMDI0IDEuMzg3LTQuNzg1IDEuMzg3LTQuOTcxIDAtOS00LjAyOS05LTlzNC4wMjktOSA5LTkgOSA0LjAyOSA5IDljMCAxLjc2MS0uNTE0IDMuMzk4LTEuMzg3IDQuNzg1bDcuMzg3IDcuMzg3LTIuODI4IDIuODI4em0tMTIuMTcyLThjMy44NTkgMCA3LTMuMTQgNy03cy0zLjE0MS03LTctNy03IDMuMTQtNyA3IDMuMTQxIDcgNyA3eiIvPjwvc3ZnPg==');
			}
		}, 200)

	}());

});
*/

/*	-----------------------------------------------------------------------------------------------
	Homepage Slider
--------------------------------------------------------------------------------------------------- */
/*
(function () {
	"use strict";
	var paddleSlider = document.querySelector('.paddle-front-page-slider');
	if (!paddleSlider) return;

	var slideIndex = 0; // Change this to 1 for static then uncomment showSlides
	var bgImage;

	autoShowSlides();
	//showSlides(slideIndex);

	// Next/previous controls
	function plusSlides(n) {
		showSlides((slideIndex += n));
	}

	// Thumbnail image controls
	function currentSlide(n) {
		showSlides((slideIndex = n));
	}

	// Fade slide
	function scaleSlide() {
		document.getElementsByClassName('home-banner-image')[0].classList.remove(
			'background-scale');

		setTimeout(function () {
			document.getElementsByClassName('home-banner-image')[0].classList.add(
				'background-scale');

		}, 100);

	}

	function animateTextUp(textElem, elemDuration = "", transDuration = "") {
		if (textElem.classList.contains('animate-up')) {
			if (transDuration !== "") textElem.style.transitionDuration = transDuration;
			if (textElem.classList.contains('animate-up') && textElem.classList.contains(
				'animate-up-active')) {
				textElem.classList.remove('animate-up-active');
			}
			setTimeout(function () {
				textElem.classList.add('animate-up-active');
			}, elemDuration);
		}
	}

	function showSlides(n) {
		var i;
		var slides = document.getElementsByClassName('slideshow-content');
		if (!slides) return;
		var slideIndexCount = document.getElementsByClassName('slide-index');
		var dots = document.getElementsByClassName('dot');

		if (n > slides.length) {
			slideIndex = 1;
		}
		if (n < 1) {
			slideIndex = slides.length;
		}
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = 'none';
			slides[i].classList.remove('show');
		}
		for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(' active', '');
		}

		slides[slideIndex - 1].style.display = 'block';
		slides[slideIndex - 1].classList.add('show');
		dots[slideIndex - 1].className += ' active';
		bgImage = slides[slideIndex - 1].getAttribute('data-src');

		slideIndexCount[0].textContent = slideIndex;
		//if (bgImage)
		document.getElementsByClassName(
			'home-banner-image'
		)[0].style.backgroundImage = 'url(' + bgImage + ')';

		scaleSlide(); // Uncomment for fade effect.
		let title = document.getElementsByClassName('banner-h1');
		let description = document.getElementsByClassName('home-banner-summary');
		let button = document.getElementsByClassName('home-banner-cta-button-container');
		if (title[slideIndex - 1] !== undefined) animateTextUp(title[slideIndex - 1], 150);
		if (title[slideIndex - 1] !== undefined) animateTextUp(description[slideIndex - 1], 750,
			'1s');
		if (button[slideIndex - 1] !== undefined) animateTextUp(button[slideIndex - 1], 750,
			'2s');


	}

	function autoShowSlides() {

		var i;
		var slides = document.getElementsByClassName('slideshow-content');
		if (!slides) return;
		slideIndex++;
		showSlides(slideIndex);
		setTimeout(autoShowSlides, 9000); // Change image every 9 seconds

	}

	var dots = document.getElementsByClassName('dot');
	if (!dots) return;
	for (var i = 0; i < dots.length; i++) {
		dots[i].onclick = function () {
			currentSlide(this.getAttribute('data-index'));
		};
	}
	var nextSlideBtn = document.getElementsByClassName('next-slide');
	var prevSlideBtn = document.getElementsByClassName('prev-slide');
	if (!nextSlideBtn || !prevSlideBtn) return;

	nextSlideBtn[0].onclick = function () {
		plusSlides(1);
	};
	prevSlideBtn[0].onclick = function () {
		plusSlides(-1);
	};
})();
*/
/*-----------------------------------------------------------------------------------------------
	Browsing history product navigation
------------------------------------------------------------------------------------------------- */
/*
(function () {
	"use strict";

	let recentHistorySection = document.getElementsByClassName(
		'woocommerce widget_recently_viewed_products'
	)[0];

	if (!recentHistorySection) return;

	var recentHistorySectionTitleHeader = document.querySelectorAll(
		'#paddle-after-product-sidebar .widget_recently_viewed_products .widget-title'
	)[0];

	if (!recentHistorySectionTitleHeader) return;

	let arrowLeft = document.createElement('span');
	arrowLeft.setAttribute('class', 'paddle-arrow-left');
	let arrowRight = document.createElement('span');
	arrowRight.setAttribute('class', 'paddle-arrow-right');
	let arrowSpanDown = document.createElement('span');
	let arrowSpanUp = document.createElement('span');
	arrowLeft.append(arrowSpanDown);
	arrowRight.append(arrowSpanUp);

	recentHistorySectionTitleHeader.classList.add('nav__scrollerRL');
	// Wrap header in div
	let recentHistorySectionNavHeader =
		"<span id='slide-widget-title-header'>" + recentHistorySectionTitleHeader.innerHTML + '</span>';
	recentHistorySectionTitleHeader.innerHTML = recentHistorySectionNavHeader;
	document
		.getElementById('slide-widget-title-header')
		.insertAdjacentElement('beforebegin', arrowLeft);

	document
		.getElementById('slide-widget-title-header')
		.insertAdjacentElement('beforebegin', arrowRight);

	let scrollerContainer = document.querySelectorAll(
		'#paddle-after-product-sidebar .product_list_widget'
	);

	if (!scrollerContainer) return;

	var recentHistorySectionScroller = scrollerContainer[0];

	recentHistorySectionToggleNavArrow();

	function scrollToNextItem() {
		if (recentHistorySectionScroller.scrollLeft < recentHistorySectionScroller.scrollWidth - recentHistorySectionScroller.clientWidth) {
			// The scroll position is not at the beginning of last item
			recentHistorySectionScroller.scrollBy({
				left: recentHistorySectionScroller.clientWidth,
				top: 0,
				behavior: 'smooth',
			});
		} else {
			// Last item reached. Go back to first item by setting scroll position to 0
			recentHistorySectionScroller.scrollTo({
				left: 0,
				top: 0,
				behavior: 'smooth',
			});
		}
	}

	function scrollToPrevItem() {
		if (recentHistorySectionScroller.scrollLeft != 0) {
			// The scroll position is not at the beginning of first item
			recentHistorySectionScroller.scrollBy({
				left: -recentHistorySectionScroller.clientWidth,
				top: 0,
				behavior: 'smooth',
			});
		}
	}

	// Scroll function
	arrowLeft.onclick = function (e) {
		e.preventDefault();
		scrollToNextItem();
	};

	arrowRight.onclick = function (e) {
		e.preventDefault();
		scrollToPrevItem();
	};

	// Add event listner to scrolling. Hide nav if not necessary
	function recentHistorySectionToggleNavArrow() {
		var scrollerContainer = document.querySelectorAll(
			'#paddle-after-product-sidebar .product_list_widget'
		);
		var recentHistorySectionScroller = scrollerContainer[0];
		var arrowLeft = document.getElementsByClassName('paddle-arrow-left')[0];
		var arrowRight = document.getElementsByClassName('paddle-arrow-right')[0];
		let itemWidth = document.querySelector('.product_list_widget li')
			.clientWidth;
		var itemTotal = document.querySelectorAll(
			'#paddle-after-product-sidebar .product_list_widget li'
		).length;

		if (itemTotal * itemWidth < recentHistorySectionScroller.clientWidth) {
			arrowRight.style.display = 'none';
			arrowLeft.style.display = 'none';
			document.querySelector(
				'.after-single-product ul.product_list_widget'
			).style.overflowX = 'hidden';
		}
	}
}());
*/
/**
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
/*	-----------------------------------------------------------------------------------------------
	Primary Menu Desktop
--------------------------------------------------------------------------------------------------- */

const primaryMenu = {
	init: function () {
		this.focusMenuWithChildren();
	},

	// The focusMenuWithChildren() function implements Keyboard Navigation in the Primary Menu
	// by adding the '.focus' class to all 'li.menu-item-has-children' when the focus is on the 'a' element.
	focusMenuWithChildren: function () {
		// Get all the link elements within the primary menu.
		var links,
			i,
			len,
			menu = document.querySelector('.nav-primary');

		if (!menu) {
			return false;
		}

		links = menu.getElementsByTagName('a');

		//let subMenu = document.getElementsByClassName('submenu-expand');
		let subMenu = document.querySelectorAll('.nav-primary .submenu-expand');
		for (let n = 0; n < subMenu.length; n++) {
			subMenu[n].setAttribute('tabIndex', '-1');
		}

		// Each time a menu link is focused or blurred, toggle focus.
		for (i = 0, len = links.length; i < len; i++) {
			links[i].addEventListener('focus', toggleFocus, true);
			links[i].addEventListener('blur', toggleFocus, true);
		}

		//Sets or removes the .focus class on an element.
		function toggleFocus() {
			var self = this;

			// Move up through the ancestors of the current link until we hit .primary-menu.
			while (-1 === self.className.indexOf('nav-primary')) {
				// On li elements toggle the class .focus.
				if ('li' === self.tagName.toLowerCase()) {
					if (-1 !== self.className.indexOf('focus')) {
						self.className = self.className.replace(' focus', '');
					} else {
						self.className += ' focus';
					}
				}
				self = self.parentElement;
			}
		}
	},
}; // primaryMenu

/*-----------------------------------------------------------------------------------------------
Offcanvas Menu 
------------------------------------------------------------------------------------------------- */
document.addEventListener('DOMContentLoaded', function (event) {
	/*-----------------------------------------------------------------------------------------------
	Activate Keyboard Navigation in the Primary Menu 
	------------------------------------------------------------------------------------------------- */
	primaryMenu.init();

	(function () {
		"use strict";
		const siteNavigation = document.getElementById('main-header-navigation');

		// Return early if the navigation don't exist.
		if (!siteNavigation) {
			return;
		}

		// Copy from main menu to offcanvas menu
		let primaryMenu = document.getElementById('primary-menu');
		if (null === primaryMenu || !primaryMenu) return
		let offcanvasMenu = document.getElementById('offcanvas-menu-items');
		if (null === offcanvasMenu) return
		offcanvasMenu.innerHTML = primaryMenu.innerHTML;

		// Remove menu li id to avoid id duplicate
		let menuLi = document.querySelectorAll('#offcanvas-menu-items li');
		if (menuLi.length > 0) {
			menuLi.forEach(li => {
				li.removeAttribute('id');
				if (li.classList.contains('menu-item')) {
					li.classList.remove('menu-item');
					li.classList.add('nav-menu');
				}
				// For header 6
				if (li.classList.contains('nav-logo')) {
					li.remove();
				}
			});
		}

		// Sub menu toggle navigation
		//const menu = offcanvasMenu.getElementsByTagName( 'ul' )[ 0 ];
		const menu = document.getElementById('offcanvas-menu-items')


		// Hide menu toggle button if menu is empty and return early.
		if ('undefined' === typeof menu) {
			return;
		}

		if (!menu.classList.contains('nav-menu')) {
			menu.classList.add('nav-menu');
		}

		// Get all the link elements within the menu.
		//const links = menu.getElementsByTagName( 'a' );
		let dialogContainer = document.querySelector('#offcanvas-content .paddle-theme-dialog');
		let menuLinks = dialogContainer.getElementsByTagName('a');


		// Get all the link elements with children within the menu.
		const linksWithChildren = menu.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

		// Toggle focus each time a menu link is focused or blurred.
		for (const link of menuLinks) {
			// Wrap div around link

			let wrapper = document.createElement('div');
			wrapper.setAttribute('class', 'link-wrap');
			// insert wrapper before el in the DOM tree
			link.parentNode.insertBefore(wrapper, link);

			// move link into wrapper
			wrapper.appendChild(link);

		}

		// Toggle Submenu 
		let subMenu = document.querySelectorAll('#offcanvas-menu-items .submenu-expand');
		let i;
		for (i = 0; i < subMenu.length; i++) {
			subMenu[i].removeAttribute('tabIndex');
			subMenu[i].addEventListener('click', function () {
				this.classList.toggle('active');
				let panel = this.nextElementSibling;
				if (panel.style.display === 'block') {
					panel.style.display = 'none';
					panel.classList.remove('active-panel');
				} else {
					panel.style.display = 'block';
					panel.classList.add('active-panel');
				}
			});
		}

		// Accesibilities 
		let page = document.getElementById('page');
		if (null === page || !page) return;
		let dialogOverlay = document.createElement('div');
		dialogOverlay.setAttribute('class', 'paddle-theme-dialog-overlay');
		dialogOverlay.setAttribute('tabindex', '-1');
		// Add overlay
		page.parentNode.insertBefore(dialogOverlay, page);



		//Dialog accesibility Credit: https://github.com/ireade/accessible-modal-dialog 

		function Dialog(dialogEl, overlayEl) {

			this.dialogEl = dialogEl;
			this.overlayEl = overlayEl;
			this.focusedElBeforeOpen;

			let focusableEls = this.dialogEl.querySelectorAll('a[href], area[href], input:not([disabled]), .btn, select:not([disabled]), textarea:not([disabled]), button:not([disabled]), [tabindex="0"]');
			this.focusableEls = Array.prototype.slice.call(focusableEls);

			this.firstFocusableEl = this.focusableEls[0];
			this.lastFocusableEl = this.focusableEls[this.focusableEls.length - 1];

			this.close(); // Reset

		}


		Dialog.prototype.open = function () {

			let Dialog = this;

			this.dialogEl.removeAttribute('aria-hidden');
			this.overlayEl.removeAttribute('aria-hidden');
			this.overlayEl.parentNode.classList.add('overflow-hidden');
			//this.dialogEl.classList.add('show-dialog');
			this.dialogEl.style.display = 'flex';

			this.focusedElBeforeOpen = document.activeElement;

			this.dialogEl.addEventListener('keydown', function (e) {
				Dialog._handleKeyDown(e);
			});

			this.overlayEl.addEventListener('click', function () {
				Dialog.close();
			});

			this.firstFocusableEl.focus();

		};

		Dialog.prototype.close = function () {

			this.dialogEl.setAttribute('aria-hidden', true);
			this.overlayEl.setAttribute('aria-hidden', true);
			this.overlayEl.parentNode.classList.remove('overflow-hidden');
			this.dialogEl.classList.add('hide-dialog');
			//this.dialogEl.style.display = 'none';

			setTimeout(function () {
				let navDialogEl = document.querySelector('#offcanvas-content .paddle-theme-dialog');
				navDialogEl.style.display = 'none';
			}, 320)




			if (this.focusedElBeforeOpen) {
				this.focusedElBeforeOpen.focus();
				this.dialogEl.classList.remove('show-dialog')
			}
		};


		Dialog.prototype._handleKeyDown = function (e) {

			let Dialog = this;
			let KEY_TAB = 9;
			let KEY_ESC = 27;

			function handleBackwardTab() {
				if (document.activeElement === Dialog.firstFocusableEl) {
					e.preventDefault();
					Dialog.lastFocusableEl.focus();
				}
			}
			function handleForwardTab() {
				if (document.activeElement === Dialog.lastFocusableEl) {
					e.preventDefault();
					Dialog.firstFocusableEl.focus();
				}
			}

			switch (e.keyCode) {
				case KEY_TAB:
					if (Dialog.focusableEls.length === 1) {
						e.preventDefault();
						break;
					}
					if (e.shiftKey) {
						handleBackwardTab();
					} else {
						handleForwardTab();
					}
					break;
				case KEY_ESC:
					Dialog.close();
					break;
				default:
					break;
			}


		};


		Dialog.prototype.addEventListeners = function (openDialogSel, closeDialogSel) {

			let Dialog = this;

			let openDialogEls = document.querySelectorAll(openDialogSel);
			for (let i = 0; i < openDialogEls.length; i++) {
				openDialogEls[i].addEventListener('click', function () {
					Dialog.open();
				});
			}

			let closeDialogEls = document.querySelectorAll(closeDialogSel);
			for (let i = 0; i < closeDialogEls.length; i++) {
				closeDialogEls[i].addEventListener('click', function () {
					Dialog.close();
				});
			}

		};

		let navDialogEl = document.querySelector('#offcanvas-content .paddle-theme-dialog');
		let dialogOverlay1 = document.querySelector('.paddle-theme-dialog-overlay');

		if (null !== navDialogEl && null !== dialogOverlay1) {


			let myDialog = new Dialog(navDialogEl, dialogOverlay1);
			myDialog.addEventListeners('.open-dialog', '.close-dialog');


			let closeButton = document.querySelector('.open-dialog');

			if (null !== closeButton) {

				closeButton.addEventListener('click', function () {
					if (navDialogEl.style.display === 'flex' && null === navDialogEl.getAttribute('aria-hidden')) {
						setTimeout(function () {
							navDialogEl.classList.remove('hide-dialog')
							navDialogEl.classList.add('show-dialog');
						}, 10)

					} else {
						navDialogEl.classList.add('hide-dialog')
						navDialogEl.classList.remove('show-dialog')
					}
				})
			}


		}

	}());

	/*	-----------------------------------------------------------------------------------------------
	  Replace commas in tags and category list link
	--------------------------------------------------------------------------------------------------- */
	//replaceCommas('.cat-links');
		//replaceCommas('.tags-links');
	

	})

/*-----------------------------------------------------------------------------------------------
Search Modal
------------------------------------------------------------------------------------------------- */
class SearchModal extends HTMLElement {
	constructor() {
		super();

		this.searchModal = document.getElementById('searchModal');
		this.dialogEl = this.searchModal.querySelector('.modal-dialog');
		this.focusedElBeforeOpen = document.activeElement;
		this.onBodyClick = this.handleBodyClick.bind(this);

		this.searchInput = this.searchModal.querySelector('input[type="text"]');

		this.searchModal.addEventListener('keyup', this.handleKeyEsc);

		let focusableEls = this.dialogEl.querySelectorAll('a[href], area[href], input:not([disabled]), .btn, select:not([disabled]), textarea:not([disabled]), button:not([disabled]), [tabindex="0"]');
		this.focusableEls = Array.prototype.slice.call(focusableEls);

		this.firstFocusableEl = this.focusableEls[0];
		this.lastFocusableEl = this.focusableEls[this.focusableEls.length - 1];

		this.querySelectorAll('button[type="button.btn-close"]').forEach((closeButton) =>
			closeButton.addEventListener('click', this.close.bind(this))
		);

		this.toggleSearchModal();
		this.checkTabPress();
	}

	open() {
		this.searchModal.classList.add('fade', 'active');
		this.searchModal.removeAttribute('aria-hidden');
		this.searchModal.setAttribute('aria-modal', 'true');
		this.searchModal.setAttribute('role', 'dialog');
		this.firstFocusableEl.focus();

		document.body.addEventListener('click', this.onBodyClick);

	}


	close() {
		this.searchModal.setAttribute('aria-hidden', 'true');
		this.searchModal.removeAttribute('aria-modal');
		this.searchModal.removeAttribute('role');
		document.body.removeEventListener('click', this.onBodyClick);
		this.searchModal.classList.remove('active');
		this.focusedElBeforeOpen.classList.remove('active');
		this.focusedElBeforeOpen.focus();
	}

	// close button
	handleCloseBtn() {
		var self = this;
		document.querySelector('.cart-notification__close').addEventListener('click', function () {
			if (document.querySelector('#cart-icon-bubble'))
				self.handleActive(document.querySelector('#cart-icon-bubble'));
		})
	}

	toggleSearchModal() {
		this.getSectionsToRender().forEach((section => {
			let elem = document.querySelector(section.id);
			if (elem) {
				elem.addEventListener('click', (e) => {
					e.preventDefault();

					this.handleActive(elem)
					this.focusedElBeforeOpen = elem;
				})
			}

		}));
	}

	handleActive(elem) {
		if (elem.classList.contains('active')) {
			elem.classList.remove('active');
			this.close();
		} else {
			this.open();
			elem.classList.add('active');
		}
	}

	getSectionsToRender() {
		return [
			{
				id: '.button-search'
			}
		];
	}


	handleBodyClick(evt) {
		const target = evt.target;

		if (target !== this.dialogEl && !target.closest('#search-glass') && !target.closest('form')) {
			this.close();
			document.getElementById('search-glass').classList.remove('active');
		}

	}

	setActiveElement(element) {
		this.activeElement = element;
	}


	checkTabPress() {

		let Dialog = this.searchModal
		const focusableElements =
			'button, [href], input, select, textarea, button, [tabindex]:not([tabindex="-1"])';

		const firstFocusableElement = Dialog.querySelectorAll(focusableElements)[0]; // get first element to be focused inside modal
		const focusableContent = Dialog.querySelectorAll(focusableElements);
		const lastFocusableElement = focusableContent[focusableContent.length - 1]; // get last element to be focused inside modal

		document.addEventListener('keydown', function (e) {
			let isTabPressed = e.key === 'Tab' || e.keyCode === 9;

			if (!isTabPressed) {
				return;
			}

			if (e.shiftKey) { // if shift key pressed for shift + tab combination
				if (document.activeElement === firstFocusableElement) {
					lastFocusableElement.focus(); // add focus for the last focusable element
					e.preventDefault();
				}
			} else { // if tab key is pressed
				if (document.activeElement === lastFocusableElement) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
					firstFocusableElement.focus(); // add focus for the first focusable element
					e.preventDefault();
				}
			}
		})
	}

	handleKeyEsc = function (e) {

		let KEY_ESC = 27;

		switch (e.keyCode) {
			case KEY_ESC:
				this.close();
				this.focusedElBeforeOpen.classList.remove('active');
				this.focusedElBeforeOpen.focus();
				break;
			default:
				break;
		}

	};

}

customElements.get('search-modal') || customElements.define('search-modal', SearchModal);

