<?php  
session_start();
if(isset($_SESSION['sess_name'])) {
$name=$_SESSION['sess_name'];
$tel=$_SESSION['sess_tel'];
$family=$_SESSION['sess_family'];
$password=$_SESSION['sess_password'];
                                }
$houseid= $_SESSION['sess_houseid'];   
                            

       $con=mysql_connect('localhost','root','') or die(mysql_error());
        mysql_select_db('User') or die("cannot select DB");
           
        
     
 $sql = "select * from house where id='$houseid' ";

$information = array();
$items = array();

$result=mysql_query($sql);
$numrows=mysql_num_rows($result);
if ($numrows==0) {
  echo " no house";
  exit;
}
$creator;
while($row=mysql_fetch_array($result)) { 
  $id=$row['id'];
  $title=$row['title']; 
  $price=$row['price'];
  $type=$row['type'];
  $area=$row['area'];
  $bedrooms=$row['bedrooms'];
  $parkings=$row['parkings'];
  $locality=$row['locality'];
  $pic=$row['pic'];
  $estate=$row['estate'] ;
  $star=$row['star'];
  $created_at=$row['created_at']; 
  $creator=$row['creator'];
  $items[] = array('id'=> $id, 'title'=> $title,'price'=> $price,'type'=> $type, 'area'=> $area,'bedrooms'=> $bedrooms,'parkings'=> $parkings, 'locality'=> $locality,'pic'=> $pic,'estate'=> $estate, 'star'=> $star,'created_at'=> $created_at);
} 

$information['items'] = $items;

$fp = fopen('information.json', 'w');
fwrite($fp, json_encode($information));
fclose($fp);


?>
<?php 

$sql1 = "select * from logins  WHERE  password='$creator' ";

$information1 = array();
$items1 = array();

$result1=mysql_query($sql1);
$numrows1=mysql_num_rows($result1);
if ($numrows1==0) {
  echo "ایجاد کننده تبلیغ توسط مدیر حذف شده است یا پسورد خود را تغییر داده است	 لذا شماره تماس و نام ایجادکننده معتبر نیست";
  //exit;
}
while($row=mysql_fetch_array($result1)) { 
  $rPersonid=$row['Personid'];
  $rname=$row['name']; 
  $rfamily=$row['family'];
  $rtel=$row['tel'];
  $remail=$row['email'];
  

  $items1[] = array('Personid'=> $rPersonid, 'name'=> $rname,'family'=> $rfamily,'tel' =>$rtel,'email' =>$remail );
} 

$information1['items'] = $items1;

$fp = fopen('users.json', 'w');
fwrite($fp, json_encode($information1));
fclose($fp);




?>

<?php 

$sql2 = "select * from images  WHERE  id='$houseid' ";

$information2 = array();
$items2 = array();

$result2=mysql_query($sql2);
$numrows2=mysql_num_rows($result2);
if ($numrows2==0) {
  //echo "عکسی برای این مورد ثبت نشده	";
  //exit;
}
while($row=mysql_fetch_array($result2)) { 
	
  $rimages=$row['imagename'];
  $rhouseid=$row['id'];
  
  

  $items2[] = array('images'=> $rimages ,'houseid' =>$rhouseid );
} 

$information2['items'] = $items2;

$fp = fopen('images.json', 'w');
fwrite($fp, json_encode($information2));
fclose($fp);




?>
<?php 

$sql2 = "select * from comment  WHERE  houseid='$houseid' ";

$information2 = array();
$items2 = array();

$result2=mysql_query($sql2);
$numrows2=mysql_num_rows($result2);
if ($numrows2==0) {
 // echo "ایجاد کننده تبلیغ توسط مدیر حذف شده است ";
 // exit;
}
while($row=mysql_fetch_array($result2)) { 
  $rcomm=$row['usercomment'];
  $rhouse=$row['houseid']; 
  $rtime=$row['ctime'];
 
  

  $items2[] = array('comm'=> $rcomm, 'houseid'=> $rhouse,'time'=> $rtime );
} 

$information2['items'] = $items2;

$fp = fopen('comments.json', 'w');
fwrite($fp, json_encode($information2));
fclose($fp);




?>


  <?php 
 if(isset($_POST["submit"])){
    $comm=$_POST['comment'];
     $time=time();
       $sql="INSERT INTO comment(usercomment,houseid,ctime) VALUES('$comm','$houseid','$time')";
         $result=mysql_query($sql);

         if($result){
                echo "نظر شما ثبت شد";
            } else {
                echo " نظر شما ثبت نشد";
            }

            
      


 }


  ?>


