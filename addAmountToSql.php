<?php
session_start();

echo $_SESSION['user'];
echo $_SESSION['nazwisko'];
echo $_SESSION['Email'];
echo $_SESSION['idUser'];
$value=$_POST['incomeValue'];
$date=$_POST['incomeDate'];
$paymentMethod=$_POST['drone'];

echo $value;
echo $date;
echo $paymentMethod;

require_once("connect.php");
$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
try{
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno!=0)
  {
      throw new Exception(mysqli_connect_errno());
  }
  else
  {

  }

}
catch(Exception $I){

}
?>