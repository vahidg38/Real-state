<?php  
session_start();
if(isset($_SESSION['sess_name'])) {
$name=$_SESSION['sess_name'];
$tel=$_SESSION['sess_tel'];
$family=$_SESSION['sess_family'];
$password=$_SESSION['sess_password'];
}
$locality=$_SESSION['sess_locality'];

       $con=mysql_connect('localhost','root','') or die(mysql_error());
        mysql_select_db('User') or die("cannot select DB");
        
        
     
 $sql = "select * from house where locality='$locality' ";

$information = array();
$items = array();

$result=mysql_query($sql);
$numrows=mysql_num_rows($result);
if ($numrows==0) {
  echo " nothing found!";
  exit;
}
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

  $items[] = array('id'=> $id, 'title'=> $title,'price'=> $price,'type'=> $type, 'area'=> $area,'bedrooms'=> $bedrooms,'parkings'=> $parkings, 'locality'=> $locality,'pic'=> $pic,'estate'=> $estate, 'star'=> $star,'created_at'=> $created_at);
} 

$information['items'] = $items;

$fp = fopen('information.json', 'w');
fwrite($fp, json_encode($information));
fclose($fp);


?>
 <?php 
 if(isset($_POST["submit"])){
    $_SESSION['sess_houseid']=$_POST['submit'];
      header("Location: case.php");
            
      


 }


  ?>

<!DOCTYPE html>
<html>

<head>

	<title>نتایج جستجو</title>
	
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

 

 	$.getJSON( "information.json", function( data ) { 
  
  

 $("h2").text("نتایج جستجو");



 for (i=0;i<data.items.length;i++){

  
 var t1='<div id=" '+data.items[i].id+' "><form method="post"><button type="submit" name="submit" value="'+data.items[i].id+'" style="text-decoration:none; color:black;" href="case.html" class=" window col-md-3 "  >   <div><img  src=" '+data.items[i].pic+'"> </div><div > <img class="bookmark '+i+40+'" src="bookmarkoff.png"></div> <div > <img class="star '+i+'" src="star.png"></div>     <div class="bottom-right">'+data.items[i].locality+'<br/>'+data.items[i].title+'</div>      <div style="text-align: center; position:relative; bottom:33px;"> شرایط: <span style="color:blue;"> '+tstamp(data.items[i].created_at)+'</span>    <span>'+data.items[i].bedrooms+' خوابه</span> <span>'+data.items[i].area+'متر</span> <span>'+data.items[i].type+'</span> </div>          <div style="display:block; float:right;"> <label  style=" margin-right: 10px"> قیمت :'+Math.floor(data.items[i].price/1000000000)+'میلیارد تومان </label></div>    <div style="display:block; float:right; clear:right;"> <label  style="margin-left: 10px;">متر مربع :'+Math.floor(data.items[i].price/data.items[i].area/1000000)+'میلیون تومان</label></div> <div > <img class="logo" src=" '+data.items[i].pic+' "><p style="margin-left:2px;"> '+data.items[i].estate+'</p></div>        </button></form> </div>';

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
<br><br>
  <a    href="kilid.php"  >باز گشت </a>
</body>
