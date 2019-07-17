$(document).ready(function(){
  var pusher = new Pusher(app_key, {
    cluster: cluster,
    encrypted: true
  })
  var channel = pusher.subscribe('client-dashboard');
    setInterval(function(){
        $.ajax({
            url: '/stats-update'
        })
    },15000)
      
  //pusher get channel for real
    channel.bind('get-stats' + id, function(response) {
        // console.log('pusher stats response for user ' + id)
      changeStats(response)
    });

    

    var changeStats = function(stats){
        $("#header-balance").number(stats.balance, 2)
        $("#balance").number(stats.balance, 2)
    }

  // This handler does the magic
  var PaymentHadler = function(){
      handleFieldEvent = function(event) {
        iconType = document.getElementsByClassName("icon-type")[0];
        iconType.className = "icon-type";
        if (event.card) iconType.className += " icon-type-" + event.card.type;
      }
     
      $.ajax({
        url: '/braintree/token'
      }).done(function(response){
          if(typeof braintree != "undefined"){
            // braintree.setup(response.data.token, 'dropin', {
            //   container: 'dropin-container'
            // });
            braintree.setup(response.data.token, "custom", {
              id: "add_card_form",
              hostedFields: {
                number: {
                  selector: "#card-number",
                  placeholder: "4242"
                },
                cvv: {
                  selector: "#cvv",
                  placeholder: "123"
                },
                expirationDate: {
                  selector: "#expiration-date",
                  placeholder: "MM / YYYY"
                },
                postalCode: {
                  selector: '#postal-code',
                  placeholder: ''
                },
                styles: { // custom styles
                  '.invalid': {
                    'color': '#D0041D'
                  }
                },
                onFieldEvent: handleFieldEvent
              },
            });
            braintree.setup(response.data.token, "custom", {
              paypal: {
                container: "paypal-container",
              },
              onPaymentMethodReceived: function (obj) {
                $("#payment_method_nonce").val(obj.nonce)
                var form = $("#add_paypal_form");
                form.submit();
              }
            });
            
          }
      });  
  }
  
  var DraggableHandler = function(){
    if (!jQuery().sortable) {
            return;
    }

    $(".sortable-portlet").sortable({
        connectWith: ".sortable",
        items: ".sortable", 
        opacity: 0.8,
        coneHelperSize: true,
        placeholder: 'draggable-sortable-placeholder',
        forcePlaceholderSize: true,
        tolerance: "pointer",
        helper: "clone",
        tolerance: "pointer",
        forcePlaceholderSize: !0,
        helper: "clone",
        cancel: ".draggable-sortable-empty, .draggable-fullscreen", // cancel dragging if portlet is in fullscreen mode
        revert: 250, // animation in milliseconds
        update: function(b, c) {
            if (c.item.prev().hasClass("draggable-sortable-empty")) {
                c.item.prev().before(c.item);
            }                    
        },
        stop: function(){
          var main_method;
          main_method = $(".sortable-portlet div.sortable:first").data("id");

          var info = {
            main_method: main_method,
            _token: $('meta[name="csrf-token"]').attr('content')
          }

          $.ajax({
          type: "post",
            url: "/balance/set_main",
            data: info,
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');
                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
              },        
            success: function (response){
              if(response.status = 'success'){
                handleToaster('success', 'success')
                $("#main_method").val(main_method)
                
              }
            }
        })
        }


    });
  }
    
  PaymentHadler();
  DraggableHandler();
})