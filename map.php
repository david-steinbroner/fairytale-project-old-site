<?php require_once("includes/sessioninfo.php");?>

<!DOCTYPE html>

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>  童话项目 | Fairytale Project | Fairytale-Projekt</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="<?php echo meta_tags(description);?>" />
        <meta name="keywords" content="<?php echo meta_tags(keywords);?>" />
		<meta name="author" content="<?php echo meta_tags(author);?>" />
		<meta name="robots" CONTENT="noindex,nofollow">

<link rel="icon" type="image/gif" href="images/Fairytale_Favicon.png">

<!--CSS-->
<link rel="stylesheet" href="javascript/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="stylesheets/plusminus.css">
<!--[if IE 7]><link rel="stylesheet" href="stylesheets/plusminus-ie7.css"><![endif]-->
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />

<!-- google api -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?&amp;sensor=false"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
<script type="text/javascript" src="javascript/jquery.lazyload.js?v=4" charset="utf-8"></script>
<!--<script type="text/javascript" src="javascript/fancybox/source/jquery.fancybox.pack.js"></script> -->
 <!-- <script src="https://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript"></script> -->
<!-- custom infobox  -->
 <script src="javascript/infobox.js" type="text/javascript"></script>
 <script src="javascript/infobox_packed.js" type="text/javascript"></script>
 
<script type="text/javascript" src="javascript/fancybox/source/jquery.fancybox.js"></script>
<script src="javascript/bucket.js" type="text/javascript"></script>

 <!--JS-->

 <script type="text/javascript">

 var icon = new google.maps.MarkerImage("images/mapdot.png",
 new google.maps.Size(32, 32), new google.maps.Point(0, 0),
 new google.maps.Point(16, 32));
 var center = null;
 var map = null;
 var geocoder;
 
 var currentPopup;
 var bounds = new google.maps.LatLngBounds();
 
 	var newDate = new Date;				
	//var markerFile = 'markers.json';//?time=' + newDate.getTime();	
  var markerFile = "markercoordinates.php";
	// variable for marker info window
	var infowindow;
	var infobox; //custom infobox. 
	// List with all marker to check if exist
	var markerList = {};
	
	var LatLngList = []; //lat long list of all markers. 
	var markersArray = []; //holds all markers and used in clearing them. 
	
	// set error handler for jQuery AJAX requests
	$.ajaxSetup({"error":function(XMLHttpRequest,textStatus, errorThrown) {   
		alert(textStatus);
		alert(errorThrown);
		alert(XMLHttpRequest.responseText);
	}});
	
var UseInfowindow=false; 
 
 
 function ShowMap() {
    //alert ("Showmap");
     if(map){
       //alert ("MapUpdate");
         loadMarkers();
     }else
       initMap();
 };
// var centerLatLong = new google.maps.LatLng(26.099928, 119.296506); 

 
  function initMap() {
      //alert ("initmap");
      // Create an array of styles.
        var styles = [
          {
            stylers: [
              { hue: "#00ffe6" },
              { saturation: -20 }
            ]
          },{
            featureType: "road",
            elementType: "geometry",
            stylers: [
              { lightness: 100 },
              { visibility: "simplified" }
            ]
          },{
             featureType: "road",
            // elementType: "labels",
            stylers: [
              { visibility: "off" }
            ]
          }
        ];
   
      // Create a new StyledMapType object, passing it the array of styles,
       // as well as the name to be displayed on the map type control.
       var styledMap = new google.maps.StyledMapType(styles,
         {name: "Styled Map"});
        
     map = new google.maps.Map(document.getElementById("map"), {

      zoomControl:true,
      scaleControl: false, 
      disableDefaultUI: true,
      
      scrollwheel: true,
      disableDoubleClickZoom: true,
      panControl: false,
      
      mapTypeId: google.maps.MapTypeId.TERRAIN,
      mapTypeControl: false,
      mapTypeControlOptions: { style: google.maps.ZoomControlStyle.SMALL },
      navigationControl: false,
      navigationControlOptions: { style: google.maps.NavigationControlStyle.SMALL }
      });   
      
      // map.mapTypes.set('map_style', styledMap);
      // map.setMapTypeId('map_style');



/////////////////      
       var address = "china";
      geocoder = new google.maps.Geocoder();

      // var address = document.getElementById("address").value;
      geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {

 
        map.setCenter(results[0].geometry.location);
  
        // var marker = new google.maps.Marker({
        //                   map: map,
        //                   position: results[0].geometry.location
        //               });
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
      });
     // create new info window for marker detail pop-up
     if(UseInfowindow)
      infoWindow = new google.maps.InfoWindow();
  
      	// load markers
      loadMarkers();
      
 };
 
 // Removes the overlays from the map, but keeps them in the array
 function clearOverlays() {
   if (markersArray) {
     for (i in markersArray) {
       markersArray[i].setMap(null);
     }
   }
   //reset bounds
   bounds = new google.maps.LatLngBounds();
 }
 
 function deleteOverlays() {
   if (markersArray) {
     for (i in markersArray) {
       markersArray[i].setMap(null);
     }
     markersArray.length = 0;
   }
   //reset bounds
   bounds = new google.maps.LatLngBounds();
 }
 
 
 	/**
	 * Load markers via ajax request from server
	 */
