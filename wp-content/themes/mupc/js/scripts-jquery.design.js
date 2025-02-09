$(window).load(function() {
	$("body").removeClass("load");
});

$(document).ready(function() {

    // Lottery Winners
    $('.btn-block-lottery').click(function() {
        $('.btn-block-lottery').removeClass('active');
        $(this).addClass('active');
        $('.block-tab.lottery-tab').removeClass('active');
        $('#'+$(this).attr('data-tab')).addClass('active');
    })

    // Quest Winners
    $('.btn-block-quest').click(function() {
        $('.btn-block-quest').removeClass('active');
        $(this).addClass('active');
        $('.block-tab.quest-tab').removeClass('active');
        $('#'+$(this).attr('data-tab')).addClass('active');
    });
});

// Simple Toggle
$(document).ready(function(){
	$('.center-menu .toggle').click(function() {
    $(this).siblings('.center-menu-content').slideToggle(200);
	});

	$('.center-menu .clickngo').click(function() {
		var url = $(this).data('url');
		
		if(url !== undefined) {
	  	return window.location = url;
		}
	});
});

// Drop Select (Login Form)
$(document).ready(function() {
    var mySettings = {
        key : true,
        dropBlock : $('.drop'),
        virtualSelect : $('.slct'),
    }
  
    // hide/show ul > list
    mySettings.virtualSelect.click(function() {
        if(mySettings.dropBlock.is(':hidden')) {
            mySettings.dropBlock.slideDown(100);
            
            $(this).addClass('active');
        } 
        else {
            mySettings.dropBlock.slideUp(100);

            $(this).delay(400).queue(function(nextJ) {
                $(this).removeClass("active");
                //nextJ();
            });
        }

        return false;
    }); 
    
    // click on ul > li
	mySettings.dropBlock.find('li').click(function() {
        var selectResult = {html: $(this).html(), value: $(this).data('value')};
            
        $(this).parent().parent().find('input').val(selectResult.value);
      
        // just for css decoration
        mySettings.dropBlock.find('li').removeClass('hover').removeClass('selected');
        $(this).addClass('selected');

        mySettings.dropBlock.slideUp(100);       
            
        mySettings.virtualSelect.delay(400).queue(function(nextJs) {
            $(this).removeClass("active");
            //nextJs();
        })
        .html(selectResult.html);
        
        return false;
	});

    // hide list on outside ul click
    $(document).click(function(event) {
        if(mySettings.key && !$(event.target).closest(mySettings.dropBlock).length) {
          mySettings.key = false;

          mySettings.dropBlock.slideUp(100);

          mySettings.virtualSelect.delay(400).queue(function(nextJs) {
          $(this).removeClass("active");
          //nextJs();
        });

        mySettings.key = true;
        return;
      }
    });
    
    // arrow|enter keys events
    $('#login-server-select').keydown(function(e) {
        $dropUl = $(this).children('ul').first();
        $selectedLi = !$dropUl.find('.hover').length ? $dropUl.find('.selected') : $dropUl.find('.hover'); // 

        switch(e.which) {
            case 37: // left
            case 38: // up

                if(!$selectedLi.is(':first-child')) {
                    $selectedLi.removeClass('hover');

                    $prevLi = $selectedLi.prev();
                    $prevLi.addClass('hover');

                    $dropUl.siblings('.slct').first().text($prevLi.text());
                }
            break;
    
            case 39: // right
            case 40: // down
                if(!$selectedLi.is(':last-child')) {
                    $selectedLi.removeClass('hover');
                    
                    $nextLi = $selectedLi.next();
                    $nextLi.addClass('hover');

                    $dropUl.siblings('.slct').first().text($nextLi.text());
                }
            break;

            case 13: // enter
                $selectedLi.trigger('click');
            break;
    
            default: return; // exit this handler for other keys
        }

        e.preventDefault(); // prevent the default action (scroll / move caret)
    });
});

// Image Carousel (Modified)
$(document).ready(function() {
	var width = 121;
	var count = 4;
	var carousel = document.getElementById('carousel');
	
	if(!carousel) {
		return;
	}

	var list = carousel.querySelector('ul');
	var listElems = carousel.querySelectorAll('li');

	var prevPosition = -1;
	var position = 0;


	carousel.querySelector('.prev').onclick = function() {
		position = Math.min(position + width * count, 0)
		list.style.marginLeft = position + 'px';

		imageCarouselCheckPosition(position);
	};

	carousel.querySelector('.next').onclick = function() {
        imageCarouselNext();
    };
    
    function imageCarouselNext() {
        prevPosition = position;

		position = Math.max(position - width * count, -width * (listElems.length - count));
		list.style.marginLeft = position + 'px';

		if(prevPosition == position) { // move back
			list.style.marginLeft = '0px'; 
			prevPosition = -1;
			position = 0;
		}

		imageCarouselCheckPosition(position);
    }

	//
	
	function imageCarouselCheckPosition(position) {
		var carouselPrevButton = $('#img-carousel-back');

		if(position == 0) {
			carouselPrevButton.removeClass('active');
			carouselPrevButton.addClass('disabled');
		}
		else {
			carouselPrevButton.removeClass('disabled');
			carouselPrevButton.addClass('active');
		}
	}

	//

	setInterval(function() {
		var isImgCarouselHovered = $('#carousel').is(":hover");

		if(!isImgCarouselHovered) {
			imageCarouselNext();
		}

	}, 4000);
});