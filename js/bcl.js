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
	
	
	
	
	$(window).resize(function() {
		console.log("resize", $(window).width());
		updateProjects();
	});
	
	updateProjects();
	
});


var updateProjects = function() {
	
	if ($('#projects').length>0) {
		
		var p = $('#projects').width()-1;
		var c = 5
		if (p>960 && p <1200) {
			c = 4;
		} else if(p>600 && p <=960) {
			c = 3;
		} else if(p>480 && p <=600) {
			c = 2;
		} else if(p<=480) {
			c = 1;
		}
		
		// Isotope
		var w = Math.floor(p/c);
	
		$(".item").width(w);
		$('#projects').isotope({
			itemSelector: '.item',
			layoutMode: 'masonry',
			masonry: {
				columnWidth: w
			}
		});
		
/*		$('#projects').isotope({
			itemSelector: '.item',
			layoutMode: 'fitRows',
			masonry: {
				columnWidth: w,
				rowHeight: 120
			}
		});*/
		
		
		// filter items on button click
		$('#projectfilters').on( 'click', 'a', function() {
		  var filterValue = $(this).attr('data-filter');
		  $('#projects').isotope({ filter: filterValue });
		});
	}
}

