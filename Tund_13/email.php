<?php
$to = "gasparl@tlu.ee";
$subject = "selline katseline teade";
$message = "Tervitusi teisest serverist!";
$headers = "From: gasplui@greeny.cs.tlu.ee" . "\r\n" .
"CC: luik.gaspar@gmail.com";
if(mail($to,$subject,$message,$headers)){
	echo "Läks hästi!";
} else {
	echo "Ei läinud hästi!";
}
echo "Tehtud?!";