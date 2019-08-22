/**********************************************************************************
**
**		jQuery Tristate Checkbox Plugin
**		version: 1.0
**
**		Dual licensed under the MIT and GPL licenses:
**   		http://www.opensource.org/licenses/mit-license.php
**   		http://www.gnu.org/licenses/gpl.html
**
**		author: Ben Belcourt
**		creation date: 04.11.2010
**		dependencies: "jquery-1.3.2.js" or higher
**
**		This file contains the functionality for implementing 3 state checkboxes.
**
**********************************************************************************/

(function ($){
	$.fn.tristate = function(options) {  
	
		var config = {
			checkedClass: 'checked',
			fullClass: 'full',
			heading: 'span.label',
			partialClass: 'partial',
			showOriginalInputs: false
		};
		var opts = $.extend(config,options);
		
		return this.each(function() {  
			obj = $(this);

			var triState = {
				init: function () {
					// Add proxy checkbox for each heading
					obj.find(opts.heading).before('<a href="#" class="checkbox">Heading</a>').wrap('<label></label>');
					
					var $inputs = obj.find('input[type="checkbox"]');
					for (var i=0, y=$inputs.length; i<y; i++) {
						// hide the input fields
						triState.hideInput($($inputs[i]));
					}
					
					// Initialize proxy links
					triState.updateProxyStates();
					
					// Set click behavior on appropriate input fields
					obj.find('a.checkbox, label').bind('click', function (e) {
						e.preventDefault();
						triState.initProxyClick($(this));
					});
				},
				
				checkSiblings: function ($el, bChecked) {
					var $siblings = $el.parent('li').siblings().children('a.checkbox');
					var iCheckCount = 0;
					var $parentList = $el.parent('li').parent('ul');
					var $descendantLists = $parentList.find('ul');
					var sResult;
					
					if (bChecked) { iCheckCount++; }
					
					// Loop through the list of siblings to see if any are checked
					for (var i=0; i<$siblings.length; i++) {
						if ($($siblings[i]).hasClass(opts.checkedClass) || $($siblings[i]).hasClass(opts.partialClass)) { iCheckCount++; }
					}
					
					// Depending on how many siblings are checked set the appropriate result string
					(iCheckCount < $siblings.length+1) ? sResult = opts.partialClass : sResult = opts.fullClass;
					for (var x=0; x<$descendantLists.length; x++) {
						if ($($descendantLists[x]).hasClass(opts.partialClass)) { sResult = opts.partialClass; }
					}
					if (iCheckCount === 0) { sResult = ''; }
					
					// Set the appropriate class to the parent list
					$parentList.removeClass(opts.partialClass + ' ' + opts.fullClass).addClass(sResult);
				},
				
				initProxyClick: function ($el) {
					var bChecked;
					triState.setInputField($el);
					
					// Initialize the input field
					($($el).hasClass(opts.checkedClass) === true || $($el).hasClass(opts.partialClass) === true) ? bChecked = true : bChecked = false ;
											
					// Check for 'checked' siblings
					triState.checkSiblings($el, bChecked);
					
					// Check/uncheck this elements associated label
					triState.setLabel($el, bChecked);
					
					// Check/uncheck this elements descendants appropriately
					triState.setDescendants($el, bChecked);
					
					// Check/uncheck this element's ancestors appropriately
					triState.setAncestors($el, bChecked);
					
					triState.updateProxyStates();
				},
				
				updateProxyStates: function () {
					var $inputs = $('input:checked', obj);
					var $proxyLink;
					for (var i=0, y=$inputs.length; i<y; i++) {
						$proxyLink = $($inputs[i]).siblings('a.checkbox');
						triState.setInputField($proxyLink, 'checked');
						triState.checkSiblings($($inputs[i]), true);
						triState.setAncestors($($inputs[i]), true);
					}
				},
				
				hideInput: function ($el) {
					var sName = $el.attr('name');
					var $newCheckbox = $('<a href="#" class="checkbox">'+sName+'</a>');
					$newCheckbox.data("name", sName);
					$el.before($newCheckbox);
					if (!opts.showOriginalInputs) { $el.hide(); }
				},
				
				setAncestors: function ($el, bChecked) {
					var bAncestorCheck;
					var $parentList = $el.parent('li').parent('ul');
					var $ancestorInput = $parentList.parent('li').children('a.checkbox');
					
					// Check the class on the parentList and check the ancestorInput appropriately
					if (!$parentList.hasClass(opts.partialClass) && !$parentList.hasClass(opts.fullClass)) {
						$ancestorInput.removeClass(opts.checkedClass +' '+ opts.partialClass);
						triState.setInputField($ancestorInput, 'unchecked');
						triState.setLabel($ancestorInput, bChecked);
						bAncestorCheck = false;
					} else {
						triState.setInputField($ancestorInput, 'checked');
						triState.setLabel($ancestorInput, bChecked);
						if ($parentList.hasClass(opts.partialClass)) { $ancestorInput.removeClass(opts.checkedClass).addClass(opts.partialClass); }
						if ($parentList.hasClass(opts.fullClass)) { $ancestorInput.removeClass(opts.partialClass).addClass(opts.checkedClass); }
						bAncestorCheck = true;
					}
					
					// As long as we're not at the root element then keep traversing up the chain to check each input appropriately
					if ($ancestorInput.length > 0) {
						triState.checkSiblings($ancestorInput, bAncestorCheck);
						triState.setAncestors($ancestorInput, $ancestorInput.hasClass(opts.checkedClass));
					}
				},
				
				setDescendants: function ($el, bChecked) {
					var $parentItem = $el.parent('li');
					var $descendantList = $parentItem.find('ul');
					var $descendantInputs = $parentItem.find('a.checkbox');
					
					if (bChecked) {
						for (var i=0, j=$descendantInputs.length; i<j; i++) {
							triState.setInputField($($descendantInputs[i]), 'checked');
							triState.setLabel($($descendantInputs[i]), bChecked);
						}
						$descendantList.removeClass(opts.partialClass + ' ' + opts.fullClass).addClass(opts.fullClass);
					} else {
						for (var g=0, y=$descendantInputs.length; g<y; g++) {
							triState.setInputField($($descendantInputs[g]), 'unchecked');
							triState.setLabel($($descendantInputs[g]), bChecked);
						}
						$descendantList.removeClass(opts.partialClass + ' ' + opts.fullClass);
					}
				},
				
				setInputField: function ($el, state) {
					var sState = state || '';
					switch (sState) {
						case '':
							($el.hasClass(opts.checkedClass) === true) ? triState.uncheckInput($el) : triState.checkInput($el);
							break;
						case 'checked':
							triState.checkInput($el);
							break;
						case 'unchecked':
							triState.uncheckInput($el);
							break;
					}
				},
				
				setLabel: function ($el, state) {
					$label = $el.siblings('label');
					(state) ? triState.checkLabel($label) : triState.uncheckLabel($label);
				},
				
				checkInput: function ($el) {
					$el.removeClass(opts.partialClass).addClass(opts.checkedClass).siblings('input[name="'+$el.data('name')+'"]').attr('checked', 'checked');
				},
				
				uncheckInput: function ($el) {
					$el.removeClass(opts.checkedClass +' '+ opts.partialClass).siblings('input[name="'+$el.data('name')+'"]').attr('checked', '');
				},
				
				checkLabel: function ($el) {
					$el.removeClass(opts.partialClass).addClass(opts.checkedClass);
				},
				
				uncheckLabel: function ($el) {
					$el.removeClass(opts.checkedClass +' '+ opts.partialClass);
				}
			};
			
			triState.init();			

		});  
	};
})(jQuery);