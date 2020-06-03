<?php
$meow=$_GET['meow'];
$con = new mysqli("fdb17.awardspace.net","2458395_datax","Dakota101","2458395_datax");
if($con->connect_error)
{
    echo 'db_error_443';
}
else{
    $res=$con->query("SELECT username FROM verifytable WHERE code='".$meow."'");
    $row=$res->fetch_assoc();
    if(strcmp($row['username'],"")==0)
    {
    echo "Ooops.....Link expired.";
    }
    else
    {
    $con->query("UPDATE people SET verified='1' WHERE username='".$row['username']."'");
    $con->query("DELETE FROM verifytable WHERE username='".$row['username']."'");
    echo "Email successfully verified. ";
    }
}
?>