<?php
date_default_timezone_set('Asia/Calcutta');
$info = getdate();
$date = $info['mday'];
$month = $info['mon'];
$year = $info['year'];
$hour = $info['hours'];
$min = $info['minutes'];
$sec = $info['seconds'];
$description=$_POST['description'];
$password = $_POST['password'];
$username = $_POST['username'];
$lat=$_POST['lat'];
$long=$_POST['long'];
$name=$_POST['name'];
$password = hash('sha256',$password);
$con = new mysqli("fdb17.awardspace.net","2458395_datax","Dakota101","2458395_datax");
if($con->connect_error)
{
    echo 'db_error_443';
}
else{
    $res=$con->query("SELECT * FROM people WHERE username='".$username."'");
    $row=$res->fetch_assoc();
    if(strcmp($row['password'],$password)==0)
    {
    
        $num=fread(fopen("helpcount.txt","r"),filesize("helpcount.txt"))+1;
        $res=$con->query("INSERT INTO help(id,description,user,activation,time,date,lat,longi,name) VALUES('".$num."','".$description."','".$username."','1','".($hour*60+$min)."','".$date."','".$lat."','".$long."','".$name."')");
        $file=fopen("helpcount.txt","w");
        fwrite($file,$num);
        fclose($file);
        echo '200';
    }
    else
    {
        echo '400';
    }
}
?>