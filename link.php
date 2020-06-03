<?php
$id=$_POST['id'];
$password = $_POST['password'];
$username = $_POST['username'];
$type=$_POST['type'];
$password=hash('sha256',$password);
$con = new mysqli("","","","");
if($con->connect_error)
{
    echo 'db_error_443';
}
else{
    $res=$con->query("SELECT * FROM people WHERE username='".$username."'");
    $row=$res->fetch_assoc();
    if(strcmp($row['passowrd'],$password)==0)
    {
        $con -> query("UPDATE people SET '".$type."'='".$id."' WHERE username='".$username."'");
        echo '200';
    }
    else
    {
        echo '400';
    }
}
?>