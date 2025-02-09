function togglePopup() {
if($('#popup').hasClass('hidden'))
{
	if($.browser.msie)
	{
		$('#opaco').height($(document).height()).toggleClass('hidden')
		.click(function(){togglePopup(); stopVideo();});
	}
	else
	{
		$('#opaco').height($(document).height()).toggleClass('hidden').fadeTo('slow', 0.7)
		.click(function(){togglePopup();});
	}
	var marginLeft = - $('#popup').width()/2 + 'px';
	var marginTop = - $('#popup').height()/2 + 'px';
	$('#popup').css({'margin-left':marginLeft, 'margin-top':marginTop});
	$('#popup').toggleClass('hidden');
}
else
{
	$('#popup').toggleClass('hidden');
	$('#opaco').toggleClass('hidden').removeAttr('style').unbind('click');
	$('.gallery_show').empty();
}
};

function startVideo(video_id) {
$(".gallery_show").html("<iframe width='1024' height='576' frameborder='0' allowfullscreen src='https://www.youtube.com/embed/"+video_id+"'></iframe>");
};
