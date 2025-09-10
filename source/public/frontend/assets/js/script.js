(function($) {

	"use strict";

	//Hide Loading Box (Preloader)
	function handlePreloader() {
		if($('.loader-wrap').length){
			$('.loader-wrap').delay(1000).fadeOut(500);
		}
	}

	if ($(".preloader-close").length) {
        $(".preloader-close").on("click", function(){
            $('.loader-wrap').delay(200).fadeOut(500);
        })
    }

    if ($(".switch_btn_one").length) {
	    $(".search__toggler").on("click", function(){
	    	$(".search-field .switch_btn_one").addClass("active");
	    })
	    $(".switch_btn_one .close-btn").on("click", function(){
	    	$(".search-field .switch_btn_one").removeClass("active");
	    })
    }

	//Update Header Style and Scroll to Top
	function headerStyle() {
		if($('.main-header').length){
			var windowpos = $(window).scrollTop();
			var siteHeader = $('.main-header');
			var scrollLink = $('.scroll-top');
			if (windowpos >= 110) {
				siteHeader.addClass('fixed-header');
				scrollLink.addClass('open');
			} else {
				siteHeader.removeClass('fixed-header');
				scrollLink.removeClass('open');
			}
		}
	}

	headerStyle();


	//Submenu Dropdown Toggle
	if($('.main-header li.dropdown ul').length){
		$('.main-header .navigation li.dropdown').append('<div class="dropdown-btn"><span class="fas fa-angle-down"></span></div>');

	}

	//Mobile Nav Hide Show
	if($('.mobile-menu').length){

		$('.mobile-menu .menu-box').mCustomScrollbar();

		var mobileMenuContent = $('.main-header .menu-area .main-menu').html();
		$('.mobile-menu .menu-box .menu-outer').append(mobileMenuContent);
		$('.sticky-header .main-menu').append(mobileMenuContent);

		//Dropdown Button
		$('.mobile-menu li.dropdown .dropdown-btn').on('click', function() {
			$(this).toggleClass('open');
			$(this).prev('ul').slideToggle(500);
		});
		//Dropdown Button
		$('.mobile-menu li.dropdown .dropdown-btn').on('click', function() {
			$(this).prev('.megamenu').slideToggle(900);
		});
		//Menu Toggle Btn
		$('.mobile-nav-toggler').on('click', function() {
			$('body').addClass('mobile-menu-visible');
		});

		//Menu Toggle Btn
		$('.mobile-menu .menu-backdrop,.mobile-menu .close-btn').on('click', function() {
			$('body').removeClass('mobile-menu-visible');
		});
	}


	// Scroll to a Specific Div
	if($('.scroll-to-target').length){
		$(".scroll-to-target").on('click', function() {
			var target = $(this).attr('data-target');
		   // animate
		   $('html, body').animate({
			   scrollTop: $(target).offset().top
			 }, 1000);

		});
	}

	// Elements Animation
	if($('.wow').length){
		var wow = new WOW({
		mobile:       false
		});
		wow.init();
	}


	 // Contact form validation
     if ($('#contact-form').length) {
            $('#contact-form').validate({
                rules: {
                    username: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        required: true,
                        number: true,
                        maxlength: 10,
                        minlength: 10,
                    },
                    subject: {
                        required: true,
                        maxlength: 100, // Set maximum length to 100 characters for subject
                    },
                    message: {
                        required: true,
                        maxlength: 500, // Set maximum length to 500 characters for message
                    },
                },
                messages: {
                    username: {
                        required: "Please enter your name.",
                    },
                    email: {
                        required: "Please enter your email address.",
                        email: "Please enter a valid email address.",
                    },
                    phone: {
                        required: "Please enter your 10-digit phone number.",
                        number: "Please enter a valid numeric value for the phone number.",
                        maxlength: "Phone number must be exactly 10 digits.",
                        minlength: "Phone number must be exactly 10 digits."
                    },
                    subject: {
                        required: "Please enter a subject.",
                        maxlength: "Subject cannot exceed 100 characters.",
                    },
                    message: {
                        required: "Please enter a message.",
                        maxlength: "Message cannot exceed 500 characters.",
                    },
                },
                errorPlacement: function (error, element) {
                    // Customize error message placement if needed
                    error.insertAfter(element);
                },
                submitHandler: function (form) {
                    // Disable the submit button to prevent multiple submissions
                    $(form).find('button[type="submit"]').prop('disabled', true);

                    // Proceed with the form submission
                    form.submit();
                }
            });
        }

        // user_profile form validation
     if ($('#user_profile').length) {
        $('#user_profile').validate({
            rules: {
                username: {
                    required: true,
                },
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                phone: {
                    required: true,
                    number: true,
                    maxlength: 10,
                    minlength: 10,
                },

                address: {
                    maxlength: 500,
                },

            },
            messages: {
                username: {
                    required: "Please enter your user name.",
                },
                name: {
                    required: "Please enter your name.",
                },
                email: {
                    required: "Please enter your email address.",
                    email: "Please enter a valid email address.",
                },
                phone: {

                    required: "Please enter your 10-digit phone number.",
                    number: "Please enter a valid numeric value for the phone number.",
                    maxlength: "Phone number must be exactly 10 digits.",
                    minlength: "Phone number must be exactly 10 digits."
                },

                address: {

                    maxlength: "Address cannot exceed 500 characters.",
                },

            },
            errorPlacement: function (error, element) {
                // Customize error message placement if needed
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                // Disable the submit button to prevent multiple submissions
                $(form).find('button[type="submit"]').prop('disabled', true);

                // Proceed with the form submission
                form.submit();
            }
        });
    }

	// Agent-message form validation
    if ($('#agent-message').length) {
        $('#agent-message').validate({
            rules: {
                msg_name: {
                    required: true,
                },
                msg_email: {
                    required: true,
                    email: true,
                },
                msg_phone: {
                    required: true,
                    number: true,
                    maxlength: 10,
                    minlength: 10,
                },
                message: {
                    required: true,
                },
            },
            messages: {
                msg_name: {
                    required: "Please enter your name.",
                },
                msg_email: {
                    required: "Please enter your email address.",
                    email: "Please enter a valid email address.",
                },
                msg_phone: {

                    required: "Please enter your 10-digit phone number.",
                    number: "Please enter a valid numeric value for the phone number.",
                    maxlength: "Phone number must be exactly 10 digits.",
                    minlength: "Phone number must be exactly 10 digits."
                },
                message: {
                    required: "Please enter a message.",
                },
            },
            errorPlacement: function (error, element) {
                // Customize error message placement if needed
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                // Disable the submit button to prevent multiple submissions
                $(form).find('button[type="submit"]').prop('disabled', true);

                // Proceed with the form submission
                form.submit();
            }
        });
    }

	// Schedule-tour form validation
    if ($('#schedule-tour').length) {
        $('#schedule-tour').validate({
            rules: {
                tour_date: {
                    required: true,
                    date: true
                },
                time: {
                    required: true,
                },
                message: {
                    required: true,
                },
            },
            messages: {
                tour_date: {
                    required: "Please select a tour date.",
                    date: "Please enter a valid date.",
                },
                time: {
                    required: "Please enter the tour time.",
                },
                message: {
                    required: "Please enter a message.",
                },
            },
            errorPlacement: function (error, element) {
                // Customize error message placement if needed
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                // Disable the submit button to prevent multiple submissions
                $(form).find('button[type="submit"]').prop('disabled', true);

                // Proceed with the form submission
                form.submit();
            }
        });
    }

	// Password change form validation
    if ($('#change_password').length) {
        $('#change_password').validate({
            rules: {
                old_password: {
                    required: true,
                },
                new_password: {
                    required: true,
                    minlength: 8, // Minimum length of 8 characters
                    trim: true,
                },
                new_password_confirmation: {
                    required: true,
                    equalTo: "#new_password", // Ensure new password confirmation matches new password
                },
            },
            messages: {
                old_password: {
                    required: "Please enter your old password.",
                },
                new_password: {
                    required: "Please enter a new password.",
                    minlength: "Password must be at least 8 characters long.",
                },
                new_password_confirmation: {
                    required: "Please confirm your new password.",
                    equalTo: "Passwords do not match.",
                },
            },
            errorPlacement: function (error, element) {
                // Customize error message placement if needed
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                // Disable the submit button to prevent multiple submissions
                $(form).find('button[type="submit"]').prop('disabled', true);

                // Proceed with the form submission
                form.submit();
            }
        });
    }

    // signin form validation
    if ($('#signin').length) {
        $('#signin').validate({
            rules: {

                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    trim: true,
                },

            },
            messages: {

                email: {
                    required: "Please enter your email address.",
                    email: "Please enter a valid email address.",
                },
                password: {
                    required: "Please enter a password.",

                },

            },
            errorPlacement: function (error, element) {
                // Customize error message placement if needed
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                // Disable the submit button to prevent multiple submissions
                $(form).find('button[type="submit"]').prop('disabled', true);

                // Proceed with the form submission
                form.submit();
            }
        });
    }

   // User registration form validation

    function initializeValidation(formId) {
            $(formId).validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 8, // Minimum length of 8 characters
                        trim: true,
                    },
                    password_confirmation: {
                        required: true,
                        trim: true,
                        equalTo: "#password", // Ensure password confirmation matches password
                    },
                },
                messages: {
                    name: {
                        required: "Please enter your name.",
                    },
                    email: {
                        required: "Please enter your email address.",
                        email: "Please enter a valid email address.",
                    },
                    password: {
                        required: "Please enter a password.",
                        minlength: "Password must be at least 8 characters long.",
                    },
                    password_confirmation: {
                        required: "Please confirm your password.",
                        equalTo: "Passwords do not match.",
                    },
                },
                errorPlacement: function (error, element) {
                    // Customize error message placement if needed
                    error.insertAfter(element);
                },
                submitHandler: function (form) {
                    // Disable the submit button to prevent multiple submissions
                    $(form).find('button[type="submit"]').prop('disabled', true);

                    // Proceed with the form submission
                    form.submit();
                }
            });
        }

        // User registration form validation
        if ($('#user_register').length) {
            initializeValidation('#user_register');
        }

        // Agent registration form validation
        if ($('#agent_register').length) {
            initializeValidation('#agent_register');
        }



	//Fact Counter + Text Count
	if($('.count-box').length){
		$('.count-box').appear(function(){

			var $t = $(this),
				n = $t.find(".count-text").attr("data-stop"),
				r = parseInt($t.find(".count-text").attr("data-speed"), 10);

			if (!$t.hasClass("counted")) {
				$t.addClass("counted");
				$({
					countNum: $t.find(".count-text").text()
				}).animate({
					countNum: n
				}, {
					duration: r,
					easing: "linear",
					step: function() {
						$t.find(".count-text").text(Math.floor(this.countNum));
					},
					complete: function() {
						$t.find(".count-text").text(this.countNum);
					}
				});
			}

		},{accY: 0});
	}


	//LightBox / Fancybox
	if($('.lightbox-image').length) {
		$('.lightbox-image').fancybox({
			openEffect  : 'fade',
			closeEffect : 'fade',
			helpers : {
				media : {}
			}
		});
	}


	//Tabs Box
	if($('.tabs-box').length){
		$('.tabs-box .tab-buttons .tab-btn').on('click', function(e) {
			e.preventDefault();
			var target = $($(this).attr('data-tab'));

			if ($(target).is(':visible')){
				return false;
			}else{
				target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
				$(this).addClass('active-btn');
				target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
				target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab');
				$(target).fadeIn(300);
				$(target).addClass('active-tab');
			}
		});
	}



	//Accordion Box
	if($('.accordion-box').length){
		$(".accordion-box").on('click', '.acc-btn', function() {

			var outerBox = $(this).parents('.accordion-box');
			var target = $(this).parents('.accordion');

			if($(this).hasClass('active')!==true){
				$(outerBox).find('.accordion .acc-btn').removeClass('active');
			}

			if ($(this).next('.acc-content').is(':visible')){
				return false;
			}else{
				$(this).addClass('active');
				$(outerBox).children('.accordion').removeClass('active-block');
				$(outerBox).find('.accordion').children('.acc-content').slideUp(300);
				target.addClass('active-block');
				$(this).next('.acc-content').slideDown(300);
			}
		});
	}


    //two-column-carousel
	if ($('.two-column-carousel').length) {
		$('.two-column-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			smartSpeed: 1000,
			autoplay: 500,
			navText: [ '<span class="fas fa-algle-left"></span>', '<span class="fas fa-algle-left-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:2
				},
				1024:{
					items:2
				}
			}
		});
	}


    //three-item-carousel
	if ($('.three-item-carousel').length) {
		$('.three-item-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			smartSpeed: 1000,
			autoplay: 500,
			navText: [ '<span class="far fa-angle-left"></span>', '<span class="far fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:2
				},
				800:{
					items:2
				},
				1024:{
					items:3
				}
			}
		});
	}


	// Five Item Carousel
	if ($('.five-item-carousel').length) {
		$('.five-item-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			smartSpeed: 500,
			autoplay: 5000,
			navText: [ '<span class="fas fa-angle-left"></span>', '<span class="fas fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:2
				},
				800:{
					items:3
				},
				1024:{
					items:4
				},
				1200:{
					items:5
				}
			}
		});
	}

	// Four Item Carousel
	if ($('.four-item-carousel').length) {
		$('.four-item-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			smartSpeed: 500,
			autoplay: 5000,
			navText: [ '<span class="fas fa-angle-left"></span>', '<span class="fas fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:2
				},
				800:{
					items:3
				},
				1024:{
					items:4
				},
				1200:{
					items:4
				}
			}
		});
	}


	// single-item-carousel
	if ($('.single-item-carousel').length) {
		$('.single-item-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:false,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="far fa-angle-left"></span>', '<span class="far fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},
				1200:{
					items:1
				}

			}
		});
	}




	// deals Carousel
	if ($('.deals-carousel').length) {
		$('.deals-carousel').owlCarousel({
			loop:true,
			margin:50,
			nav:true,
			smartSpeed: 500,
			autoplay: 5000,
			navText: [ '<span class="far fa-angle-left"></span>', '<span class="far fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},
				1024:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});
	}


	// banner-carousel
	if ($('.banner-carousel').length) {
        $('.banner-carousel').owlCarousel({
            loop:true,
			margin:0,
			nav:true,
			animateOut: 'fadeOut',
    		animateIn: 'fadeIn',
    		active: true,
			smartSpeed: 1000,
			autoplay: 6000,
            navText: [ '<span class="far fa-angle-left"></span>', '<span class="far fa-angle-right"></span>' ],
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                800:{
                    items:1
                },
                1024:{
                    items:1
                }
            }
        });
    }


	//Add One Page nav
	if($('.scroll-nav').length) {
		$('.scroll-nav').onePageNav();
	}

	//Sortable Masonary with Filters
	function enableMasonry() {
		if($('.sortable-masonry').length){

			var winDow = $(window);
			// Needed variables
			var $container=$('.sortable-masonry .items-container');
			var $filter=$('.filter-btns');

			$container.isotope({
				filter:'*',
				 masonry: {
					columnWidth : '.masonry-item.small-column'
				 },
				animationOptions:{
					duration:500,
					easing:'linear'
				}
			});


			// Isotope Filter
			$filter.find('li').on('click', function(){
				var selector = $(this).attr('data-filter');

				try {
					$container.isotope({
						filter	: selector,
						animationOptions: {
							duration: 500,
							easing	: 'linear',
							queue	: false
						}
					});
				} catch(err) {

				}
				return false;
			});


			winDow.on('resize', function(){
				var selector = $filter.find('li.active').attr('data-filter');

				$container.isotope({
					filter	: selector,
					animationOptions: {
						duration: 500,
						easing	: 'linear',
						queue	: false
					}
				});
			});


			var filterItemA	= $('.filter-btns li');

			filterItemA.on('click', function(){
				var $this = $(this);
				if ( !$this.hasClass('active')) {
					filterItemA.removeClass('active');
					$this.addClass('active');
				}
			});
		}
	}

	enableMasonry();


	// Area Range Slider
    if ($('.area-range-slider').length) {
        // Initialize the slider
        $(".area-range-slider").slider({
            range: true, // Enable range selection
            min: 0, // Minimum value for the slider
            max: 10000, // Maximum value for the slider (adjust as needed)
            values: [100, 200], // Initial values for the slider handles
            slide: function (event, ui) {
                // Update the visible input field with the selected range
                $("input.area-range").val(ui.values[0] + " - " + ui.values[1] + " sq ft");

                // Update hidden input fields with selected values
                $("#min-area").val(ui.values[0]); // Update the minimum area
                $("#max-area").val(ui.values[1]); // Update the maximum area
            }
        });

        // Set the initial value for the visible input field
        $("input.area-range").val($(".area-range-slider").slider("values", 0) + " - " + $(".area-range-slider").slider("values", 1) + " sq ft");
    }



    // Progress Bar
	if ($('.count-bar').length) {
		$('.count-bar').appear(function(){
			var el = $(this);
			var percent = el.data('percent');
			$(el).css('width',percent).addClass('counted');
		},{accY: -50});

	}


	$(document).ready(function() {
      $('select:not(.ignore)').niceSelect();
    });


    // color switcher
	function swithcerMenu() {
	  	if ($('.switch_menu').length) {

	    	$('.switch_btn button').on('click', function(){
	      	$('.switch_menu').toggle(500)
	    	});

	    	$('#styleOptions').styleSwitcher({
	        hasPreview: true,
	        fullPath: 'assets/css/color/',
	         	cookie: {
	          	expires: 30,
	          	isManagingLoad: true
	      		}
	    	});

	  	};
	}


	// page direction
	function directionswitch() {
	  	if ($('.page_direction').length) {

	    	$('.direction_switch button').on('click', function() {
			   $('body').toggleClass(function(){
			      return $(this).is('.rtl, .ltr') ? 'rtl ltr' : 'rtl';
			  })
			});
	  	};
	}


	if($('.paroller').length){
		$('.paroller').paroller({
			  factor: 0.1,            // multiplier for scrolling speed and offset, +- values for direction control
			  factorLg: 0.1,          // multiplier for scrolling speed and offset if window width is less than 1200px, +- values for direction control
			  type: 'foreground',     // background, foreground
			  direction: 'vertical' // vertical, horizontal
		});
	}

	if($('.paroller-2').length){
		$('.paroller-2').paroller({
			  factor: -0.1,            // multiplier for scrolling speed and offset, +- values for direction control
			  factorLg: -0.1,          // multiplier for scrolling speed and offset if window width is less than 1200px, +- values for direction control
			  type: 'foreground',     // background, foreground
			  direction: 'vertical' // vertical, horizontal
		});
	}

	// Date picker
	function datepicker () {
	    if ($('#datepicker').length) {
	        $('#datepicker').datepicker();
	    };
	}



	// Time picker
	function timepicker () {
	    if ($('input[name="time"]').length) {
	        $('input[name="time"]').ptTimeSelect();
	    }
	}


	if ($('.property-details .bxslider').length) {
		$('.property-details .bxslider').bxSlider({
			auto:true,
	        nextSelector: '.property-details #slider-next',
	        prevSelector: '.property-details #slider-prev',
	        nextText: '<i class="fa fa-angle-right"></i>',
	        prevText: '<i class="fa fa-angle-left"></i>',
	        mode: 'fade',
	        auto: 'true',
	        speed: '700',
	        pagerCustom: '.property-details .slider-pager .thumb-box'
	    });
	};


	/*	=========================================================================
	When document is Scrollig, do
	========================================================================== */

	jQuery(document).on('ready', function () {
		(function ($) {
			// add your functions
			directionswitch();
			swithcerMenu();
			datepicker ();
			timepicker ();
		})(jQuery);
	});



	/* ==========================================================================
   When document is Scrollig, do
   ========================================================================== */

	$(window).on('scroll', function() {
		headerStyle();
	});



	/* ==========================================================================
   When document is loaded, do
   ========================================================================== */

	$(window).on('load', function() {
		handlePreloader();
		enableMasonry();
	});



})(window.jQuery);
