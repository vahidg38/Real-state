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
  echo "ایجاد کننده تبلیغ توسط مدیر حذف شده است	";
  exit;
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
  echo "عکسی برای این مورد ثبت نشده	";
  exit;
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

  <?php /*
 if(isset($_POST["submit"])){
    $_SESSION['sess_houseid']=$_POST['submit'];
      header("Location: case.php");
            
      


 }
*/

  ?>

<!DOCTYPE html>
<html>

<head>

	<title>مشخصات خانه</title>
	
	<link rel="shortcut icon" href="shortcut.png" />
  <link rel="stylesheet" type="text/css" href="style3.css">
 
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script>
$(document).ready(function(){

		$.getJSON( "users.json", function( data ) { 
  
  for (i=0;i<data.items.length;i++){ // i=0!!!

  
 var t1='<li><form   method="post"><br><label>'+data.items[i].family+'-</label><label>'+data.items[i].name+':</label><button value=" '+data.items[i].Personid+' " type="submit" name="submit1">حذف کاربر</button><button value="'+data.items[i].Personid+'" type="submit" name="submit2" formmethod="post">ارتقا به مدیر</button></form></li><br><br>';

 $(".users").append(t1);



  }

 
 
});

				$.getJSON( "images.json", function( data ) { 
  
  for (i=0;i<data.items.length;i++){ // i=0!!!

  
 var t1='<li><img style="width:50%;" src="'+data.items[i].houseid+'/'+data.items[i].images+' "></img></li><br><br>';

 $("body").append(t1);



  }

 
 
});




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
  
  

 $("h2").text("مشخصات خانه");

   


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

<ul class="users" style="list-style-type:none;"></ul>
<ul class="moreimages" style="list-style-type:none;"></ul>

<div class="row">
  <div class="col-md-16">

    <div id="mdb-lightbox-ui"></div>

    <div class="mdb-lightbox">

      

      

    </div>

  </div>
</div>
<br><br>
  <a    href="kilid.php"  >باز گشت به صفحه اصلی </a>

</body>
