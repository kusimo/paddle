/**
 * Theme JavaScript
 */
(function () {
  'use strict';

  /*	-----------------------------------------------------------------------------------------------
	Replace commas in tags and category list link
--------------------------------------------------------------------------------------------------- */

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
      linksArray.innerHTML = linksArrayHtml.replace(/,/g, '');
    }); // Foreach.
  } // replaceCommas.

  replaceCommas('.cat-links');
  replaceCommas('.tags-links');
})();



document.addEventListener('DOMContentLoaded', function (event) {

  /*-----------------------------------------------------------------------------------------------
	Change Zoom image Magnifier
  ------------------------------------------------------------------------------------------------- */

  (function() {
    "use strict";
    let haveWoo = document.querySelectorAll("body.woocommerce");
    if(!haveWoo) return;
    setTimeout(function() {
      let triggerContainer = document.getElementsByClassName("woocommerce-product-gallery__trigger")[0];
     
      if(!triggerContainer) return;  
      

      let imageInner =  triggerContainer.getElementsByTagName("img")
      for(let i=0;i<imageInner.length;i++){
        let x = imageInner[i];
        if(i === 0)
        x.setAttribute('src', 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBkPSJNMTMgMTBoLTN2M2gtMnYtM2gtM3YtMmgzdi0zaDJ2M2gzdjJ6bTguMTcyIDE0bC03LjM4Ny03LjM4N2MtMS4zODguODc0LTMuMDI0IDEuMzg3LTQuNzg1IDEuMzg3LTQuOTcxIDAtOS00LjAyOS05LTlzNC4wMjktOSA5LTkgOSA0LjAyOSA5IDljMCAxLjc2MS0uNTE0IDMuMzk4LTEuMzg3IDQuNzg1bDcuMzg3IDcuMzg3LTIuODI4IDIuODI4em0tMTIuMTcyLThjMy44NTkgMCA3LTMuMTQgNy03cy0zLjE0MS03LTctNy03IDMuMTQtNyA3IDMuMTQxIDcgNyA3eiIvPjwvc3ZnPg==');  
    }
    },200) 

  }());
  
});

/*	-----------------------------------------------------------------------------------------------
	Set focus on modal search input on button clicked.
--------------------------------------------------------------------------------------------------- */

(function () {
  "use strict";
  // Set focus
  let searchBtnContainer = document.getElementById('search-glass');

  if( null !== searchBtnContainer ) {
    searchBtnContainer.addEventListener('click', function (e) {
      if (!searchBtnContainer) return;

      let searchFormContainer = document
        .getElementById('searchModal')
        .getElementsByTagName('form');
      if (!searchFormContainer) return;

      //if( textBox ) return;
      setTimeout(function () {
        const inputs = searchFormContainer[0].elements;
        if (!inputs) return;
        inputs[0].focus();
      }, 500); // End set time out.
    });
  }
 

  // Tab key navigation
  let searchModal = document.getElementById('searchModal');
  if( ! searchModal ) return;
  searchModal.addEventListener('keyup', checkTabPress);

  function checkTabPress(e) {
    e = e || event;
    var activeElement;
    if (e.keyCode == 9) {
      activeElement = document.activeElement;
      let btnClose = document.querySelector('#searchModal .btn-close')
      if( !btnClose ) return;
      if(activeElement.tabIndex === -1) {
        if(e.shiftKey) {								
          btnClose.focus();
          } 
      }
      if(activeElement.className.includes('fade') && !e.shiftKey) {
          let inp = document.querySelector('#searchModal #s')
          if (! inp ) return;
          inp.focus()
        }
    }
  }

})();



/*	-----------------------------------------------------------------------------------------------
	Homepage Slider
--------------------------------------------------------------------------------------------------- */
(function() {
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

      setTimeout(function() {
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
          setTimeout(function() {
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
      dots[i].onclick = function() {
          currentSlide(this.getAttribute('data-index'));
      };
  }
  var nextSlideBtn = document.getElementsByClassName('next-slide');
  var prevSlideBtn = document.getElementsByClassName('prev-slide');
  if (!nextSlideBtn || !prevSlideBtn) return;

  nextSlideBtn[0].onclick = function() {
      plusSlides(1);
  };
  prevSlideBtn[0].onclick = function() {
      plusSlides(-1);
  };
})();

(function() {
	"use strict";

/*-----------------------------------------------------------------------------------------------
	Browsing history product navigation
------------------------------------------------------------------------------------------------- */

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