<!DOCTYPE html>
<html>
<head>
	 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>مشخصات خانه</title>
  
<meta name="viewport" content="width=device-width, initial-scale=1">


<style>
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>

<style>
* {
  box-sizing: border-box;
}

/* Add a gray background color with some padding */
body {
  font-family: Arial;
  padding: 20px;
  background: #f1f1f1;
}
*{
	font-family: b nazanin;
}
/* Header/Blog Title */
.header {
  padding: 30px;
  font-size: 40px;
  text-align: center;
  background: white;
}

/* Create two unequal columns that floats next to each other */
/* Left column */
.leftcolumn {   
  float: left;
  width: 75%;
}

/* Right column */
.rightcolumn {
  float: left;
  width: 25%;
  padding-left: 20px;
}

/* Fake image */
.fakeimg {
  background-color: #aaa;
  width: 100%;
  padding: 20px;
}

/* Add a card effect for articles */
.card {
   background-color: white;
   padding: 20px;
   margin-top: 20px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Footer */
.footer {
  padding: 20px;
  text-align: center;
  background: #ddd;
  margin-top: 20px;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
  .leftcolumn, .rightcolumn {   
    width: 100%;
    padding: 0;
  }
}
</style>

<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: Arial;
}

/* The grid: Four equal columns that floats next to each other */
.column {
  float: left;
  width: 25%;
  padding: 10px;
}

/* Style the images inside the grid */
.column img {
  opacity: 0.8; 
  cursor: pointer; 
}

.column img:hover {
  opacity: 1;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* The expanding image container */
.container {
  position: relative;
 
}

/* Expanding image text */
#imgtext {
  position: absolute;
  bottom: 15px;
  left: 15px;
  color: white;
  font-size: 20px;
}

/* Closable button inside the expanded image */
.closebtn {
  position: absolute;
  top: 10px;
  right: 15px;
  color: white;
  font-size: 35px;
  cursor: pointer;
}
</style>

	<script>
$(document).ready(function(){

		$.getJSON( "users.json", function( data ) { 
  
  //or (i=0;i<data.items.length;i++){ // i=0!!!

 var n0="09"; 
$("#creatorname").html(data.items[0].name);
var tell=data.items[0].tel+"";

var n1 = tell.substr(0, 2);
var n2 ="xxxx";
var n3 = tell.substr(7, 9);
$("#creatortel").html(n0+n1+n2+n3);

$("#creatortel").click(function(){
$("#creatortel").html(n0+data.items[0].tel);

}
);

 
 
});

				$.getJSON( "images.json", function( data ) { 
  
  for (i=0;i<data.items.length;i++){ // i=0!!!

 // var s='<div class="mySlides " >  <div class="numbertext">+'i+1'+ / +'data.items.length'+</div> <img  src="'+data.items[i].houseid+'/'+data.items[i].images+' "style="width:100%;height:400px;"></div>';
   var t1='<div class="mySlides" style="display:none;"><img style="width:100%;height:400px;" src="'+data.items[i].houseid+'/'+data.items[i].images+' "></div>';

 $(".slideshow-container").append(t1);
  }



 
 
});




var more;
 function tstamp( t){
  var tt;
  tt= Math.floor(Date.now() / 1000)- Number(t);
      y= Math.floor(tt/(24*60*60*365));
    m=Math.floor(tt/(24*60*60*30));
    d=Math.floor(tt/(24*60*60));
    h=Math.floor(tt/(60*60));
    mi=Math.floor(tt/(60));
    sec=Math.floor(tt/(60));
    
    
    if(y>0) r= y+ "سال پیش";
    else if (m>0) r= m+ "ماه پیش";
    else if (d>0) r=d+ "روز پیش";
    else if(h>0) r= h+ "ساعت پیش";
    else if(mi>0)r= mi+"دقیقه پیش";
    else r=tt+"ثانیه پیش";  
    

     return r;

 }

 

 	$.getJSON( "information.json", function( data ) { 
  
  

$("#hid").html(data.items[0].id);
$("#htime").html(tstamp(data.items[0].created_at));
$("#htitle").html(data.items[0].title);
$("#htitle2").html(data.items[0].title);
$("#hprice1").html(Math.floor(data.items[0].price/1000000)+'<b>ملیون تومان</b>');
$("#hprice2").html(Math.floor(data.items[0].price/data.items[0].area/1000000)+'<b>ملیون تومان</b>');
$("#htype").html(data.items[0].type);
$("#hbedrooms").html(data.items[0].bedrooms);
$("#hparkings").html(data.items[0].parkings);
$("#harea").html(data.items[0].area);
$("#hestate").html(data.items[0].estate);
$("#fimage").attr("src",data.items[0].pic);

   


 
});


$.getJSON( "comments.json", function( data ) { 
  
  for (i=0;i<data.items.length;i++){
var t1=' <p><span >'+data.items[i].comm+'</span><span  style="font-weight: bold;">'+tstamp(data.items[i].time)+'</span></p>';
$("#comm").append(t1);

}
 
});


  


  
});
</script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
#snackbar {
  visibility: hidden;
  font-family: b nazanin;
  min-width: 250px;
  margin-left: -125px;
  color: #c02a64;
  text-shadow: 2px 2px 4px #000000;
  background: white;
  text-align: center;
  border-radius: 12px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 40px;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;} 
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;} 
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
</style>

