/*
(c) Copyrights 2011

Author David McReynolds
Daylight Studio
dave@thedaylightstudio.com
*/

;(function($){
	jQuery.fn.repeatable = function(o) {
		
		var _clones = {};
		
		var options = $.extend({
			addButtonText : 'Add Another',
			addButtonClass : 'add_another',
			removeButtonClass : 'remove',
			removeButtonText : 'Remove',
			repeatableSelector : '.repeatable',
			contentSelector : '.repeatable_content',
			warnBeforeDelete : true,
			warnBeforeDeleteMessage : 'Are you sure you want to delete this item?',
			addNewTitle : 'New',
			sortableSelector : '.grabber',
			sortable : true,
			initDisplay : false,
			dblClickBehavior : 'toggle', // options are false, toggle or accordian
			max : null,
			min : null,
			depth : 1,
			allowCollapsingContent : true
		}, o || {});

		var parseTemplate = function(elem, i){
			
			var $childTemplates = $(elem).find(options.repeatableSelector);
			var depth = $(elem).parent().attr('data-depth');
			var titleField = $(elem).parent().attr('data-title_field');
			var title = $(elem).find('input[name$="[' + titleField + ']"]').val();

			if (!depth) depth = 0;
			var depthSuffix = (depth > 0) ? '_' + depth : '';
			$('.num' + depthSuffix, elem).html((i + 1));
			$('.index' + depthSuffix, elem).html(i);
			$('.title' + depthSuffix, elem).html(title);
			
			var parseAttribute = function(elem, attr){
				var newId = $(elem).attr(attr);
				if (newId && newId.length){
					newId = newId.replace(/\{index\}/g, i);
					newId = newId.replace(/([-_a-zA-Z0-9]+_)\d+(_[-_a-zA-Z0-9]+)$/, '$1' + i + '$2');
					$(elem).attr(attr, newId);
				}
			}
			
			$('label,.field_depth_' + depth, elem).each(function(j){
				var newName = $(this).attr('name')
				if (newName && newName.length){
					newName = newName.replace(/([-_a-zA-Z0-9\[\]]+)\[\d+\](\[[-_a-zA-Z0-9]+\])$/, '$1[' + i + ']$2');
					
					// required for jquery 
					newName = newName.replace('[', '\[');
					newName = newName.replace(']', '\]');
					
					$(this).attr('name', newName)
				}
				
				if ($(this).is('label')){
					parseAttribute(this, 'for');
				} else {
					parseAttribute(this, 'id');
					$(this).attr('data-index', i);
				}
			})
			
			
			
			var $parentElem = $(elem).has(options.repeatableSelector + ' ' + options.repeatableSelector);

			var parentIndex = null;
			if ($parentElem.length > 0){
				parentIndex = $parentElem.attr('data-index');
			}

			// if children, then we need to reorganize them too
			if (depth == 0 && $childTemplates.length){
				var $childRepeatables = $(elem).find(options.repeatableSelector);
				$childRepeatables.find('input,textarea,select').each(function(i){
					var newName = $(this).attr('name')
					if (newName && newName.length && parentIndex != null){
						newName = newName.replace(/([-_a-zA-Z0-9]+\[)\d+(\]\[[-_a-zA-Z0-9]+\]\[\d+\])/g, '$1' + parentIndex + '$2');
						// required for jquery 
						newName = newName.replace('[', '\[');
						newName = newName.replace(']', '\]');
						$(this).attr('name', newName);
					}
					
				})
			}
		}
		
		var createRemoveButton = function(elem){
			if ($(elem).children('.' + options.removeButtonClass).length == 0){
				$(elem).append('<a href="#" class="' + options.removeButtonClass +'">' + options.removeButtonText +' </a>');
			}
			
			//$(options.repeatableSelector).on('click', ' .' + options.removeButtonClass, function(e){
			$(options.repeatableSelector +' .' + options.removeButtonClass).live('click',  function(e){
				var $this = $(this).closest(options.repeatableSelector).parent();
				var max = ($this.attr('data-max')) ? parseInt($this.attr('data-max')) : null;
				var min = ($this.attr('data-min')) ? parseInt($this.attr('data-min')) : null;
				if (options.warnBeforeDelete == false || confirm(options.warnBeforeDeleteMessage)){
					$(this).parent().remove();
					
					var $children = $this.children(options.repeatableSelector);
					if ($children.length < max){
						$this.next().show();
					}
					// to reorder the indexes
					reOrder($this);
				}
				
				checkMin($this, min);
				
				$this.trigger('removed');
				e.stopImmediatePropagation();
				return false;
			});
		}
		
		var reOrder = function($elem){
			$elem.children(options.repeatableSelector).each(function(i){
				$(this).attr('data-index', i);
				parseTemplate(this, i);
			});
		}
		
		var checkMax = function($elem, max){
			if (max && $elem.children(options.repeatableSelector).length != 0 && $elem.children(options.repeatableSelector).length >= max){
				$elem.next().hide();
			} else {
				$elem.next().show();
			}
		}

		var checkMin = function($elem, min){
			$children = $elem.children(options.repeatableSelector);
			
			// must grab first in case they are nested
			min = parseInt(min);
			if (min && $children.length != 0 && $children.length <= min){
				$children.find('.' + options.removeButtonClass + ':first').hide();
			} else {
				$children.find('.' + options.removeButtonClass + ':first').show();
			}
		}
		
		var cloneRepeatableNode = function($elem){
			$clone = $elem.children(options.repeatableSelector + ':first').clone(false);
			return $clone;
		}
		
		var createCollapsingContent = function($elem){
			if (options.allowCollapsingContent){
		
				$($elem).find(options.sortableSelector).unbind('dblclick').dblclick(function(e){
					$parent = $(this).closest(options.repeatableSelector).parent();

					var dblclick = ($parent.attr('data-dblclick')) ? $parent.attr('data-dblclick') : null;
					if (dblclick == 'accordian'){
						$parent.find(options.contentSelector).hide();
						$(this).closest(options.repeatableSelector).find(options.contentSelector + ':first').show();
					} else {
						$(this).closest(options.repeatableSelector).find(options.contentSelector + ':first').toggle();
					}
				})
			}
		}
		
		var createAddButton = function($elem){
			
			// clone a fresh copy and store it to be cloned later
			$('.' + options.addButtonClass).each(function(i){
				var $prev = $(this).prev();
				var $clone = cloneRepeatableNode($prev);
				$(this).data('clone', $clone);
			});
			
			$('.' + options.addButtonClass).live('click', function(e){

				var $prev = $(this).prev();
				var max = ($prev.attr('data-max')) ? parseInt($prev.attr('data-max')) : null;
				var min = ($prev.attr('data-min')) ? parseInt($prev.attr('data-min')) : null;
				var dblclick = ($prev.attr('data-dblclick')) ? $prev.attr('data-dblclick') : null;

				if (!$(e.currentTarget).data('clone')){
					var $clone = cloneRepeatableNode($prev);
					$(e.currentTarget).data('clone', $clone);
				} else {
					var $clone = $(e.currentTarget).data('clone');
				}
				
				var $this = $(this).prev();
				var $clonecopy = $clone.clone(false);

				// add the noclone class so that it gets removed if nested
				$clonecopy.addClass('noclone');
				
				
				$clonecopy.find(options.contentSelector + ':first').show();
				if (dblclick == 'accordian'){
					$prev.find(options.contentSelector).hide();
				}
				
				createCollapsingContent($clonecopy);
				
				var $children = $this.children(options.repeatableSelector);

				if (max && $children.length >= max){
					return false;
				}

				var index = $children.length;
				parseTemplate($clonecopy, index);

				createRemoveButton($clonecopy);
				$this.append($clonecopy);

				// remove values from any form fields
				$clonecopy.find('input,select,textarea').not('input[type="radio"], input[type="checkbox"], input[type="button"]').val('');
				$clonecopy.find('.noclone').remove();
				
				$this.trigger({type: 'cloned', clonedNode: $clonecopy});
				
				reOrder($this);

				if (max && $children.length != 0 && $children.length >= (max -1)){
					$(this).hide();
				}
				checkMin($prev, min);
				
				e.stopImmediatePropagation();
				return false;
			});
			
		}
		
		
		
		var index = 0;
		
		return this.each(function(){
			var $this = $(this);
			
			// simply return if it's already been instantiated
			if ($this.hasClass('__applied__')) return this;
			
			// set this class so we can detect whether it's been cloned yet or not
			$this.addClass('__applied__');

			// parse the template
			var $repeatables = $this.children(options.repeatableSelector);
			$repeatables.each(function(i){
				parseTemplate(this, i);
				createRemoveButton(this);
			});
				
			// add button
			$parent = $this.parent();
			
			// add max limit attribute to reference later
			if (options.max){
				$this.attr('data-max', options.max); // set it if it's not already
			}

			if (options.min){
				$this.attr('data-min', options.min); // set it if it's not already
			}
			
			if (options.dblClickBehavior){
				$this.attr('data-dblclick', options.dblClickBehavior);
			}

			if (options.initDisplay){
				$this.attr('data-init_display', options.init_display);
				
				// hide all but the first
				if (options.initDisplay == 'first'){
					$repeatables.find('.repeatable_content').not(':first').hide();
				} else if (options.initDisplay == 'none' || options.initDisplay == 'closed'){
					$repeatables.find('.repeatable_content').hide();
				}
			}
			
			if ($parent.find(options.addButtonClass).length == 0){
				$parent.append('<a href="#" class="' + options.addButtonClass + '">' + options.addButtonText +' </a>');
			}
			// add sorting
			if (options.sortable){
				$this.sortable({
					cursor: 'move', 
					handle: options.sortableSelector,
					start: function(event, ui) {
						$this.trigger({type: 'sortStarted', clonedNode: $this});
					},
					stop: function(event, ui) {
						reOrder($(this));
						$this.trigger({type: 'sortStopped', clonedNode: $this});
					}
				});
			}
			
			createAddButton($this);

			if ($this.attr('data-max')) checkMax($this, options.max);
			if ($this.attr('data-min')) checkMin($this, options.min);

			createCollapsingContent($this);
			
			index++;
			return this;
		});
	};
})(jQuery);
