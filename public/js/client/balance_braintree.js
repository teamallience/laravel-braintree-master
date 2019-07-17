$(document).ready(function(){
  // var pusher = new Pusher(app_key, {
  //   cluster: cluster,
  //   encrypted: true
  // })
  // var channel = pusher.subscribe('client-dashboard');
  // setInterval(function(){
  //     $.ajax({
  //         url: '/stats-get-balance'
  //     })
  // },15000)
      
  // //pusher get channel for real
  // channel.bind('get-balance' + id, function(response) {
  //     // console.log('pusher stats response for user ' + id)
  //   changeStats(response)
  // });

    

  // var changeStats = function(stats){
  //   console.log(stats)
  //     $("#header-balance").number(stats.balance, 2)
  //     $("#balance").number(stats.balance, 2)
  // }

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
            // response.data.token
            var form = document.querySelector('#add_card_form');
            var authorization = braintree_auth;
            var submit = document.querySelector('#button-pay');
            braintree.client.create({
              authorization: authorization
            }, function(err, clientInstance) {
              if (err) {
                console.error(err);
                return;
              }
              createHostedFields(clientInstance);
            });

            function createHostedFields(clientInstance) {
              braintree.hostedFields.create({
                client: clientInstance,
                styles: {
                  'input': {
                    'font-size': '16px',
                    'font-family': 'courier, monospace',
                    'font-weight': 'lighter',
                    'color': '#ccc'
                  },
                  ':focus': {
                    'color': 'black'
                  },
                  '.valid': {
                    'color': '#00b30f'
                  },
                  '.invalid': {
                    'color': '#ed574a'
                  }
                },
                fields: {
                  // cardholderName: {
                  //   selector: '#cardholder-name',
                  //   placeholder: 'John Doe'
                  // },
                  number: {
                    selector: '#card-number',
                    placeholder: '4111 1111 1111 1111'
                  },
                  cvv: {
                    selector: '#cvv',
                    placeholder: '123',
                    maxlength: 5,
                    minlength: 2,
                    type: 'password'
                  },
                  expirationDate: {
                    selector: '#expiration-date',
                    placeholder: 'MM / YY'
                  },
                  postalCode: {
                    selector: '#postal-code',
                    placeholder: '11111',
                    maxlength: 5,
                    minlength: 5

                  }
                },
              }, function (err, hostedFieldsInstance) {
                
                if (err) {
                  console.error(err);
                  return;
                }

                hostedFieldsInstance.on('validityChange', function (event) {
                  // Check if all fields are valid, then show submit button
                  var formValid = Object.keys(event.fields).every(function (key) {
                    return event.fields[key].isValid;
                  });

                  if (formValid) {
                    $('#button-pay').attr('disabled', false);
                  } else {
                    $('#button-pay').attr('disabled', true);
                  }
                });

                hostedFieldsInstance.on('empty', function (event) {
                  $('#card-image').removeClass();
                  $(form).removeClass();
                });

                hostedFieldsInstance.on('cardTypeChange', function (event) {
                  // Change card bg depending on card type
                  if (event.cards.length === 1) {
                    $(form).removeClass().addClass(event.cards[0].type);
                    $('#card-image').removeClass().addClass(event.cards[0].type);
                    // Change the CVV length for AmericanExpress cards
                    if (event.cards[0].code.size === 4) {
                      hostedFieldsInstance.setAttribute({
                        field: 'cvv',
                        attribute: 'placeholder',
                        value: '1234'
                      });
                    } 
                  } else {
                    hostedFieldsInstance.setAttribute({
                      field: 'cvv',
                      attribute: 'placeholder',
                      value: '123'
                    });
                  }
                });

                submit.addEventListener('click', function (event) {
                  event.preventDefault();
                  $(form).block({
                      message: '<i class="icon-Car-Wheel spinner"></i>',
                      overlayCSS: {
                          backgroundColor: '#fff',
                          opacity: 0.8,
                          cursor: 'wait'
                      },
                      css: {
                          border: 0,
                          padding: 0,
                          backgroundColor: 'none'
                      }
                  });

                  hostedFieldsInstance.tokenize(function (err, payload) {
                    if (err) {
                      swal({
                        title: "Oops...",
                        text: err.message,
                        confirmButtonColor: "#EF5350",
                        type: "error"
                      });
                       $(form).unblock();
                      return;
                    }

                    var info = {
                      payment_method_nonce: payload.nonce,
                      _token: $('meta[name="csrf-token"]').attr('content')
                    }

                    $.ajax({
                      type: "post",
                        url: "/balance/add_card",
                        data: info,
                        beforeSend: function (xhr) {
                            var token = $('meta[name="csrf-token"]').attr('content');
                            if (token) {
                                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                            }
                          },        
                        success: function (response){
                          console.log(response)
                          if(response.status == 'success'){
                            location.reload()
                          }else{
                            swal({
                              title: "Oops...",
                              text: 'Your credit card information is not valid',
                              confirmButtonColor: "#EF5350",
                              type: "error"
                            });
                             $(form).unblock();
                          }
                        }
                    })
                    // console.log(payload)
                  });
                }, false);
              });
            }
            
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
})