</head>
<body>
 <div id="snackbar">میتوانید در بخش ارسال نظرات نظر خود را ثبت نمایید</div>
<div class="header">
  <h2>مشخصات خانه</h2>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<div style="text-align:right;">
  <h2 id="htitle2">خرید خانه در صادقیه</h2>
 </div>






<div class="slideshow-container" style="width: 30%;height:5%;">

<div class="mySlides ">

 <img  id="fimage"  src="back.png" style="width:100%;height:400px;">

</div>



<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>



</div>


     
    
    <div style="text-align: right;" class="card">
      <h2 >ارسال نظرات</h2>
      <form method="post">
      	<textarea name="comment" rows="5" cols="40" required=""></textarea><br>
      	<input  style=" background-color: #4CAF50;  border: none;  color: white;  padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block;  font-size: 16px;
      	  margin: 4px 2px;
  cursor: pointer;" type="submit" name="submit" value="ثبت نظر">
      </form>
    

      
    </div>


  </div>
  <div class="rightcolumn">
    <div class="card">
    	<div> 
    		<span style="float: left;color: blue;" id="htime">ساعت پیش 4</span>	

      		<span style="float: right;">کد ملک : <span id="hid">2</span></span>
       </div>
      
      <hr>
      <div style="font-size: 20px;"><div style="float: right;font-weight: bold;font-size: 25px;" id="htitle">خرید آپارتمان در صادقیه</div><br><br>
      	<div style="float: right;clear: right;">قیمت: <span id="hprice1">2646</span></div>
      	<div style="float: right;clear: right;">قیمت هر متر مربع: <span id="hprice2">54</span></div>
      </div>
      <hr>
      
      	
