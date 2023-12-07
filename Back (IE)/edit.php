<?php  
session_start();
$name=$_SESSION['sess_name'];
$tel=$_SESSION['sess_tel'];
$family=$_SESSION['sess_family'];
$password=$_SESSION['sess_password'];


       $con=mysql_connect('localhost','root','') or die(mysql_error());
        mysql_select_db('User') or die("cannot select DB");
        
        
     
 $sql = "select * from house  WHERE creator='$password' ";

$information = array();
$items = array();

$result=mysql_query($sql);
$numrows=mysql_num_rows($result);
if ($numrows==0) {
  echo "you have no house";
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
      header("Location: editform.php");
            
      


 }


  ?>

<!DOCTYPE html>
<html>

<head>

  <title>خانه های من</title>
  
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
  var tt;
  tt= Math.floor(Date.now() / 1000)- Number(t);
      y= Math.floor(tt/(24*60*60*365));
    m=Math.floor(tt/(24*60*60*30));
    d=Math.floor(tt/(24*60*60));
    h=Math.floor(tt/(60*60));
    mi=Math.floor(tt/(60));
    
    
    if(y>0) r= y+ "سال پیش";
    else if (m>0) r= m+ "ماه پیش";
    else if (d>0) r=d+ "روز پیش";
    else if(h>0) r= h+ "ساعت پیش";
    else if(mi>0)r= mi+"دقیقه پیش";
    else r=tt+"ثانیه پیش";
    

     return r;

 }

 

  $.getJSON( "information.json", function( data ) { 
  
  

 $("h2").text("خانه های من");



 for (i=0;i<data.items.length;i++){

  
  var t1='<div id=" '+data.items[i].id+' "><form method="post"><button type="submit" name="submit" value="'+data.items[i].id+'" style="text-decoration:none; color:black;" href="case.php" class=" window col-md-3 "  >   <div><img  src=" '+data.items[i].pic+'"> </div><div > <img class="bookmark '+i+40+'" src="bookmarkoff.png"></div> <div > <img class="star '+i+'" src="star.png"></div>     <div class="bottom-right">'+data.items[i].locality+'<br/>'+data.items[i].title+'</div>      <div style="text-align: center; position:relative; bottom:33px;"> شرایط: <span style="color:blue;"> '+tstamp(data.items[i].created_at)+'</span>    <span>'+data.items[i].bedrooms+' خوابه</span> <span>'+data.items[i].area+'متر</span> <span>'+data.items[i].type+'</span> </div>          <div style="display:block; float:right;"> <label  style=" margin-right: 10px"> قیمت :'+Math.floor(data.items[i].price/1000000)+'میلیون تومان </label></div>    <div style="display:block; float:right; clear:right;"> <label  style="margin-left: 10px;">متر مربع :'+Math.floor(data.items[i].price/data.items[i].area/1000000)+'میلیون تومان</label></div> <div > <img class="logo" src=" '+data.items[i].pic+' "><p style="margin-left:2px;"> '+data.items[i].estate+'</p></div>        </button></form> </div>';

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
   <div id="snackbar">برای ویرایش هر خانه روی آن کلیک کنید</div>
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
  <script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 8000);

</script>
</body>
