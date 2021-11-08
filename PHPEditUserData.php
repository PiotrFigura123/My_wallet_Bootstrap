<?php
session_start();
    require_once("connect.php");
    mysqli_report(MYSQLI_REPORT_STRICT);
try{
      $polaczenie1 = new mysqli($host,$db_user,$db_password,$db_name);
      if($polaczenie1->connect_errno!=0)
      {
          throw new Exception(mysqli_connect_errno());
      }
      else
      {
        if(isset($_POST['editUserData']))
        {   
            $id=$_SESSION['idUser'];
            $name=$_POST['nick'];  
            $sname=$_POST['surename'];  
            $email=$_POST['email'];
            $_SESSION['user'] =$name;
            $_SESSION['nazwisko']=$sname;
            $_SESSION['Email']=$email;
            if($polaczenie1->query("UPDATE logownie SET name='$name', surename='$sname',email='$email' WHERE userId=$id"))
               
            {
               
                $_SESSION['udanaEdycjaUsera']=true;
                header('Location:main_meni.php');
                
            }
            else
            throw new Exception($polaczenie1->error);
        $polaczenie1->close();
            
        }
        
    }
    }catch(Exception $I)
      {
        echo '<span style="color:red;">"Blad serweraaaaaaaaa, poprosimy orejestracje w innym terminie"</span>';
        echo '</br>';
      }
?>