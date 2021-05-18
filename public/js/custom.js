// Custom js codes here

// Pricing plan for prices on the home page
$(document).ready(function() {
	var slider = document.getElementById("myRange");
	var output = document.getElementById("pages");
	output.innerHTML = slider.value;

	slider.oninput = function() {
		output.innerHTML = this.value;
	}

	$('select[name="classification"]').change(function(e){

		var classificationId = $(this).val();

		//$('#pricing-plan-price').innerHTML = '<sup><strong>$</strong></sup>0<span>.00</span>';


		if(classificationId == 0){
			// $('select[name="period"]').val('0');
			// $('select[name="period"]').prop('disabled', true);

			// output.innerHTML = 1;
			// slider.value = 1;

			// var working_value = 0

			// document.getElementById("pricing-plan-price").innerHTML = '<sup><strong>$</strong></sup>0<span>.00</span>';
			location.reload();
		} else {

			$('select[name="period"]').prop('disabled', !$(this).val());

			$('select[name="period"]').change(function(e){

				var periodId = $(this).val();

				if(periodId == 0){
					output.innerHTML = 1;
					slider.value = 1;

					document.getElementById("pricing-plan-price").innerHTML = '<sup><strong>$</strong></sup>0<span>.00</span>';
				} else {

			        if(classificationId && periodId) {
			            $.ajax({
			                url: '/getProduct/'+classificationId+'/'+periodId,
			                type:"GET",
			                dataType:"json",
			                beforeSend: function(){
			                    $('#loader').css("visibility", "visible");
			                },

			                success:function(data) {
			                    $('#pricing-plan-price').innerHTML = '<sup><strong>$</strong></sup>0<span>.00</span>';
			                    $.each(data, function(key, value){

			                    	document.getElementById("pricing-plan-price").innerHTML = '<sup><strong>$</strong></sup>' + value * 1 + '<span>.00</span>';

		                        	slider.value = 1;

		                        	output.innerHTML = 1;

			                        slider.onmouseup = function(){
			                        	document.getElementById("pricing-plan-price").innerHTML = '<sup><strong>$</strong></sup>' + slider.value * value + '<span>.00</span>';
			                        	// $('#pricing-plan-price').val(slider.value * value);
			                        	// console.log(slider.value);
			                        }

			                    });
			                },
			                complete: function(){
			                    $('#loader').css("visibility", "hidden");
			                }
			            });
			        } else {
			            document.getElementById("pricing-plan-price").innerHTML = '<sup><strong>$</strong></sup>0<span>.00</span>';
			        }
			    }

			});
		}
		
	});

	$(function(){
		$('select[name="period"]').prop('disabled', true);
	});

	$('#carouselExample').on('slide.bs.carousel', function (e) {

	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = 4;
	    var totalItems = $('.carousel-item').length;
	    
	    if (idx >= totalItems-(itemsPerSlide-1)) {
	        var it = itemsPerSlide - (totalItems - idx);
	        for (var i=0; i<it; i++) {
	            // append slides to end
	            if (e.direction=="left") {
	                $('.carousel-item').eq(i).appendTo('.carousel-inner');
	            }
	            else {
	                $('.carousel-item').eq(0).appendTo('.carousel-inner');
	            }
	        }
	    }
	});
	
});
