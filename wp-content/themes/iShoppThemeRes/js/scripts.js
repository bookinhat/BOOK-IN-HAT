  function creative_slider() {
  
//  var intervalID_slide;
        my_slider_counter = 0;
        curr_slide = 0;
        
        $('#slideshow_cont .slide_box').each(function() {
            $(this).addClass('slide_' + my_slider_counter);
            my_slider_counter++;
           
        });
        
        function home_switch_slide() {
  
            if(curr_slide >= my_slider_counter)
                curr_slide = 0;
            else if(curr_slide < 0)
                curr_slide = (my_slider_counter-1);
            
            $('.slide_' + curr_slide).fadeIn(750);
                
        }
        
        function hide_curr_slide() {
               $('.slide_' + curr_slide).stop();
               //$('.slide_' + curr_slide).fadeOut(1000);
               $('.slide_' + curr_slide).fadeOut(400);
        }
        
        function next_slide_slider(jump_to_slide) {
            hide_curr_slide(); 
            
            if(jump_to_slide == null)
                curr_slide++;     
            else 
                curr_slide = jump_to_slide;
            
            t_slide=setTimeout(home_switch_slide,50); 
            //home_switch_image();
        }
        
        function prev_slide_slider(jump_to_slide) {
            hide_curr_slide();
            
            
//            curr_slide--;        
            if(jump_to_slide == null)
                curr_slide--;     
            else 
                curr_slide = jump_to_slide;
            //home_switch_image();
            t_slide=setTimeout(home_switch_slide,50);
        }        
        
        $('.slide_prev').click(function() {
          
            prev_slide_slider();
            //clearInterval(intervalID_slide);
            //intervalID_slide = setInterval(next_slide_slider, 8000);
        
/*      $('#slideshow_cont').unbind('mouseenter mouseleave');
        $('#slideshow_cont').hover(
            function() {
                clearInterval(intervalID_slide);
                //alert('hover in');
            },
            function() {
                intervalID_slide = setInterval(next_slide_slider, 8000);  
                //alert('hover out');
            }
        );      */
        });
        
        $('.slide_next').click(function() {
            
            next_slide_slider();
            //clearInterval(intervalID_slide);
            //intervalID_slide = setInterval(next_slide_slider, 8000);
        /*
        $('#slideshow_cont').unbind('mouseenter mouseleave');
        $('#slideshow_cont').hover(
            function() {
                clearInterval(intervalID_slide);
                //alert('hover in');
            },
            function() {
                intervalID_slide = setInterval(next_slide_slider, 8000);  
                //alert('hover out');
            }
        );*/
        });                
        
        //setInterval(next_slide_image, 5000);
        intervalID_slide = setInterval(next_slide_slider, 10000);  
    
    $('#slideshow_cont').hover(
        function() {
            clearInterval(intervalID_slide);
            //alert('hover in');
        },
        function() {
            intervalID_slide = setInterval(next_slide_slider, 10000);  
            //alert('hover out');
        }
    );
  
  
  }  
function check_fixed_menu() {
    /*
    if($(document).scrollTop() > 0) {
        $('.header_menu').addClass('header_menu_fixed');
    } else {
        $('.header_menu').removeClass('header_menu_fixed');
    } 
    */   
}
$(document).ready(function() {
    creative_slider();
	
    $('.flicker-example').flicker({
        dot_navigation: false
    });    
    check_fixed_menu();
    $('#header_menu_id').slicknav();    
	$('.header_spacing').css('height', $('#header').outerHeight() + 'px');
    //$('.fullplate').css('height', ($(window).height() - $('#header').outerHeight()) + 'px');
    $('.fullplate').css('height', '570px');
/*
        $('.header_menu li').hover(
            function () {
                $('ul:first', this).css('display','block');
     
            }, 
            function () {
                $('ul:first', this).css('display','none');         
            }
        );      
        */         			
    $(".scroller").on("click",function(){
        //$(".webplate-content").animate({scrollTop:d},1e3,"easeInOutCubic");
        $("html, body").animate({ scrollTop: $('.fullplate').outerHeight() }, "slow");
        //alert('test');
    });         
});
$(window).load(function() {
	$('.header_spacing').css('height', $('#header').outerHeight() + 'px');
    //$('.fullplate').css('height', ($(window).height() - $('#header').outerHeight()) + 'px');
    $('.fullplate').css('height', '570px');
    check_fixed_menu();
});
$(window).scroll(function() {
    $('.header_spacing').css('height', $('#header').outerHeight() + 'px');
    //console.log( $(document).scrollTop() ); //get scroll distance from top
    check_fixed_menu();
});
$(window).resize(function() {
    $('.header_spacing').css('height', $('#header').outerHeight() + 'px');
    check_fixed_menu();
});