<div style="height: 20%;width: 10%;" _ngcontent-c16="" class="flex-row al-center detail"><!----><!----><!---->

      	<span   _ngcontent-c16="" class="flex-row icon floor-area"><svg  _ngcontent-c16="" class="ng-tns-c16-4" viewBox="0 0 21.5 21.279" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c16="" class="ng-tns-c16-4" id="home" transform="translate(-2.65 -5.05)"><path _ngcontent-c16="" class="ng-tns-c16-4" d="M3.9,12.332,13.575,4.8l9.675,7.532" data-name="Path 3310" fill="none" id="Path_3310" stroke="#b8b8b8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(-0.175 1)"></path><line _ngcontent-c16="" class="ng-tns-c16-4" data-name="Line 255" fill="none" id="Line_255" stroke="#b8b8b8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(3.4 25.579)" x1="20"></line><line _ngcontent-c16="" class="ng-tns-c16-4" data-name="Line 256" fill="none" id="Line_256" stroke="#b8b8b8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(5.932 14.3)" y2="11.279"></line><line _ngcontent-c16="" class="ng-tns-c16-4" data-name="Line 257" fill="none" id="Line_257" stroke="#b8b8b8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(20.868 14.3)" y2="4.006"></line><line _ngcontent-c16="" class="ng-tns-c16-4" data-name="Line 258" fill="none" id="Line_258" stroke="#b8b8b8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(20.868 22.722)" y2="2.792"></line><path _ngcontent-c16="" class="ng-tns-c16-4" d="M30.6,29.449a.649.649,0,1,0-.649.649A.651.651,0,0,0,30.6,29.449Z" data-name="Path 3311" fill="#b8b8b8" fill-rule="evenodd" id="Path_3311" transform="translate(-9.082 -8.416)"></path><path _ngcontent-c16="" class="ng-tns-c16-4" d="M15.8,33.008V26.255a.444.444,0,0,1,.455-.455h2.922a.444.444,0,0,1,.455.455v6.688" data-name="Path 3312" fill="none" fill-rule="evenodd" id="Path_3312" stroke="#b8b8b8" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(-4.348 -7.364)"></path><path _ngcontent-c16="" class="ng-tns-c16-4" d="M16.06,17.6h3.377a.279.279,0,0,1,.26.26v2.013a.279.279,0,0,1-.26.26H16.06a.279.279,0,0,1-.26-.26V17.86A.279.279,0,0,1,16.06,17.6Z" data-name="Path 3313" fill="none" fill-rule="evenodd" id="Path_3313" stroke="#b8b8b8" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(-4.348 -4.488)"></path></g></svg></span>
    	
      	 
      </div>
    <div style="float: right;" id="htype">آپارتمان مسکونی</div><br>
     
  <div style="height: 20%;width: 10%;">    
  <span _ngcontent-c16="" class="flex-row icon floor-area">    <svg _ngcontent-c16="" class="ng-tns-c16-4" viewBox="0 0 23.224 18.948" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c16="" class="ng-tns-c16-4" data-name="Group 3245" id="Group_3245" transform="translate(-267.25 -470.802)"><path _ngcontent-c16="" class="ng-tns-c16-4" d="M55.6,351.424V344.6a.855.855,0,0,1,.828-.9H68.152m2.621,2.621v5.1" data-name="Path 3351" fill="none" id="Path_3351" stroke="#b8b8b8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(215.573 127.852)"></path><path _ngcontent-c16="" class="ng-tns-c16-4" d="M72.238,363.736H70.859c0-.483,0-2.966-.759-3.034-.345,0-4.552-.069-8.414-.069s-7.034,0-7.448.069c-.759.069-.759,2.552-.759,2.965H52.1v-6.828c0-.69,0-1.1.345-1.31,4.552-3.1,14.207-3.172,18.966-.207a1.59,1.59,0,0,1,.759,1.379v7.034Z" data-name="Path 3352" fill="none" fill-rule="evenodd" id="Path_3352" stroke="#b8b8b8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(216.659 124.919)"></path><line _ngcontent-c16="" class="ng-tns-c16-4" data-name="Line 271" fill="none" id="Line_271" stroke="#b8b8b8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(286.621 489)" x1="3.103"></line><line _ngcontent-c16="" class="ng-tns-c16-4" data-name="Line 272" fill="none" id="Line_272" stroke="#b8b8b8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(268 489)" x1="3.172"></line><path _ngcontent-c16="" class="ng-tns-c16-4" d="M59.7,352.055V350.4c0-1.1,1.172-2,2.621-2H66.8c1.448,0,2.621.9,2.621,2v1.655" data-name="Path 3353" fill="none" fill-rule="evenodd" id="Path_3353" stroke="#b8b8b8" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(214.3 126.393)"></path><path _ngcontent-c16="" class="ng-tns-c16-4" d="M78.017,343.659a.759.759,0,1,0-.759.759A.765.765,0,0,0,78.017,343.659Z" data-name="Path 3354" fill="#b8b8b8" fill-rule="evenodd" id="Path_3354" transform="translate(209.086 128.1)"></path></g></svg></span>
  	
</div>
<div style="float: right;"><span style="float: left;">خوابه</span><span style="float: left;" id="hbedrooms">2</span></div><br>
      	
