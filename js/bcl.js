var tempImgSrc;

$(document).ready(function(){

	$(".project-row a").on("mouseover", function() {
		$(this).find(".imagecaption").css('display', 'block');
		
	});
	
	$(".project-row a").on("mouseout", function() {
		$(this).find(".imagecaption").css('display', 'none');
	});
	
	/*
	.project-row a img:hover {
		border: 107.5px solid #00b4f1;;
	}
	
	
	
	*/
});