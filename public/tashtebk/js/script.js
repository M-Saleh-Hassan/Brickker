$(document).ready(function(){
    var heightHeader = $("header").innerHeight() 
    var heightFooter = $("footer").innerHeight() 
    var result = heightHeader + heightFooter

    $("main").css({'min-height': 'calc(100vh - '+ heightFooter + 'px )' , 'padding-top' : heightHeader +'px'})
    $(".main1").css({ 'padding-top' : '0'})
   
     $(".xzoom, .xzoom-gallery").xzoom();
        //Integration with FancyBox 2 plugin
        $('.xzoom:first').bind('click', function() {
            var xzoom = $(this).data('xzoom');
            xzoom.closezoom();
            $.fancybox.open(xzoom.gallery().cgallery, {padding: 0, helpers: {overlay: {locked: false}}});
            event.preventDefault();
        });
 
  $('ul.drop li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
}); 

//  $(".mobile .menu-toggle").click(function() {
// 	$(this).parent().next(".mobile-nav").toggle(0 , "display");
// });
  

  new WOW().init();

	$('header nav li a').click(function(){
	$('html , body').animate({
    scrollTop : $('#' + $(this).data('value')).offset().top},1400);
    });


    $( function() {
      $( "#slider" ).slider();
    } );

    var swiper = new Swiper('.swiper-product', {
      slidesPerView: 4,
      spaceBetween: 30,
      // init: false,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      breakpoints: {
          
        1024: {
          slidesPerView: 4,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        }
      }
      
      
      
    });
     var swiper = new Swiper('.swiper-related', {
      slidesPerView: 4,
      spaceBetween: 40,
    //   slidesPerGroup: 3,
      // init: false,
    //   autoplay: {
    //     delay: 2500,
    //     disableOnInteraction: false,
    //   },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        1024: {
          slidesPerView: 4,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        }
      }
      
      
      
    });
     var swiper = new Swiper('.swiper-multirows', {
          slidesPerView: 4,
          slidesPerColumn: 1,
          spaceBetween: 30,
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
           breakpoints: {
        1024: {
          slidesPerView: 4,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        }
      }
        });

     var swiper = new Swiper('.swiper-multirows-profiles', {
          slidesPerView: 4,
          slidesPerColumn: 1,
          spaceBetween: 30,
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
           breakpoints: {
        1024: {
          slidesPerView: 4,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        }
      }
        });

    var swiper = new Swiper('.swiper-ctg', {
      slidesPerView: 4,
      spaceBetween: 30,
      // init: false,
      /*autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },*/
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        1024: {
          slidesPerView: 4,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        }
      }
    });


    $('.add').click(function () {
      if ($(this).prev().val() < 100) {
        $(this).prev().val(+$(this).prev().val() + 1);
      }
  });
  $('.sub').click(function () {
      if ($(this).next().val() > 1) {
        if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
      }
  });
  });
  
    var swiper = new Swiper('.swiper-gallary', {
      slidesPerView: 3,
      spaceBetween: 20,
       pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
     
    });
    
    
    function zoom(e){
  var zoomer = e.currentTarget;
  e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
  e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
  x = offsetX/zoomer.offsetWidth*100
  y = offsetY/zoomer.offsetHeight*100
  zoomer.style.backgroundPosition = x + '% ' + y + '%';
}

      $(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('focus', '.panel-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideDown();
        $('#minim_chat_window').removeClass('panel-collapsed');
        $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('click', '#new_chat', function (e) {
    var size = $( ".chat-window:last-child" ).css("margin-left");
     size_total = parseInt(size) + 400;
    alert(size_total);
    var clone = $( "#chat_window_1" ).clone().appendTo( ".container" );
    clone.css("margin-left", size_total);
});
$(document).on('click', '.icon_close', function (e) {
    //$(this).parent().parent().parent().parent().remove();
    // $( "#chat_window_1" ).remove();
    $('.chat-window').toggleClass('hidden');
});

  function openChat(evt, ChatName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(ChatName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  // Get the element with id="defaultOpen" and click on it
//   document.getElementById("defaultOpen").click();
$(".mobile .header").click(function() {
  $( ".mobile .mobile-nav" ).toggleClass( "d-block" )
});
 