<div style="height: 20%;width: 10%;"> 
<span _ngcontent-c16="" class="flex-row icon floor-area"><svg _ngcontent-c16="" class="ng-tns-c16-4" viewBox="0 0 22.5 22.317" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c16="" class="ng-tns-c16-4" data-name="Group 3246" id="Group_3246" transform="translate(-268.25 -503.25)"><path _ngcontent-c16="" class="ng-tns-c16-4" d="M25.517,10.108V8.247A1.518,1.518,0,0,0,23.954,6.8H9.363A1.516,1.516,0,0,0,7.8,8.247v14.54a1.518,1.518,0,0,0,1.563,1.447H23.954a1.516,1.516,0,0,0,1.563-1.447V16.708" data-name="Path 3343" fill="none" id="Path_3343" stroke="#b8b8b8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(262.899 498.567)"></path><ellipse _ngcontent-c16="" class="ng-tns-c16-4" cx="0.864" cy="0.864" data-name="Ellipse 86" fill="#b8b8b8" id="Ellipse_86" rx="0.864" ry="0.864" transform="translate(287.625 511.845)"></ellipse><path _ngcontent-c16="" class="ng-tns-c16-4" d="M8.015,8.931a2.015,2.015,0,0,0,0-4.031A2.06,2.06,0,0,0,6,6.915,2.012,2.012,0,0,0,8.015,8.931Z" data-name="Path 3344" fill="#fff" fill-rule="evenodd" id="Path_3344" stroke="#b8b8b8" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(263 499.1)"></path><path _ngcontent-c16="" class="ng-tns-c16-4" d="M8.015,33.631A2.015,2.015,0,1,0,6,31.615,2.06,2.06,0,0,0,8.015,33.631Z" data-name="Path 3345" fill="#fff" fill-rule="evenodd" id="Path_3345" stroke="#b8b8b8" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(263 491.186)"></path><path _ngcontent-c16="" class="ng-tns-c16-4" d="M30.215,33.631A2.015,2.015,0,1,0,28.2,31.615,2.06,2.06,0,0,0,30.215,33.631Z" data-name="Path 3346" fill="#fff" fill-rule="evenodd" id="Path_3346" stroke="#b8b8b8" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(257.769 491.186)"></path></g></svg></span>

</div>
<div style="float: right;"><span style="float: left;">متر</span><span style="float: left;" id="harea">25</span></div><br>
<div style="height: 20%;width: 10%;"> 
<span _ngcontent-c16="" class="flex-row icon parking"><svg _ngcontent-c16="" class="ng-tns-c16-4" viewBox="0 0 19.748 23.5" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c16="" class="ng-tns-c16-4" data-name="Group 3247" id="Group_3247" transform="translate(-269.25 -539.25)"><path _ngcontent-c16="" class="ng-tns-c16-4" d="M26.147,8.111V6.272A1.476,1.476,0,0,0,24.676,4.8H9.372A1.476,1.476,0,0,0,7.9,6.272V21.134a1.476,1.476,0,0,0,1.472,1.472H24.6a1.476,1.476,0,0,0,1.472-1.472V14" data-name="Path 3340" fill="none" id="Path_3340" stroke="#b8b8b8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(262.1 535.2)"></path><line _ngcontent-c16="" class="ng-tns-c16-4" data-name="Line 267" fill="none" id="Line_267" stroke="#b8b8b8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(270.147 562)" x1="17.88"></line><line _ngcontent-c16="" class="ng-tns-c16-4" data-name="Line 268" fill="none" id="Line_268" stroke="#b8b8b8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(279.124 558.174)" y1="2.134"></line><path _ngcontent-c16="" class="ng-tns-c16-4" d="M17.5,19.326V11.6h4.268a.817.817,0,0,1,.809.809v2.8a.817.817,0,0,1-.809.809H17.5" data-name="Path 3341" fill="none" id="Path_3341" stroke="#b8b8b8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="2.613" stroke-width="1.5" transform="translate(259.564 533.403)"></path><path _ngcontent-c16="" class="ng-tns-c16-4" d="M32.309,14.819a.809.809,0,1,0-.809-.809A.817.817,0,0,0,32.309,14.819Z" data-name="Path 3342" fill="#b8b8b8" fill-rule="evenodd" id="Path_3342" transform="translate(255.865 532.98)"></path></g></svg></span>
</div>
<div style="float: right;"><span style="float: left;">عدد</span><span style="float: left;" id="hparkings">2</span><span> پارکینگ</span></div><br>
     
    </div>
    <div style="background-color: white;" class="card">
     
      <div style="font-weight: bold;" ><img src="logo.png" style="border-radius:50px;width: 50px;height: 50px;"><div id="hestate">املاک امپراطور</div></div><br>
      <div> 
      	<div id="creatorname">آقای حمید</div>
<button id="creatortel"  style=" background-color: red;border-radius: 50px;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;"_ngcontent-c6="" class="flex-row al-center jus-center agency-info-button" data-track="{category: 'click', action: 'contact', value: 'leads'}"><!----><!----> 0919xxxx050 </button>

  </div>
      
    </div>
    <div style="text-align: right;" class="card" id="comm">
      <h3>نظرات</h3>
     
    </div>
  </div>
</div>

<div class="footer">
 <a href="kilid.php" style=" background-color: gray;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;">بازگشت به صفحه اصلی</a>
</div>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 8000);

</script>
</body>
<script>

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  
  slides[slideIndex-1].style.display = "block";  
 
}

</script>



</html>
