$(window).on("load", function() {

	$(".loader .inner").fadeOut(500, function() {
		$(".loader").fadeOut(750);
	});

})





$(document).ready(function() {

	$("#search_text_input").focus(function(){
		$(this).animate({
			width:'220px'
		}, 400);
	});

	$("#search_button").click(function(){
		console.log('submitted');
	});
	  

	$("[data-fancybox]").fancybox();

	$(".items").isotope({
		filter: '*',
		animationOptions: {
			duration: 1500,
			easing: 'linear',
			queue: false
		},
		getSortData: {
        price: '.price',
		date: '.date',
		discount: '.discount',
        category: '[data-category]',
       }
	});


	$('#sorts').on('click', 'button', function () {
    var sortByValue = $(this).attr('data-sort-by');
    $('.items').isotope({
        sortBy: sortByValue
    });
	});

	// change is-checked class on buttons
	$('.button-group').each(function (i, buttonGroup) {
	    var $buttonGroup = $(buttonGroup);
	    $buttonGroup.on('click', 'button', function () {
	        $buttonGroup.find('.is-checked').removeClass('is-checked');
	        $(this).addClass('is-checked');
	    });
	});



	$("#filters a").click(function() {

		$("#filters .current").removeClass("current");
		$(this).addClass("current");

		var selector = $(this).attr("data-filter");

		$(".items").isotope({
			filter: selector,
			animationOptions: {
				duration: 1500,
				easing: 'linear',
				queue: false
			}
		});

		return false;
	});





	const nav = $("#navigation");
	const navTop = nav.offset().top;

	$(window).on("scroll", stickyNavigation);

	function stickyNavigation() {

		var body = $("body");

		if($(window).scrollTop() >= navTop) {
			body.css("padding-top", nav.outerHeight() + "px");
			body.addClass("fixedNav");
		}
		else {
			body.css("padding-top", 0);
			body.removeClass("fixedNav");
		}

	}




	


});

$(document).click(function(e){
	if(e.target.class != "search_results" && e.target.id != 'search_text_input'){
		$(".search_results").html('');

		
		$("#search_text_input").animate({
			width:'180px'
		}, 400);
		
	}
});



function getLiveSearchProducts(value, baseurl){
	if(value == ''){
		$(".search_results").html('');
	}else {
		$.post(baseurl + "pages/search", {query:value}, function(data){
		
		
			$(".search_results").html(data);
			$(".search_results").append("<div class='results_status'><a href=" + baseurl + "pages/search?q= " + value + ">See All Results</a></div>");
	
			if(data == ''){
				$(".search_results").html('');
				$(".search_results").append("<div class='no_results'>No results found</div>");
			}
		});
	}
	
}
















