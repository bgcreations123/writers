// Custom js codes here

var slider = document.getElementById("myRange");
var output = document.getElementById("pages");
output.innerHTML = slider.value;

slider.oninput = function() {
	output.innerHTML = this.value;
}

// Pricing plan for prices on the home page
$(document).ready(function() {
	$('select[name="classification"]').change(function(e){
		var classificationId = $(this).val();
		$('select[name="period"]').val('0');
		$('select[name="period"]').prop('disabled', !$(this).val());
		$('select[name="period"]').change(function(e){
			var periodId = $(this).val();
	        if(classificationId && periodId) {
	            $.ajax({
	                url: '/getProduct/'+classificationId+'/'+periodId,
	                type:"GET",
	                dataType:"json",
	                beforeSend: function(){
	                    $('#loader').css("visibility", "visible");
	                },

	                success:function(data) {
	                    $('#pricing-plan-price').empty();
	                    $.each(data, function(key, value){
	                        $('#pricing-plan-price').append(value);
	                    });
	                },
	                complete: function(){
	                    $('#loader').css("visibility", "hidden");
	                }
	            });
	        } else {
	            $('#pricing-plan-price').empty();
	        }
		});
	});

	$(function(){
		$('select[name="period"]').prop('disabled', true);
	});

});