// JavaScript Document
$(document).ready(function() {
	
	  $("#qtt").on('change', function() {
		$("#addToCart").attr("data-quantity",$(this).val());
	  });
	  
	  
	  $(".my-cart-btn").click(function(){
		var quantity = $(this).attr("data-quantity");
		var id = $(this).attr("data-id");
		var name = $(this).attr("data-name");
		var summary = $(this).attr("data-summary");
		var price = $(this).attr("data-price");
		var image = $(this).attr("data-image");
		
        $.post(__URL + '/shop/add',
        {
          id: id,
          name: name,
		  quantity: quantity,
		  price: price,
		  image: image,
		  summary: summary
        },
        function(data,status){
			//window.alert(data);
			if(data==1){
			window.location.href = __URL + '/shop/cart';
			}else{
			window.location.href = __URL;
			}
        });
      });
  	  
	  $(".my-wishlist-btn").click(function(){
		  	var quantity = $(this).attr("data-quantity");
			var id = $(this).attr("data-id");
			var name = $(this).attr("data-name");
			var summary = $(this).attr("data-summary");
			var price = $(this).attr("data-price");
			var image = $(this).attr("data-image");
			$.post(__URL + '/shop/wishlist',
			{
			  id: id,
			  name: name,
			  quantity: quantity,
			  price: price,
			  image: image,
			  summary: summary
			},
			function(data,status){
				window.alert(data);
				/*if(data==1){
				window.location.href = window.location.href;
				}else{
				window.location.href = __URL;
				}*/
			});
      });
	  
	  $( 'input[class="updateCart"]' ).on( "change", function() {
		  //var products=[{id:$(this).attr('dataId'),quantity:$(this).val()}];
		  $.post(__URL + '/shop/updatecart',{id:$(this).attr('dataId'),name:$(this).attr('dataName'),price:$(this).attr('dataPrice'),image:$(this).attr('dataImg'),quantity:$(this).val()},
		  	function(data,status){
				if(data==1){
				window.location.href = __URL + '/shop/cart';
				}else{
				window.location.href = __URL;
				}
			}
		);
	  });
	  
	  $('.removeCart' ).click(function(){
		  //window.alert("cadchdgc");
		  $.post(__URL + '/shop/removecart',{id:$(this).attr('rel-id')},
		  	function(data,status){
				if(data==1){
				window.location.href = __URL + '/shop/cart';
				}else{
				window.location.href = __URL;
				}
			}
		  );
	  });
	  
	  $('.delOrderBtn' ).click(function(){
		 //window.alert("cadchdgc");
	     $.post(__URL + '/shop/deleteOrder',{id:$(this).attr('data-id')},
		  	function(data,status){
				if(data==1){
				window.location.href = window.location.href;
				}else{
				window.location.href = __URL;
				}
			}
		 );
	  });
		
		
	  $("#cityId").on('change', function() {
		  $("#districtId").find('option').not(':first').remove();
		  $.post(__URL + '/city/ccity',{id:$(this).val()},
		  	function(data,status){
				$("#districtId").append(data);
			}
		  );
	  });	
		
      $("#owl-demo").owlCarousel({
	  
	  autoPlay: 3000,
      navigation : false,
      slideSpeed : 300,
	  pagination : false,
      paginationSpeed : 400,
      singleItem : true

      });
	  
	  $("#owl-slide").owlCarousel({
		autoPlay: 3000,
		items : 4,
		lazyLoad : true,
		navigation : true,
		pagination : false,
	  }); 
	  
	var sync1 = $("#sync1");
  	var sync2 = $("#sync2");
 
  sync1.owlCarousel({
    singleItem : true,
    slideSpeed : 1000,
    navigation: true,
    pagination:false,
    afterAction : syncPosition,
    responsiveRefreshRate : 200,
  });
 
  sync2.owlCarousel({
    items : 5,
    itemsDesktop      : [1199,10],
    itemsDesktopSmall     : [979,10],
    itemsTablet       : [768,8],
    itemsMobile       : [479,4],
    pagination:false,
    responsiveRefreshRate : 100,
    afterInit : function(el){
      el.find(".owl-item").eq(0).addClass("synced");
    }
  });
 
  function syncPosition(el){
    var current = this.currentItem;
    $("#sync2")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#sync2").data("owlCarousel") !== undefined){
      center(current)
    }
  }
 
  $("#sync2").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync1.trigger("owl.goTo",number);
  });
 
  function center(number){
    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync2visible){
      if(num === sync2visible[i]){
        var found = true;
      }
    }
 
    if(found===false){
      if(num>sync2visible[sync2visible.length-1]){
        sync2.trigger("owl.goTo", num - sync2visible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        sync2.trigger("owl.goTo", num);
      }
    } else if(num === sync2visible[sync2visible.length-1]){
      sync2.trigger("owl.goTo", sync2visible[1])
    } else if(num === sync2visible[0]){
      sync2.trigger("owl.goTo", num-1)
    }
    
  }
  
  	
  	/*var goToCartIcon = function($addTocartBtn){
      var $cartIcon = $(".my-cart-icon");
      var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
      $addTocartBtn.prepend($image);
      var position = $cartIcon.position();
      $image.animate({
        top: position.top,
        left: position.left
      }, 500 , "linear", function() {
        $image.remove();
      });
    }

    $('.my-cart-btn').myCart({
      classCartIcon: 'my-cart-icon',
      classCartBadge: 'my-cart-badge',
      classProductQuantity: 'my-product-quantity',
      classProductRemove: 'my-product-remove',
      classCheckoutCart: 'my-cart-checkout',
      affixCartIcon: true,
      showCheckoutModal: true,
      clickOnAddToCart: function($addTocart){
        goToCartIcon($addTocart);
      },
      clickOnCartIcon: function($cartIcon, products, totalPrice, totalQuantity) {
        console.log("cart icon clicked", $cartIcon, products, totalPrice, totalQuantity);
      },
      checkoutCart: function(products, totalPrice, totalQuantity) {
        console.log("checking out", products, totalPrice, totalQuantity);
      },
      getDiscountPrice: function(products, totalPrice, totalQuantity) {
        console.log("calculating discount", products, totalPrice, totalQuantity);
        return totalPrice * 1;
      }
    });*/
  
    });
	
	