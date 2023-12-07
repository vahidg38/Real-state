<!DOCTYPE html>
<html>

<head>

	<title>خرید</title>
	
	<link rel="shortcut icon" href="shortcut.png" />
  <link rel="stylesheet" type="text/css" href="style3.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script>
$(document).ready(function(){
var more;
 function tstamp( t){
    y= Math.floor(t/(24*60*60*365));
    m=Math.floor(t/(24*60*60*30));
    d=Math.floor(t/(24*60*60));
   
    if (d>0) r=d+ "روز پیش";
    if (m>0) r= m+ "ماه پیش";
    if(y>0) r= y+ "سال پیش";

     return r;

 }

 

 	$.getJSON( "http://hallows.ir/occasion", function( data ) { 
  
  
  $.each( data.action, function( key, val ) {
  	if (key=="text") {
  	 $("button").text(val);
  	}
    if (key=="url") {
     more=val;
    }
  
  });

 $("h2").text(data.section);



 for (i=0;i<data.items.length;i++){

  
 var t1='<div id=" '+data.items[i].id+' "><a  style="text-decoration:none; color:black;" href="case.html" class=" window col-md-3 "  >   <div><img  src=" '+data.items[i].pic.image+'"> </div><div > <img class="bookmark '+i+40+'" src="bookmarkoff.png"></div> <div > <img class="star '+i+'" src="star.png"></div>     <div class="bottom-right">'+data.items[i].location.locality+'<br/>'+data.items[i].title+'</div>      <div style="text-align: center; position:relative; bottom:33px;"> شرایط: <span style="color:blue;"> '+tstamp(data.items[i].created_at)+'</span>    <span>'+data.items[i].bedrooms+' خوابه</span> <span>'+data.items[i].area+'متر</span> <span>'+data.items[i].type+'</span> </div>          <div style="display:block; float:right;"> <label  style=" margin-right: 10px"> قیمت :'+Math.floor(data.items[i].price/1000000000)+'میلیارد تومان </label></div>    <div style="display:block; float:right; clear:right;"> <label  style="margin-left: 10px;">متر مربع :'+Math.floor(data.items[i].price/data.items[i].area/1000000)+'میلیون تومان</label></div> <div > <img class="logo" src=" '+data.items[i].estate.logo+' "><p style="margin-left:2px;"> '+data.items[i].estate.name+'</p></div>        </a> </div>';

 $(".mdb-lightbox").append(t1);


if (data.items[i].star==false) { $("."+i).hide();}
if (data.items[i].bookmarked==true) { $("."+i+40).attr("src","bookmarkon.png");}

$( "."+i+40 ).mouseenter(function() {
  $( this ).attr("src","bookmarkon.png"  );
 
});

$( "."+i+40 ).mouseleave(function() {
  $( this ).attr("src","bookmarkoff.png"  );
 
});
  }
 
});
$("button").click( function (){
    $.getJSON( more, function( data ) {
for (i=0;i<data.items.length;i++){
  
 var t1='<div id=" '+data.items[i].id+' "><a  style="text-decoration:none; color:black; "href="case.html" class=" window col-md-3 "   > <div><img  src=" '+data.items[i].pic.image+'"> </div><div > <img class="bookmark '+i+40+'" src="bookmarkoff.png"></div> <div > <img class="star '+i+'" src="star.png"></div>     <div class="bottom-right">'+data.items[i].location.locality+'<br/>'+data.items[i].title+'</div>      <div style="text-align: center; position:relative; bottom:33px;"> شرایط: <span style="color:blue;"> '+tstamp(data.items[i].created_at)+'</span>    <span>'+data.items[i].bedrooms+' خوابه</span> <span>'+data.items[i].area+'متر</span> <span>'+data.items[i].type+'</span> </div>           <div style="display:block; float:right;"> <label  style=" margin-right: 10px"> قیمت :'+Math.floor(data.items[i].price/1000000000)+'میلیارد تومان </label></div>    <div style="display:block; float:right; clear:right;"> <label  style="margin-left: 10px;">متر مربع :'+Math.floor(data.items[i].price/data.items[i].area/1000000)+'میلیون تومان</label></div> <div > <img class="logo" src=" '+data.items[i].estate.logo+' "><p style="margin-left:2px;"> '+data.items[i].estate.name+'</p></div>         </a></div>';

 $(".mdb-lightbox").append(t1);


if (data.items[i].star==false) { $("."+i).hide();}
if (data.items[i].bookmarked==true) { $("."+i+40).attr("src","bookmarkon.png");}

$( "."+i+40 ).mouseenter(function() {
  $( this ).attr("src","bookmarkon.png"  );
 
});

$( "."+i+40 ).mouseleave(function() {
  $( this ).attr("src","bookmarkoff.png"  );
 
});
  }

    });

    $("button").hide();
 	
});


  
});
</script>

</head>


<body>
 <h2  style="color:rgb(179,7,83);position: relative; text-align: center; font-family: b nazanin; font-weight: bold;"></h2>



<div class="row">
  <div class="col-md-16">

    <div id="mdb-lightbox-ui"></div>

    <div class="mdb-lightbox">

      

      

    </div>

  </div>
</div>

  <button class="get" action=""  > </button>
</body>
