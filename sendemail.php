<?php
$email=$_POST['email'];
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
    $code=hash("sha256",rand(1,2000).$username.$password);
    $to      =$email; 
$subject = 'Verify Email'; 
$message = "
Greetings From Meow Bot,

Thank you, for signing up on Helpo.
We don't have a functioning team and the developer alone and lonely cannot handle such a big infrastructure himself. 
So, I help him.





Verify email for user ".$username." by clicking the link below:

http://helpo.oromap.in/verifyemail.php?meow=".$code."";                   
$headers = 'From:meow@helpo.oromap.in' . "\r\n";
mail($to, $subject, $message, $headers);
$con->query("INSERT INTO verifytable(username,code) VALUES('".$username."','".$code."')");
echo '200';
    }
    else
    {
        echo '400';
    }
}
?>