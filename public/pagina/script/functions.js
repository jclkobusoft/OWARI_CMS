
jQuery(document).ready(function($) {

	'use strict';
    //***************************
    // Sticky Header Function
    //***************************
	  jQuery(window).scroll(function() {
	      if (jQuery(this).scrollTop() > 170){  
	          jQuery('body').addClass("automechanic-sticky");
	      }
	      else{
	          jQuery('body').removeClass("automechanic-sticky");
	      }
	  });
    
    //***************************
    // BannerOne Functions
    //***************************
      jQuery('.automechanic-banner').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 2000,
          infinite: true,
          dots: true,
          arrows: true,
          fade: true,
          prevArrow: "<span class='slick-arrow-left'><i class='automechanic-icon automechanic-arrows32'></i></span>",
          nextArrow: "<span class='slick-arrow-right'><i class='automechanic-icon automechanic-arrows32'></i></span>",
          responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                  }
                },
                {
                  breakpoint: 800,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 400,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }
              ]
        });
      //***************************
    // CartToggle Function
    //***************************
    jQuery('.automechanic-strip-option li.cart').on("click", function(){
          jQuery('.automechanic-cart-box').fadeToggle('slow');
          return false;
      });
      jQuery('html').on("click", function() { jQuery(".automechanic-cart-box").fadeOut(); });

    //***************************
    // vehicle Functions
    //***************************
    jQuery('.automechanic-partner-slider').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        dots: false,
        prevArrow: "<span class='slick-arrow-left'><img src='/img/flecha_derecha.png'></span>",
        nextArrow: "<span class='slick-arrow-right'><img src='/img/flecha_derecha.png'></span>",
        responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1,
                  infinite: true,
                }
              },
              {
                breakpoint: 800,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1
                }
              },
              {
                breakpoint: 400,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }
            ]
      });

    //***************************
    // ThumbSlider Functions
    //***************************
    jQuery('.automechanic-shop-thumb').slick({
          slidesToShow: 1,
          autoplay: true,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          asNavFor: '.automechanic-shop-thumb-list'
        });
        jQuery('.automechanic-shop-thumb-list').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          autoplay: true,
          asNavFor: '.automechanic-shop-thumb',
          dots: false,
          arrows: false,
          vertical: false,
          centerMode: false,
          focusOnSelect: true,
          responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    vertical: false,
                  }
                },
                {
                  breakpoint: 800,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    vertical: false,
                  }
                },
                {
                  breakpoint: 400,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    vertical: false,
                  }
                }
              ],
        });

//***************************
    // Fancybox Function
    //***************************
    jQuery(".fancybox").fancybox({
      openEffect  : 'elastic',
      closeEffect : 'elastic',
    });

//***************************
    // slider Functions
    //***************************
      $( function() {
          $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 200,
            values: [ 30, 100 ],
            slide: function( event, ui ) {
              $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            }
          });
          $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
            " - $" + $( "#slider-range" ).slider( "values", 1 ) );
        } );


});



// When the window has finished loading create our google map below
    

    

    //***************************
    // TOUR GRID Function
    //***************************
    jQuery(window).on('load', function() {
    var $grid = $('.automechanic-portfolio-filter').isotope({
      itemSelector: '.element-item',
      layoutMode: 'fitRows'
    });
    // filter functions
    var filterFns = {
      // show if number is greater than 50
      numberGreaterThan50: function() {
        var number = $(this).find('.number').text();
        return parseInt( number, 10 ) > 50;
      },
      // show if name ends with -ium
      ium: function() {
        var name = $(this).find('.name').text();
        return name.match( /ium$/ );
      }
    };
    // bind filter button click
    $('.filters-button-group').on( 'click', 'a', function() {
      var filterValue = $( this ).attr('data-filter');
      // use filterFn if matches value
      filterValue = filterFns[ filterValue ] || filterValue;
      $grid.isotope({ filter: filterValue });
    });
    // change is-checked class on buttons
    $('.filters-button-group').each( function( i, buttonGroup ) {
      var $buttonGroup = $( buttonGroup );
      $buttonGroup.on( 'click', 'a', function() {
        $buttonGroup.find('.is-checked').removeClass('is-checked');
        $( this ).addClass('is-checked');
      });
    }); 

});

// Multi-Toggle Navigation
$(function() {
  $('body').addClass('js');
    var $menu = $('#menu'),
      $menulink = $('.menu-link'),
      $menuTrigger = $('.has-subnav');

  $menulink.on("click", function(e) {
    e.preventDefault();
    $menulink.toggleClass('active');
    $menu.toggleClass('active');
  });

  $menuTrigger.on("click", function(e) {
    e.preventDefault();
    var $this = $(this);
    $this.toggleClass('active').next('ul').toggleClass('active');
  });

});