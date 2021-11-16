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
            
            $user_id=$_SESSION['$idUser'];
            $name=$_POST['nick'];  
            $email=$_POST['email'];

            $haslo1=$_POST['haslo1'];
            $haslo2=$_POST['haslo2'];
    
                    if((strlen($haslo1)<8)||(strlen($haslo2)>20))
                     {
                     $wszystko_OK=false;
                        $_SESSION['e_haslo']='Haslo musi posiadac od 8 do 20 znakow';
    
                        }
                        if($haslo1!=$haslo2)
                        {
                            $wszystko_OK=false;
                            $_SESSION['e_haslo']='Hasla musza byc rowne';
                        
                        }

                         $haslo_hash=password_hash($haslo1,PASSWORD_DEFAULT);

            if($polaczenie1->query("UPDATE users SET username='$name' ,email='$email' WHERE id=$user_id"))
               
            {
               
                $_SESSION['udanaEdycjaUsera']=true;
                header('Location:main_meni.php');
                
            }
            else
            throw new Exception($polaczenie1->error);
        
            
        }
        $polaczenie1->close();
        
    }
    }catch(Exception $I)
      {
        echo '<span style="color:red;">"Blad serweraaaaaaaaa, poprosimy orejestracje w innym terminie"</span>';
        echo '</br>';
      }
?>