<?php
$password = $_POST['description'];
$username = $_POST['username'];
$con = new mysqli("fdb17.awardspace.net","2458395_datax","Dakota101","2458395_datax");
if($con->connect_error)
{
    echo 'db_error_443';
}
else{
    $res=$con->query("SELECT views FROM help WHERE user='".$username."' AND description='".$password."'");
    $row=$res->fetch_assoc();
    $iniviews=$row['views'];
    $views=$iniviews+1;
    $con->query("UPDATE help SET views='".$views."' WHERE user='".$username."' AND description='".$password."'");
}
?>