<?php
date_default_timezone_set('Asia/Calcutta'); 
$info = getdate();
$date = $info['mday'];
$month = $info['mon'];
$year = $info['year'];
$hour = $info['hours'];
$min = $info['minutes'];
$sec = $info['seconds'];
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
        $num=fread(fopen("helpcount.txt","r"),filesize("helpcount.txt"))+1;
        $GLOBALS['json']=$GLOBALS['json']."{";
        $u=1;
        for($i=1;$i<=$num;$i++)
        {
            $res=$con->query("SELECT * FROM help WHERE id='".$i."'");
            $row=$res->fetch_assoc();
            if($row['activation']==1)
            {
                if(($hour*60+$min)-$row['time']<60)
                {
                    $GLOBALS['json']=$GLOBALS['json']."'help".$u."des':'".$row['description']."',
                            'help".$u."user' : '".$row['user']."',
                            'help".$u."lat' : '".$row['lat']."',
                            'help".$u."long' : '".$row['longi']."',
                            'help".$u."name' : '".$row['name']."',
                            'help".$u."view' : '".$row['views']."',
                            ";
                            $u=$u+1;        
                }
                else{
                    if($row['date']!=$date)
                    {
                        $t = (60-$row['time']-(23*60))+($hour*60)+$min;
                        if($t<60)
                        {
                            $GLOBALS['json']=$GLOBALS['json']."'help".$u."des':'".$row['description']."',
                            'help".$u."user' : '".$row['user']."',
                            'help".$u."lat' : '".$row['lat']."',
                            'help".$u."long' : '".$row['longi']."',
                            'help".$u."name' : '".$row['name']."',
                            'help".$u."view' : '".$row['views']."',
                            ";
                            $u=$u+1;
                        }
                        else{
                            $con->query("UPDATE helps SET activation='0' WHERE id='".$i."'");
                        }
                    }
                    else{
                    $con->query("UPDATE help SET activation='0' WHERE id='".$i."'");
                    }
                }
            }
        }
        $GLOBALS['json']=$GLOBALS['json']."'helpcount':'".($u-1)."'}";
        echo $GLOBALS['json'];
    }
    else
    {
        echo '400';
    }
}
?>