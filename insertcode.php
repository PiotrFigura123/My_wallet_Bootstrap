<?php

$polaczenie1 = new mysqli($host,$db_user,$db_password,$db_name);

if(isset($_POST['saveOutcome']))
{
    $vOutcome=$_POST['vOutcome'];
    $dOutcome=$_POST['dOutcome'];
    $gridRadios=$_POST['gridRadios'];
    $gridRadios1=$_POST['gridRadios1'];

    $query = "INSERT INTO bilans VALUES(NULL,,$vOutcome,'$dOutcome','','$gridRadios','$gridRadios1','')";
    $query_run=mysqli($polaczenie1,$query);
    if($query_run)
        echo 'udany zapis';
    else
    echo 'lipa';
}
?>