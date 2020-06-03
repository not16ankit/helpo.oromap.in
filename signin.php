<?php
$type=$_POST['type'];
$password = $_POST['password'];
$username = $_POST['username'];
$password = hash('sha256',$password);
$con = new mysqli("fdb17.awardspace.net","2458395_datax","Dakota101","2458395_datax");
if($con->connect_error)
{
    echo 'db_error_443';
}
else{
    if($type==0)
    {
        $res=$con->query("SELECT * FROM people WHERE username='".$username."'");
        $row=$res->fetch_assoc();
        if(strcmp($row['password'],$password)==0)
        {
            echo '200';
        }
        else
        {
            echo '400';
        }
    }
    if($type==1)
    {
    $name=$_POST['name'];
        $res=$con->query("SELECT * FROM people WHERE username='".$username."'");
        $row=$res->fetch_assoc();
        if(strcmp($row['password'],'')==0)
        {
            $con->query("INSERT INTO people(username,password,name,verified) VALUES('".$username."','".$password."','".$name."','1')");
            echo '200';
        }
        else{
            $res=$con->query("SELECT * FROM people WHERE username='".$username."'");
        $row=$res->fetch_assoc();
        if(strcmp($row['password'],$password)==0)
        {
            echo '200';
        }
        else
        {
            echo '400';
        }
        }
    }
}
?>