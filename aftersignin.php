<?php
$password = $_POST['password'];
$username = $_POST['username'];
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
            echo '{
                "name" : "'.$row['name'].'",
                "verified" : "'.$row['verified'].'"
            }';
        }
        else
        {
            echo '400';
        }
  
}
?>