$(document).ready(function () {
  $('[data-toggle="offcanvas"]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });
  
  var load = false;
  $(".ui-hmenu-categories").click(function(){
	  	if(load==false){
			$(".h").fadeIn(1000, function(){
				//alert("The toggle() method is finished!");
				load=true;
			});
		}else{
			$(".h").fadeOut(1000, function(){
				//alert("The toggle() method is finished!");
				load=false;
			});
		}
  });
});