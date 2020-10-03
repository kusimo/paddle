/**
 * Theme JavaScript 
 */
( function() {


/*	-----------------------------------------------------------------------------------------------
	Replace commas in tags and category list link
--------------------------------------------------------------------------------------------------- */
 
    function replaceCommas(divClass) {
        // Get the class name.
        let itemContainer = document.querySelectorAll(divClass);

        itemContainer.forEach(function(linksArray) {
            // Check if class exist on the page.
            if ( ! linksArray || undefined === linksArray) {
                return;
            }
            // Get the inner html.
            linksArrayHtml = linksArray.innerHTML;
            // Check if the inner html has ',' if not bail.
            if(!linksArrayHtml.includes(',')) {
                return
            } 
            // Replace commas with empty.
            linksArray.innerHTML = linksArrayHtml.replace(/,/g, '');
        }) // Foreach.

    } // replaceCommas.
    
    replaceCommas('.cat-links');
    replaceCommas('.tags-links');
   
  
    

}() );

/*	-----------------------------------------------------------------------------------------------
	Primary Menu
--------------------------------------------------------------------------------------------------- */

primaryMenu = {

	init: function() {
		this.focusMenuWithChildren();
	},

	// The focusMenuWithChildren() function implements Keyboard Navigation in the Primary Menu
	// by adding the '.focus' class to all 'li.menu-item-has-children' when the focus is on the 'a' element.
	focusMenuWithChildren: function() {
		// Get all the link elements within the primary menu.
		var links, i, len,
			menu = document.querySelector( '.nav-primary' );

		if ( ! menu ) {
			return false;
        } 
        
		links = menu.getElementsByTagName( 'a' );

		// Each time a menu link is focused or blurred, toggle focus.
		for ( i = 0, len = links.length; i < len; i++ ) {
			links[i].addEventListener( 'focus', toggleFocus, true );
            links[i].addEventListener( 'blur', toggleFocus, true );
		}

		//Sets or removes the .focus class on an element.
		function toggleFocus() {
			var self = this;

			// Move up through the ancestors of the current link until we hit .primary-menu.
			while ( -1 === self.className.indexOf( 'nav-primary' ) ) {
                // On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					if ( -1 !== self.className.indexOf( 'focus' ) ) {
						self.className = self.className.replace( ' focus', '' );
					} else {
						self.className += ' focus';
					}
				}
				self = self.parentElement;
			}
		}
	}
}; // primaryMenu

document.addEventListener("DOMContentLoaded", function(event) { 
    primaryMenu.init(); 
})

/*	-----------------------------------------------------------------------------------------------
	Mobile Menu
--------------------------------------------------------------------------------------------------- */
/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
document.addEventListener("DOMContentLoaded", function(event) { 

	const siteNavigation = document.getElementById( 'js-bootstrap-offcanvas' );

	// Return early if the navigation don't exist.
	if ( ! siteNavigation ) {
		return;
	} 

	const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];


	// Get all the link elements within the menu.
	const links = menu.getElementsByTagName( 'a' );


	// Get all the link elements with children within the menu.
	const linksWithChildren = menu.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );
	
	// Toggle focus each time a menu link is focused or blurred.
	for ( const link of links ) {
		link.addEventListener( 'focus', toggleFocus, true );
		link.addEventListener( 'blur', toggleFocus, true );
	}

	// Toggle focus each time a menu link with children receive a touch event.
	for ( const link of linksWithChildren ) {
		link.addEventListener( 'touchstart', toggleFocus, false );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		if ( event.type === 'focus' || event.type === 'blur' ) {
			let self = this;
			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( ! self.classList.contains( 'nav-menu' ) ) {
				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					self.classList.toggle( 'focus' );
				}
				self = self.parentNode;
			}
		}

		if ( event.type === 'touchstart' ) {
			const menuItem = this.parentNode;
			event.preventDefault();
			for ( const link of menuItem.parentNode.children ) {
				if ( menuItem !== link ) {
					link.classList.remove( 'focus' );
				}
			}
			menuItem.classList.toggle( 'focus' );
		}
	}

	/** Expand submenu on click of parent */
	var subMenu = document.getElementsByClassName("submenu-expand");
	var i;
	for (i = 0; i < subMenu.length; i++) {
		subMenu[i].addEventListener("click", function() {
		  this.classList.toggle("active");
		  var panel = this.nextElementSibling;
		  if (panel.style.display === "block") {
			panel.style.display = "none";
			panel.classList.remove("active-panel");
		  } else {
			panel.style.display = "block";
			panel.classList.add("active-panel"); 
		  }
		});
	  }

} );

/*	-----------------------------------------------------------------------------------------------
	Set focus on modal search input on button clicked.
--------------------------------------------------------------------------------------------------- */

( function() {

	let searchBtnContainer = document.getElementById('search-glass');

	searchBtnContainer.addEventListener( 'click', function(e) {

	
	if ( ! searchBtnContainer )
	return;

	let searchFormContainer = document.getElementById('searchModal').getElementsByTagName('form');
	if ( ! searchFormContainer ) 
	return;

	
	//if( textBox ) return;
	setTimeout(function() {
		const inputs = searchFormContainer[0].elements;
		if ( ! inputs )
			return;
		inputs[0].focus();
	},500) // End set time out.
	

	})

} () )
