$(window).on("load", function() {

	$(".loader .inner").fadeOut(500, function() {
		$(".loader").fadeOut(750);
	});

})




$(document).ready(function() {

	// $('.view_button').click(function(e){
	// 	e.stopPropagation();
	// });

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
















