jQuery( document ).ready(function($) {
	"use strict";

	/**
	 * Sortable Repeater Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */

	// Update the values for all our input fields and initialise the sortable repeater
	$('.sortable_repeater_control').each(function() {
		// If there is an existing customizer value, populate our rows
		var defaultValuesArray = $(this).find('.customize-control-sortable-repeater').val().split(',');
		let sortableHaveMultiple = false;
		var numRepeaterItems = defaultValuesArray.length;

		if(numRepeaterItems > 0) {
			// Add the first item to our existing input field
			var isMultipleInput = $(this).find('.is-multiple-input')
			
			if(isMultipleInput.length) {
				sortableHaveMultiple = true;
				$(this).find('.repeater-input.is-text').val(defaultValuesArray[0]);
				$(this).find('.repeater-input.is-url').val(defaultValuesArray[1]);
			} else {
				$(this).find('.repeater-input.is-url').val(defaultValuesArray[0]);
			}

			

			// Create a new row for each new value
			if(sortableHaveMultiple) {
				//numRepeaterItems = numRepeaterItems / 2;
			}

			// Repeater with no multiple inputs
			if(numRepeaterItems > 1 && !sortableHaveMultiple) {
				var i;
				for (i = 1; i < numRepeaterItems; ++i) {
					paddleAppendRow($(this), defaultValuesArray[i]);
				}
			} else {
				// Loop through multiple inputs
				var i;
				
				for (i = 1; i < numRepeaterItems / 2; ++i) {
					paddleAppendRow($(this), defaultValuesArray[i], defaultValuesArray[i]);
				}

				// Update the value of each input with the array
				// count the number of input fields
				var inputFields = $(this).find('.repeater-input');
				// update the input fields with text
				var c;
				for (c = 0; c < inputFields.length; c++) {
					inputFields[c].setAttribute('value',defaultValuesArray[c])
				}
			}
		}
	});

	// Make our Repeater fields sortable
	$(this).find('.sortable_repeater.sortable').sortable({
		update: function(event, ui) {
			paddleGetAllInputs($(this).parent());
		}
	});

	// Remove item starting from it's parent element
	$('.sortable_repeater.sortable').on('click', '.customize-control-sortable-repeater-delete', function(event) {
		event.preventDefault();
		var numItems = $(this).parent().parent().find('.repeater').length;

		if(numItems > 1) {
			$(this).parent().slideUp('fast', function() {
				var parentContainer = $(this).parent().parent();
				$(this).remove();
				paddleGetAllInputs(parentContainer);
			})
		}
		else {
			$(this).parent().find('.repeater-input').val('');
			paddleGetAllInputs($(this).parent().parent().parent());
		}
	});

	// Add new item
	$('.customize-control-sortable-repeater-add').click(function(event) {
		event.preventDefault();
		paddleAppendRow($(this).parent());
		paddleGetAllInputs($(this).parent());
	});

	// Refresh our hidden field if any fields change
	$('.sortable_repeater.sortable').change(function() {
		paddleGetAllInputs($(this).parent());
	})

	// Add https:// to the start of the URL if it doesn't have it
	$('.sortable_repeater.sortable').on('blur', '.repeater-input', function() {
		var url = $(this);
		var val = url.val();
		
		if(val && !val.match(/^.+:\/\/.*/) && !url.hasClass('is-text')) {
			// Important! Make sure to trigger change event so Customizer knows it has to save the field
			//url.val('https://' + val.replace(/\s+/g, '')).trigger('change');
			url.val(val.replace(/\s+/g, '')).trigger('change');
		}
		
	});

	// Save changes on blur
	$('.sortable_repeater.sortable').on('blur', '.repeater-input.is-text', function() {
		var url = $(this);
		var val = url.val();
			// Important! Make sure to trigger change event so Customizer knows it has to save the field
			//url.val(val.replace('https://', '')).trigger('change');
	});

	// Append a new row to our list of elements
	function paddleAppendRow($element, defaultValue = '', defaultValue2 = '') {
		var isMultipleInput = $element.find('.is-multiple-input') //$('.is-multiple-input');
		var multipleInput = '';
		if(isMultipleInput.length) {
			multipleInput = `<input type="text" value="${defaultValue2}" class="repeater-input is-text" placeholder="title" />`;
		}
		var newRow = `<div class="repeater" style="display:none">
		${multipleInput}
		<input type="text" value="${defaultValue}" class="repeater-input is-url" placeholder="https://" />
		<span class="dashicons dashicons-sort"></span>
		<a class="customize-control-sortable-repeater-delete" href="#"><span class="dashicons dashicons-no-alt"></span></a></div>`;

		$element.find('.sortable').append(newRow);
		$element.find('.sortable').find('.repeater:last').slideDown('slow', function(){
			$(this).find('input:first').focus();
		});
	}

	// Get the values from the repeater input fields and add to our hidden field
	function paddleGetAllInputs($element) {
		var inputValues = $element.find('.repeater-input').map(function() {
			return $(this).val();
		}).toArray();
		// Add all the values from our repeater fields to the hidden field (which is the one that actually gets saved)
		$element.find('.customize-control-sortable-repeater').val(inputValues);
		
		// Important! Make sure to trigger change event so Customizer knows it has to save the field
		$element.find('.customize-control-sortable-repeater').trigger('change');
	}

	/**
	 * Slider Custom Control
	 *
	 * @author Anthony Hortin
	 */

	// Add event listener to secondary color value change
	let secondaryButton = document.querySelector('#customize-control-paddle_secondary_color .wp-color-result');
	if (typeof(secondaryButton) != 'undefined' && secondaryButton != null) {
		secondaryButton.addEventListener('blur', function(event) {
			let currentColorValue = secondaryButton.style.backgroundColor;
			const button = event.target;
			setTimeout(function() {
				if(button.style.backgroundColor != currentColorValue) {
					let resetButton = document.querySelector('#customize-control-opacity_slider_control .slider-reset');
					//resetButton.click();
				}
			},200)
	
		})
	}

	let colorPicker = document.querySelector('#customize-control-paddle_secondary_color .wp-color-picker');
	if (typeof(colorPicker) != 'undefined' && colorPicker != null) {
		let secondaryButton = document.querySelector('#customize-control-paddle_secondary_color .wp-color-result');
		let currentColorValue = secondaryButton.style.backgroundColor;
		colorPicker.addEventListener('blur', function() {
			setTimeout(function() {
			if(document.querySelector('#customize-control-paddle_secondary_color .wp-color-result').style.backgroundColor != currentColorValue) {
				let resetButton = document.querySelector('#customize-control-opacity_slider_control .slider-reset');
				//resetButton.click();
			}
			},200)
		})
	}

	// Set our slider defaults and initialise the slider
	$('.slider-custom-control').each(function(){
		var sliderValue = $(this).find('.customize-control-slider-value').val();
		var newSlider = $(this).find('.slider');
		var sliderMinValue = parseFloat(newSlider.attr('slider-min-value'));
		var sliderMaxValue = parseFloat(newSlider.attr('slider-max-value'));
		var sliderStepValue = parseFloat(newSlider.attr('slider-step-value'));

		// Set RGBA Color value
		let ImageOpacity = $(this).find('.opacity-image');
		if(ImageOpacity.length > 0) {
			let colorValue = $(this).parent().prev().find('.wp-color-result').css('backgroundColor');
			
			let opacityValue = sliderValue;
			if(opacityValue == '10') opacityValue = 99;
			if(opacityValue == '0'){
				ImageOpacity.addClass('checked-background')
			} else {
				ImageOpacity.removeClass('checked-background')
			}
			let new_col = colorValue.replace(/rgb/i, "rgba");
			new_col = new_col.replace(/\)/i,',0.'+opacityValue+')');
			ImageOpacity.css('background-color', new_col);			
		}

		newSlider.slider({
			value: sliderValue,
			min: sliderMinValue,
			max: sliderMaxValue,
			step: sliderStepValue,
			change: function(e,ui){
				// Important! When slider stops moving make sure to trigger change event so Customizer knows it has to save the field
				$(this).parent().find('.customize-control-slider-value').trigger('change');
	      }
		});
	});

	// Change the value of the input field as the slider is moved
	$('.slider').on('slide', function(event, ui) {
		$(this).parent().find('.customize-control-slider-value').val(ui.value);
		//Set opacity if changing color value
		let opacityImage = $(this).parent().find('.opacity-image');
		if (typeof(opacityImage) != 'undefined' && opacityImage != null && opacityImage.length > 0) {
			let new_col = $(this).parent().parent().prev().find('.wp-color-result').css('backgroundColor').replace(/rgb/i, "rgba");
			let opacityValue = ui.value;
			if(opacityValue == '10') opacityValue = 99;
			if(opacityValue == '0'){
				opacityImage.addClass('checked-background')
			} else {
				opacityImage.removeClass('checked-background')
			}
			new_col = new_col.replace(/\)/i,',0.'+opacityValue+')');
			opacityImage.css('background-color', new_col);
		}
		
		// Logo slider
        const logoSlider = $(this).prev().attr('id');
		if(logoSlider.includes('logo_size')) {
		//$("#customize-preview>iframe").contents().find('.site-logo img').css('max-height', ui.value)
		}

	});

	// Reset slider and input field back to the default value
	$('.slider-reset').on('click', function() {
		var resetValue = $(this).attr('slider-reset-value');//$(this).parent().find('.slider').attr('slider-min-value'); 
		$(this).parent().find('.customize-control-slider-value').val(resetValue);
		$(this).parent().find('.slider').slider('value', resetValue);
		let ImageOpacity = $(this).parent().find('.opacity-image');
	
		if(ImageOpacity.length > 0) {
			let colorRgb = $(this).parent().parent().prev().find('.wp-color-result').css('backgroundColor');
			let currentColorValue = $(this).parent().find('.slider').attr('slider-min-value');
			let opacityValue;
			opacityValue = currentColorValue;
			if(currentColorValue == '10') opacityValue = 99;
			if(currentColorValue == '0'){
				ImageOpacity.addClass('checked-background')
			} else {
				ImageOpacity.removeClass('checked-background')
			}

			let new_col = colorRgb.replace(/rgb/i, "rgba");
			new_col = new_col.replace(/\)/i,',0.'+opacityValue+')');
			ImageOpacity.css('background-color', new_col);
			
		}
		
	});

	// Update slider if the input field loses focus as it's most likely changed
	$('.customize-control-slider-value').blur(function() {
		var resetValue = $(this).val();
		var slider = $(this).parent().find('.slider');
		var sliderMinValue = parseInt(slider.attr('slider-min-value'));
		var sliderMaxValue = parseInt(slider.attr('slider-max-value'));

		// Make sure our manual input value doesn't exceed the minimum & maxmium values
		if(resetValue < sliderMinValue) {
			resetValue = sliderMinValue;
			$(this).val(resetValue);
		}
		if(resetValue > sliderMaxValue) {
			resetValue = sliderMaxValue;
			$(this).val(resetValue);
		}
		$(this).parent().find('.slider').slider('value', resetValue);
	});

	/**
	 * TinyMCE Custom Control
	 *
	 * @author Anthony Hortin 
	 */

	$('.customize-control-tinymce-editor').each(function(){
		// Get the toolbar strings that were passed from the PHP Class
		var tinyMCEToolbar1String = _wpCustomizeSettings.controls[$(this).attr('id')].paddletinymcetoolbar1;
		var tinyMCEToolbar2String = _wpCustomizeSettings.controls[$(this).attr('id')].paddletinymcetoolbar2;
		var tinyMCEMediaButtons = _wpCustomizeSettings.controls[$(this).attr('id')].paddlemediabuttons;

		wp.editor.initialize( $(this).attr('id'), {
			tinymce: {
				wpautop: true,
				toolbar1: tinyMCEToolbar1String,
				toolbar2: tinyMCEToolbar2String
			},
			quicktags: true,
			mediaButtons: tinyMCEMediaButtons
		});
	});
	$(document).on( 'tinymce-editor-init', function( event, editor ) {
		editor.on('change', function(e) {
			tinyMCE.triggerSave();
			$('#'+editor.id).trigger('change');
		});
	});


 	/**
	 * Theme Slider Custom Control
	 *
	 * @author Anthony Hortin
	 * .slider-custom-control = .theme-slider-control
	 * .slider-control-slider-value = theme-slider-control-slider-value
	 * .slider =  .theme-slider
	 * .slider-reset = .theme-slider-reset
	 */

	// Set our slider defaults and initialise the slider
	$('.theme-slider-control').each(function(){
		var sliderValue = $(this).find('.theme-slider-control-slider-value').val();
		var newSlider = $(this).find('.theme-slider');
		var sliderMinValue = parseFloat(newSlider.attr('slider-min-value'));
		var sliderMaxValue = parseFloat(newSlider.attr('slider-max-value'));
		var sliderStepValue = parseFloat(newSlider.attr('slider-step-value'));

		newSlider.theme-slider({
			value: sliderValue,
			min: sliderMinValue,
			max: sliderMaxValue,
			step: sliderStepValue,
			change: function(e,ui){
				// Important! When slider stops moving make sure to trigger change event so Customizer knows it has to save the field
				$(this).parent().find('.theme-slider-control-slider-value').trigger('change');
	      }
		});
	});

	// Change the value of the input field as the slider is moved
	$('.theme-slider').on('slide', function(event, ui) {
		$(this).parent().find('.theme-slider-control-slider-value').val(ui.value);
	});

	// Reset slider and input field back to the default value
	$('.theme-slider-reset').on('click', function() {
		var resetValue = $(this).attr('slider-reset-value');
		$(this).parent().find('.theme-slider-control-slider-value').val(resetValue);
		$(this).parent().find('.theme-slider').theme-slider('value', resetValue);
	});

	// Update slider if the input field loses focus as it's most likely changed
	$('.theme-slider-control-slider-value').blur(function() {
		var resetValue = $(this).val();
		var slider = $(this).parent().find('.theme-slider');
		var sliderMinValue = parseInt(slider.attr('slider-min-value'));
		var sliderMaxValue = parseInt(slider.attr('slider-max-value'));

		// Make sure our manual input value doesn't exceed the minimum & maxmium values
		if(resetValue < sliderMinValue) {
			resetValue = sliderMinValue;
			$(this).val(resetValue);
		}
		if(resetValue > sliderMaxValue) {
			resetValue = sliderMaxValue;
			$(this).val(resetValue);
		}
		$(this).parent().find('.theme-slider').theme-slider('value', resetValue);
	});

	/** @todo Remove this not using it
	 * Single Accordion Custom Control
	 *
	 * @author Anthony Hortin 
	 */

	$('.single-accordion-toggle').click(function() {
		var $accordionToggle = $(this);
		$(this).parent().find('.single-accordion').slideToggle('slow', function() {
			$accordionToggle.toggleClass('single-accordion-toggle-rotate', $(this).is(':visible'));
		});
	});

	/** @todo Remove this not using it
	 * Image Checkbox Custom Control
	 *
	 * @author Anthony Hortin
	 */

	$('.multi-image-checkbox').on('change', function () {
	  paddleGetAllImageCheckboxes($(this).parent().parent());
	});

	// Get the values from the checkboxes and add to our hidden field
	function paddleGetAllImageCheckboxes($element) {
	  var inputValues = $element.find('.multi-image-checkbox').map(function() {
	    if( $(this).is(':checked') ) {
	      return $(this).val();
	    }
	  }).toArray();
	  // Important! Make sure to trigger change event so Customizer knows it has to save the field
	  $element.find('.customize-control-multi-image-checkbox').val(inputValues).trigger('change');
	}

	/** @todo Remove this not using it
	 * Pill Checkbox Custom Control
	 *
	 * @author Anthony Hortin 
	 */

	$( ".pill_checkbox_control .sortable" ).sortable({
		placeholder: "pill-ui-state-highlight",
		update: function( event, ui ) {
			paddleGetAllPillCheckboxes($(this).parent());
		}
	});

	$('.pill_checkbox_control .sortable-pill-checkbox').on('change', function () {
		paddleGetAllPillCheckboxes($(this).parent().parent().parent());
	});

	// Get the values from the checkboxes and add to our hidden field
	function paddleGetAllPillCheckboxes($element) {
		var inputValues = $element.find('.sortable-pill-checkbox').map(function() {
			if( $(this).is(':checked') ) {
				return $(this).val();
			}
		}).toArray();
		$element.find('.customize-control-sortable-pill-checkbox').val(inputValues).trigger('change');
	}

	// Color section change select color title to the label title
	let colorTitleLabel = document.querySelectorAll('li[id^="customize-control-paddle_theme_color"] .customize-control-title');
	let colorTitlePrimaryLabel = document.querySelectorAll('li[id^="customize-control-paddle_primary_color"] .customize-control-title');
	
	replaceLabelTitle(colorTitlePrimaryLabel);
	replaceLabelTitle(colorTitleLabel);

	function replaceLabelTitle(selectors) {
		if( selectors.length > 0 ) {
			selectors.forEach(elem => {
				let parentElem = elem.parentElement;
				let container = parentElem.querySelector('.wp-color-result-text');
				if(container) {
					container.textContent = elem.textContent
				}
			})
		}
	}

	/**
	 * Find control's last element and add class to it
	 */
	function addClassToLastItem(items, classNameToAdd) {
		let itemToFind = document.querySelectorAll(items);
		if (itemToFind.length > 0) {
			let lastElement = [...document.querySelectorAll(items)].pop()
			lastElement.classList.add(classNameToAdd);
		}
	}

	let paddleCustomControlsClass = 
	['.customize-control-toggle_switch_2', 
	'.customize-control-toggle_switch', 
	'#customize-control-paddle_sidebar_position',
	'#customize-control-paddle_sidebar_position_page',
	'.customize-control-image_radio_button'
	];
	paddleCustomControlsClass.forEach(elem => {
		addClassToLastItem(elem, 'paddle-last-item')
	})

	//addClassToLastItem('.customize-control-toggle_switch_2', 'paddle-last-item')

	// Builder preview
	let buttonPreviewHeader = document.querySelector('#accordion-section-paddle_theme_button_section');
	let buttonPreviewBack = document.querySelector('#sub-accordion-section-paddle_theme_button_section .customize-section-back')
	if(buttonPreviewHeader) {
		buttonPreviewHeader.addEventListener('click', () => {
			let parentContainer = document.querySelector('#sub-accordion-section-paddle_theme_button_section');
			let container = parentContainer.querySelector('.sample-container');
			let customizerPreviewContainer = document.getElementById('customize-preview');
			
			if(container) {
				setTimeout(() => {
					customizerPreviewContainer.style.bottom = container.clientHeight+'px';
					customizerPreviewContainer.style.height = 'auto';
					customizerPreviewContainer.style.marginBottom = '-1px';
				},200)
	
				setTimeout(() => {
					container.style.transform = 'translateY(0%)';
				},100)
			}
			
		})
	}

	if(buttonPreviewBack) {
		buttonPreviewBack.addEventListener('click', () => {
			let parentContainer = document.querySelector('#sub-accordion-section-paddle_theme_button_section');
			let container = parentContainer.querySelector('.sample-container');
			let customizerPreviewContainer = document.getElementById('customize-preview');

			if (container ) {
				customizerPreviewContainer.style.bottom = '0';
			
				setTimeout(() => {
					container.style.transform = 'translateY(100%)';
				},100)
			}
			
		})
	}

});

/**
 * Remove attached events from the Upsell Section to stop panel from being able to open/close
 */
( function( $, api ) {
	api.sectionConstructor['paddle-upsell'] = api.Section.extend( {

		// Remove events for this type of section.
		attachEvents: function () {},

		// Ensure this type of section is active. Normally, sections without contents aren't visible.
		isContextuallyActive: function () {
			return true;
		}
	} );
} )( jQuery, wp.customize );



