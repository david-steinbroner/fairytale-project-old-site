$(document).ready(function() { 

$(function() {   
$("html").removeClass('no-js'); 
$("#participants").fadeIn('1200'); 
});

$("img.lazy").show().lazyload({
// threshold : 200, 
event: "scrollstop" 
}).scroll();



$(function() {  
	$(".participant.fancybox").click(function() {
	var value = $(this).attr('id');

	$.ajax({
      type: "POST",
      url: "participant.php",
      data: { id : value },
      success: function (data) {  
      console.log(data);
      	$.fancybox({'width' : 1000,
            'height'  : 600, 
            'type' : 'inline', 
            'content' : data
            });
        }
      });
       return false; 
    });  
    });







var viewportWidth = $(window).width();
var viewportHeight = $(window).height();

$(window).resize(function() {
var viewportWidth = $(window).width();
var viewportHeight = $(window).height();
});
         
// ZOOM IN + OUT

var participants_orig_width = $(".participant_front_page").width();
   
  
$("#plus").click(function () {
$("#participants").width("100%");
if ($(".outer").width() < "200") {
	$(".outer").width($(".outer").width()*1.25);
	var curFontSize = $(".outer p").css("font-size");
	$(".outer p").css("font-size", parseInt(curFontSize)+1);
	if ($(".outer").width() > "100"){
	$(".REG").addClass('big');
	 $("img.big").each(function(){
   this.src = this.src.replace('?w=100&h=100&c=true', '?w=200&h=200&c=false');
});
	}
}
else {
return false;
	}
});



$("#minus").click(function () {
$("#participants").width("100%");
	if ( $(".participant_front_page").width() >= 50) { 
		$(".outer").width($(".outer").width()/1.25);
		var curFontSize = $(".outer p").css("font-size");
		$(".outer p").css("font-size", parseInt(curFontSize)-1);
	} 
	else {
return false;
	}
});



// DRAGGABLE

$(function() {  
//	$("#participants.draggable").draggable();
	$("#headercontainer.draggable").draggable();
});


// FILTERING AJAX FUNCTIONS	
	
$(function() {  
	$("div.home #language").change(function() {
	$(".participant_front_page").removeClass('active').addClass('inactive');
	$(".id").removeClass('active1').addClass('inactive1');
	var language =  $("#language").val();

	$.ajax({
      type: "POST",
      url: "filtertest.php",
      data: { participant_lang : language },
      success: function (data) {  
      $('#scripts').html(data);
      }
      });
    });  
}); 
 	 		
	$(function() {  
 	 $("div.home #gender").change(function() {  
	var gender =  $("#gender").val();
	   $(".participant_front_page").removeClass('active').addClass('inactive');
	  $(".id").removeClass('active1').addClass('inactive1');
	  
	$.ajax({
      type: "POST",
      url: "filtertest.php",
      data: { gender : gender },
      success: function (data) {
      $('#scripts').html(data);
      }
      });
 	});  
}); 
 	 		
 	 		
	$(function() {  
 	 $("div.home #region").change(function() {  
	var region =  $("#region").val();
	   	  $(".participant_front_page").removeClass('active').addClass('inactive');
	  $(".id").removeClass('active1').addClass('inactive1');
	  
	$.ajax({
      type: "POST",
      url: "filtertest.php",
      data: { province : region },
      success: function (data) {
      $('#scripts').html(data);
      }
      });
 	 });  
}); 

 	 		
	$(function() {  
 	 $("div.home #generation").change(function() {  
	var generation =  $("#generation").val();
	$(".participant_front_page").removeClass('active').addClass('inactive');
	  $(".id").removeClass('active1').addClass('inactive1');
	  
	$.ajax({
      type: "POST",
      url: "filtertest.php",
      data: { generation : generation },
      success: function (data) {
      $('#scripts').html(data);
      }
      });
 	 });  
}); 
 	 		
 	 		 	 		 	 		
	$(function() {  
 	 $("div.home #themes").change(function() {  
	var themes =  $("#themes").val();
	$(".participant_front_page").removeClass('active').addClass('inactive');
	  $(".id").removeClass('active1').addClass('inactive1');
	  
	$.ajax({
      type: "POST",
      url: "filtertest.php",
      data: { themes : themes },
      success: function (data) {
      $('#scripts').html(data);
      }
      });
 	 });  
}); 




//// FILTERING FUNCTIONS FOR MAP


	$("div.map #language").change(function() {
	var language =  $("#language").val();

	$.ajax({
      type: "POST",
      url: "markercoordinates.php",
      dataType: "json",
      data: { participant_lang : language },
      success: function (data) {  
		//console.log(data);
         ShowMap();
        }
      });
    });  


	$("div.map #gender").change(function() {
	var gender =  $("#gender").val();

	$.ajax({
      type: "POST",
      url: "markercoordinates.php",
      dataType: "json",
      data: { gender : gender },
      success: function (data) {  
		//console.log(data);
        ShowMap();
       }
      });
    });  



	$("div.map #region").change(function() {
	var region =  $("#region").val();

	$.ajax({
      type: "POST",
      url: "markercoordinates.php",
      dataType: "json",
      data: { province : region },
      success: function (data) {  
		console.log(data);
         ShowMap();
      }
      });
    });  

	$("div.map #generation").change(function() {
	var generation =  $("#generation").val();

	$.ajax({
      type: "POST",
      url: "markercoordinates.php",
      dataType: "json",
      data: { generation : generation },
      success: function (data) {  
		console.log(data);
         ShowMap();
       }
      });
    });  
 

	$("div.map #themes").change(function() {
	var themes =  $("#themes").val();

	$.ajax({
      type: "POST",
      url: "markercoordinates.php",
      dataType: "json",
      data: { themes : themes },
      success: function (data) { 
    	console.log(data);
        ShowMap();
      }
      });
    });  







});