function loadMarkers(){
 //WHAT DOES THIS DO? 
  //alert("loadMarkers");
  //clear map overlays
  clearOverlays();
   if(infobox)
    infobox.close();
    
    
  $.getJSON( markerFile, function(json) {
     //alert("json"); 
    // if(json.length==0){
    //  //            map.setZoom(8);
    //  //            map.setCenter(marker.getPosition());
    //  //           
    //  
    //  }
     for (var i = 0, length = json.length; i < length; i++) {
           var data = json[i];
           var latLng = new google.maps.LatLng(data.latitude, data.longitude); 
           bounds.extend(latLng);
            
           loadMarker(data);	
     } //end of for loop     
     google.maps.event.addListener(map, 'dblclick', function(e) {  
        //alert("dblclick");
        map.fitBounds (bounds);

      });
  });//end of getJSON function
}



function loadMarker(markerData){

	// create new marker location
	var latLng = new google.maps.LatLng(markerData.latitude,markerData.longitude);
 
	// create new marker
	var marker = new google.maps.Marker({
              position: latLng,
              map: map,
              icon: icon,
              name: name });
  //add markers to the array - used in clearing or potentilly in fading them. 
  markersArray.push(marker);
 
  // // add marker to list used later to get content and additional marker information
   markerList[marker.id] = marker;
  
  /* ADD POP UP */ 
  //  
  // // add event listener when marker is clicked
  // // currently the marker data contain a dataurl field this can of course be done different
  
   var LatLngList = new google.maps.LatLng (marker.position)
    //  Create a new viewpoint bound

    //  Go through each...
    bounds.extend (marker.position);
    center = bounds.getCenter();

    //  Fit these bounds to the map
    map.fitBounds (bounds);
  
    
    //////////////////////////
  google.maps.event.addListener(marker, 'click', function(e) {  
    /////////////////////// info box settings
       var icon = (markerData.icon);
       var name = (markerData.name);
       var idtag = (markerData.id);
       //      
       var html = "<a class='participant fancybox fancybox.iframe' href='#' id='"+idtag +"'><img src='"+icon +"' class='mappic'></a>";

       var boxText = document.createElement("div");
       	boxText.style.cssText = "border: 0px solid black; margin-top: 20px; background: white; padding: -10px; width:100%, height:100px text-align: center;";
       	boxText.innerHTML = html;

       if(UseInfowindow){
         
            //infoWindow.setOptions({maxWidth:50})        
            infoWindow.setContent(boxText);
            infoWindow.open(map, marker);

       }else{
        var infoboxOptions = {
           content: boxText
           ,disableAutoPan: false
           ,maxWidth: "100px"
           ,pixelOffset: new google.maps.Size(-70, -20)
           ,zIndex: null
           ,boxStyle: { 
           background: "url('tipbox.gif') no-repeat"
           ,opacity: 1
           ,width: "111px"
           }
           ,closeBoxMargin: "25px 4px 4px 4px"
           ,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
           ,infoBoxClearance: new google.maps.Size(1, 1)
           ,isHidden: false
           ,pane: "floatPane"
           ,enableEventPropagation: false             };

           if(infobox)
            infobox.close();
           
           infobox = new InfoBox(infoboxOptions);
           //
           
           infobox.open(map, marker);
             google.maps.event.addListenerOnce(infobox, 'domready', function(){
                   google.maps.event.addDomListener($(infobox.getContent()).find('.participant')[0], 'click', function(){
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

 
 
                   });
               });

     }
 
                      
  });  
  google.maps.event.addListener(marker, 'dblclick', function(e) {  
     // alert("dblclick");
     //    
     //    map.fitBounds (bounds);

   });
   
   
  ///////////////////////////// double click 
 
  
  /////////////////////////////
  // google.maps.event.addListener(map, 'center_changed', function() {
  //    // 3 seconds after the center of the map has changed, pan back to the
  //    // marker.
  //    window.setTimeout(function() {
  //      map.setZoom(5);
  //    }, 3000);
  //  });
  
  ////////////////////////////
     
    //
    
      
  
      google.maps.event.addDomListener(map, 'tilesloaded', function(){
         if($('#newPos').length==0){
                   $('div.gmnoprint').last().parent().wrap('<div id="newPos" />');
                   $('div.gmnoprint').fadeIn(500);
                  $('div#zoom').fadeOut(500);
               }
        
        //  Make an array of the LatLng's of the markers you want to show
       
        //map.fitBounds (bounds); 
        
    });
    // var setPos = function(){
    //     google.maps.event.trigger(map, 'tilesloaded');
    //     
    // };
    // window.setTimeout(setPos,0);
   ////////////////////////////
   
   
	// // GIVES ERROR                   
  // add event when marker window is closed to reset map location
     // google.maps.event.addListener(infowindow,'closeclick', function() {
     //    map.setCenter(defaultLatlng);
     //    map.setZoom(defaultZoom); 
     //  });  //end of event
};


 </script>



</head> 

 <body onload="ShowMap()" style="margin:0px; border:0px; padding:0px;">
 <div id="map"></div>
 
 
<div id="main">
<div class="map">
<?php include_once("includes/menu.php"); ?> </div>

<?php require("includes/footer.php") ?>
