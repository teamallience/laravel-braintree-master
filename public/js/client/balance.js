$(document).ready(function(){
	
	var card = new Skeuocard($("#skeuocard"),{
		debug: false,
	});

	card.bind('faceValidationStateDidChange.skeuocard', function(e, _card, from, to){
	  if(card._state.backValid && card._state.frontValid || (typeof card.product != null && card.product.attrs.companyShortname =='amex' && card._state.frontValid)){
	  	$('#button-pay').attr('disabled', false);
	  }else{
	  	$('#button-pay').attr('disabled', true);
	  }
	});

	

	var autobill_init = function(){

		if(typeof $().bootstrapSwitch != "undefined" && $("#autobill-toggler").length != 0){
			$("#autobill-toggler").bootstrapSwitch({
				onSwitchChange: function(e, state) {
					var info = {
			    		autobill_toggler: state,
			    		_token: $('meta[name="csrf-token"]').attr('content')
			    	}
			    	$("#autobill-form-wrapper").toggle(500)
					$.ajax({
						type: "post",
			      		url: "/balance/autobill/toggler",
					    data: info,
						beforeSend: function (xhr) {
				            var token = $('meta[name="csrf-token"]').attr('content');
				            if (token) {
				                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
				            }
				        },		    
					    success: function (response){
					    	// console.log(response)
				    	}
					})
				}
			});
		}


		// var autobill_array = [10, 20, 50, 100, 250, 500];
		
		$("select.autobill").change(function(){
			$("#autobill-update-btn").removeClass('d-none');
		})

		

		// $("select.autobill.worth").change(function(){
		// 	var min_limit = Number($(".autobill.worth").val());

		// 	function isBigEnough(value) {
		// 	  return function(element, index, array) {
		// 	    return (element >= value);
		// 	  }
		// 	}
		// 	var filtered = autobill_array.filter(isBigEnough(min_limit));
			
		// 	var select_str = ''

		// 	filtered.forEach(function(value, index){
		// 		select_str += '<option value="' + value +'"> $' + value + '</option>' 
		// 	})
		// 	$(".autobill.limit").empty().append(select_str)
		// })

	}

	 var braintreeHandler = function(){
      $.ajax({
        url: '/braintree/token'
      }).done(function(response){
      		
          if(typeof braintree != "undefined"){

            braintree.setup(response.data.token, "custom", {
              paypal: {
                container: "paypal-container",
              },
              onPaymentMethodReceived: function (obj) {
                $("#add_paypal_form_payment_method_nonce").val(obj.nonce)
                var form = $("#add_paypal_form");
                form.submit();
              }
            });
            
          }
      });  
  }

	autobill_init();

	braintreeHandler();

	
})