<?php
$name=$_POST['name'];
$password = $_POST['password'];
$username = $_POST['username'];
$verified = $_POST['verified'];
$password = hash('sha256',$password);
$con = new mysqli("fdb17.awardspace.net","2458395_datax","Dakota101","2458395_datax");
if($con->connect_error)
{
    echo 'db_error_443';
}
else{
    $con -> query("INSERT INTO people(name,password,username,verified) VALUES('".$name."','".$password."','".$username."','".$verified."')");
    echo '200';
}
?>