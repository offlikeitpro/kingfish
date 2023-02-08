InitTabsScroll = function(){
	$('.arrow_scroll:not(.arrow_scroll_init)').scrollTab();
}

ResizeScrollTabs = function() {
	var scrollTabs = $('.arrow_scroll_init');

	if(scrollTabs.length) {
		scrollTabs.each(function(i, scrollTab){
			var _scrollTab = $(scrollTab);
			_scrollTab.data('scrollTabOptions').resize();
		});
	}
}

$(document).ready(function(){
	InitTabsScroll();
});

$(window).on('resize', function(){
	if(window.scrollTabsTimeout !== undefined) {
		clearTimeout(window.scrollTabsTimeout);
	}
	
	window.scrollTabsTimeout = setTimeout(
		ResizeScrollTabs,
		20
	);
});

$.fn.scrollTab = function( options ){
	function _scrollTab(element) {
		element.each(function(i, scrollTab){
			var _scrollTab = $(scrollTab);
			var tabs_wrapper = _scrollTab.find('.nav-tabs');
			var tabs = tabs_wrapper.find('> li');

			$(arrows_wrapper).insertAfter(tabs_wrapper);
			var arrows = _scrollTab.find('.arrows_wrapper');
			var arrow_left = arrows.find('.arrow_left');
			var arrow_right = arrows.find('.arrow_right');

			options.scrollTab = scrollTab;
			options.wrapper = tabs_wrapper;
			options.tabs = tabs;
			options.arrows.wrapper = arrows;
			options.arrows.arrow_left = arrow_left;
			options.arrows.arrow_right = arrow_right;
			options.arrows.arrow_width = arrow_right[0].getBoundingClientRect().width;

			if(options.linked_tabs !== undefined && options.linked_tabs.length && options.linked_tabs.data('scrollTabOptions') !== undefined) {
				options.linked_options = options.linked_tabs.data('scrollTabOptions');
				options.linked_options.linked_options = options;
			}

			if(options.arrows.css) {
				options.arrows.arrow_left.css(options.arrows.css);
				options.arrows.arrow_right.css(options.arrows.css);
			}

			options.GetSummWidth = function(elements){
				elements = $(elements);
				var result = 0;
				if(elements.length) {
					elements.each(function(i, element){
						var _element = $(element);
						var elementWidth = element.getBoundingClientRect().width + 9;
						elementWidth = Math.ceil(elementWidth*10)/10;
						_element.data( 'leftBound',  result );
						result += elementWidth;
						_element.data( 'rightBound',  result );
					});
				}
				return result;
			}

			var tabs_width = options.GetSummWidth(options.tabs);
			options.tabs_width = tabs_width;
			options.minTranslate = options.width - options.tabs_width - 1;
			if(options.tabs_width) {
				options.wrapper.css({
					'width': options.tabs_width,
					'min-width': 'auto',
				});
			};

			options.checkArrows = function(translate){
				if(translate === undefined) {
					translate = options.translate;
				}

				if(translate >= options.maxTranslate) {
					options.arrows.arrow_left.addClass('disabled');
					options.arrows.arrow_right.removeClass('disabled');
				} else if(translate <= options.minTranslate) {
					options.arrows.arrow_right.addClass('disabled');
					options.arrows.arrow_left.removeClass('disabled');
				} else {
					options.arrows.arrow_left.removeClass('disabled');
					options.arrows.arrow_right.removeClass('disabled');
				}

			}

			options.directScroll = function(distance, delay){
				if(delay === undefined) {
					delay = 5;
				}
				clearInterval(options.timerMoveDirect);
				var newTranslate = options.translate + distance;

				if(newTranslate > options.maxTranslate) {
					newTranslate = options.maxTranslate;
				} else if(newTranslate < options.minTranslate) {
					newTranslate = options.minTranslate;
				}

				if(delay == 0) {
					options.translate = newTranslate;
					options.wrapper.css({
						'transform': 'translateX('+options.translate+'px)',
					});
				} else {
					options.timerMoveDirect = setInterval(
						function() {
							if( (distance < 0 && options.translate <= newTranslate) || (distance > 0 && options.translate >= newTranslate) ) {
								clearInterval(options.timerMoveDirect);
							}

							if(options.translate < newTranslate) {
								options.translate++;
							} else {
								options.translate--;
							}

							options.wrapper.css({
								'transform': 'translateX('+options.translate+'px)',
							});
						},
						delay
					);
				}

				options.checkArrows(newTranslate);
			};
			
			options.addArrowsEvents = function() {
				options.arrows.arrow_right.on('mouseenter', function() {
					options.arrows.arrow_left.removeClass('disabled');
					options.tabs_width = options.GetSummWidth(options.tabs);
					options.minTranslate = options.width - options.tabs_width;
					options.timerMoveLeft = setInterval(
						function() {
							if( options.translate < options.minTranslate ){
								clearInterval(options.timerMoveLeft);
								options.arrows.arrow_right.addClass('disabled');
							} else {
								options.translate -= options.translateSpeed;
								options.wrapper.css({
									'transform': 'translateX('+options.translate+'px)',
								});
							}
						},
						10
					);
				});

				options.arrows.arrow_right.on('mouseleave', function() {
					clearInterval(options.timerMoveLeft);
				});

				options.arrows.arrow_right.on('click', function() {
					options.directScroll(-options.directTranslate);
					options.arrows.arrow_left.removeClass('disabled');
				});

				options.arrows.arrow_right.on('touchend', function() {
					setTimeout(function() {
						clearInterval(options.timerMoveLeft);
					}, 1);
				});

				options.arrows.arrow_left.on('mouseenter', function() {
					options.tabs_width = options.GetSummWidth(options.tabs);
					options.minTranslate = options.width - options.tabs_width;
					options.arrows.arrow_right.removeClass('disabled');
					options.timerMoveRight = setInterval(
						function() {
							if(options.translate >= options.maxTranslate){
								clearInterval(options.timerMoveRight);
								options.arrows.arrow_left.addClass('disabled');
							} else {
								options.translate += options.translateSpeed;
								options.wrapper.css({
									'transform': 'translateX('+options.translate+'px)',
								});
							}
						},
						10
					);
				});

				options.arrows.arrow_left.on('mouseleave', function() {
					clearInterval(options.timerMoveRight);
				});

				options.arrows.arrow_left.on('click', function() {
					options.directScroll(options.directTranslate);
					options.arrows.arrow_right.removeClass('disabled');
				});

				options.arrows.arrow_left.on('touchend', function() {
					setTimeout(function() {
						clearInterval(options.timerMoveRight);
					}, 1);
				});
			};

			options.addTabsEvents = function() {
				options.tabs.on('click', function() {
					var leftScrollBound = options.scrollTab.getBoundingClientRect().left;
					var rightScrollBound = options.scrollTab.getBoundingClientRect().right;
					var tabBounds = this.getBoundingClientRect();

					if(tabBounds.left < leftScrollBound) {
						options.directScroll(leftScrollBound - tabBounds.left + options.arrows.arrow_width, 1);
					} else if(tabBounds.right > rightScrollBound) {
						options.directScroll(rightScrollBound - tabBounds.right - options.arrows.arrow_width, 1);
					}

					if(options.linked_options !== undefined) {
						var this_index = $(this).index();
						var linked_tab = $(options.linked_options.tabs[this_index]);
						var linked_tabs = {
							leftScrollBound: options.linked_options.scrollTab.getBoundingClientRect().left,
							rightScrollBound: options.linked_options.scrollTab.getBoundingClientRect().right,
							tabBounds: linked_tab[0].getBoundingClientRect(),
						};
						if(linked_tabs.tabBounds.left < linked_tabs.leftScrollBound) {
							options.linked_options.directScroll(linked_tabs.leftScrollBound - linked_tabs.tabBounds.left + options.linked_options.arrows.arrow_width + 1, 0);
						} else if(linked_tabs.tabBounds.right > linked_tabs.rightScrollBound) {
							options.linked_options.directScroll(linked_tabs.rightScrollBound - linked_tabs.tabBounds.right - options.linked_options.arrows.arrow_width - 1, 0);
						}
					}

					
				});
			};

			options.addWrapperEvents = function() {
				options.wrapper.on('touchstart', function(event) {
					options.touch.posPrev = event.originalEvent.changedTouches[0].pageX;
					clearInterval(options.timerMoveRight);
					clearInterval(options.timerMoveLeft);
					clearInterval(options.timerMoveDirect);
					options.tabs_width = options.GetSummWidth(options.tabs);
					options.minTranslate = options.width - options.tabs_width;
				});

				options.wrapper.on('touchmove', function(event) {
					options.touch.posCurrent = event.originalEvent.changedTouches[0].pageX - options.touch.posPrev;
					options.directScroll(options.touch.posCurrent, 0);
					options.touch.posPrev = event.originalEvent.changedTouches[0].pageX;
				});
			};

			options.resize = function(){
				options.width = scrollTab.getBoundingClientRect().width;
				options.tabs_width = options.GetSummWidth(options.tabs);
				options.minTranslate = options.width - options.tabs_width;


				if(options.translate < options.minTranslate) {
					options.directScroll(options.minTranslate - options.translate);
				} else if(options.translate > options.maxTranslate) {
					options.directScroll(options.maxTranslate - options.translate);
				}

				if(options.tabs_width < options.width) {
					options.arrows.wrapper.css('display', 'none');
				} else {
					options.arrows.wrapper.css('display', '');
					options.arrows.arrow_left.removeClass('disabled');
					options.arrows.arrow_right.removeClass('disabled');
					if(options.translate >= 0) {
						options.arrows.arrow_left.addClass('disabled');
					}
					if(options.translate <= options.minTranslate) {
						options.arrows.arrow_right.addClass('disabled');
					}
				}
			};


			options.addArrowsEvents();
			options.addTabsEvents();
			options.addWrapperEvents();
			_scrollTab.data('scrollTabOptions', options);
			_scrollTab.addClass('arrow_scroll_init').addClass('swipeignore');
			options.resize();
		});
	}

	var options = $.extend({
		translate: 0,
		translateSpeed: 2,
		directTranslate: 150,
		maxTranslate: 1,
		touch: {},
		arrows: {
			css: false,
		},
	}, options);

	var el = $(this);
	var arrow_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="6.969" viewBox="0 0 12 6.969">'+
							'<path class="cls-1" d="M361.691,401.707a1,1,0,0,1-1.414,0L356,397.416l-4.306,4.291a1,1,0,0,1-1.414,0,0.991,0.991,0,0,1,0-1.406l5.016-5a1.006,1.006,0,0,1,1.415,0l4.984,5A0.989,0.989,0,0,1,361.691,401.707Z" transform="translate(-350 -395.031)"/>'+
						'</svg>';
	var arrows_wrapper = '<div class="arrows_wrapper">'+
							'<div class="arrow arrow_left colored_theme_hover_text">'+arrow_svg+'</div>'+
							'<div class="arrow arrow_right colored_theme_hover_text">'+arrow_svg+'</div>'+
						'</div>';

	_scrollTab(el);
}