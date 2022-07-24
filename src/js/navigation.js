/**
 * File navigation.js.
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
	  for(let n = 0; n < subMenu.length; n++) {
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

  document.addEventListener('DOMContentLoaded', function (event) {
	/*-----------------------------------------------------------------------------------------------
	Activate Keyboard Navigation in the Primary Menu 
	------------------------------------------------------------------------------------------------- */
	primaryMenu.init();

	/*-----------------------------------------------------------------------------------------------
	Offcanvas Menu 
	------------------------------------------------------------------------------------------------- */

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
			});
		}
	
		// Sub menu toggle navigation
		//const menu = offcanvasMenu.getElementsByTagName( 'ul' )[ 0 ];
		const menu = document.getElementById('offcanvas-menu-items')
		
	
		// Hide menu toggle button if menu is empty and return early.
		if ( 'undefined' === typeof menu ) {
			return;
		}
	
		if ( ! menu.classList.contains( 'nav-menu' ) ) {
			menu.classList.add( 'nav-menu' );
		}
	
		// Get all the link elements within the menu.
		//const links = menu.getElementsByTagName( 'a' );
		let dialogContainer = document.querySelector('#offcanvas-content .paddle-theme-dialog');
		let menuLinks = dialogContainer.getElementsByTagName( 'a' );
	
	
		// Get all the link elements with children within the menu.
		const linksWithChildren = menu.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );
	
		// Toggle focus each time a menu link is focused or blurred.
		for ( const link of menuLinks ) {
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
			
			setTimeout(function() {
				let navDialogEl = document.querySelector('#offcanvas-content .paddle-theme-dialog');
				navDialogEl.style.display = 'none';
			},320)
			
			
		
	
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
			
			if(null !== navDialogEl && null !== dialogOverlay1) {
	
				
				let myDialog = new Dialog(navDialogEl, dialogOverlay1);
				myDialog.addEventListeners('.open-dialog', '.close-dialog');
	
				
				let closeButton =  document.querySelector('.open-dialog');

				if( null !== closeButton ) {

					closeButton.addEventListener('click', function() {								
						if (navDialogEl.style.display === 'flex' && null === navDialogEl.getAttribute('aria-hidden')) 
						{
							setTimeout(function() {
								navDialogEl.classList.remove('hide-dialog')
								navDialogEl.classList.add('show-dialog');
							},10)
							
						} else {
								navDialogEl.classList.add('hide-dialog')
								navDialogEl.classList.remove('show-dialog')
						}
					})
				}
	
				
			}
		
	}());

  })