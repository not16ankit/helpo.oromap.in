<?php
$query = $_POST['query'];
$con = new mysqli("fdb17.awardspace.net","2458395_datax","Dakota101","2458395_datax");
if($con->connect_error)
{
    echo 'db_error_443';
}
else{
    $res=$con -> query("SELECT name FROM people WHERE username='".$query."'");
    $row=$res->fetch_assoc();
    if(strcmp($row['name'],"")==0)
    {
    echo 'yes';
    }
    else
    {
    echo 'no';
    }
}
?>
