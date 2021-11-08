<?php
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
        if(isset($_POST['deleteOutcome']))
        {
            $id=$_POST['delete_outcomeId'];  
               if($polaczenie1->query("DELETE FROM bilans WHERE balanceId=$id"))              
                {                  
                    $_SESSION['udanaKasacjaOutcome']=true;
                    echo $id;
                    header('Location:balance_backend.php');                  
                }
                else
                throw new Exception($polaczenie1->error);
            
        }
        if(isset($_POST['deleteIncome']))
        {
            $id=$_POST['delete_incomeId'];    
               if($polaczenie1->query("DELETE FROM bilans WHERE balanceId=$id"))              
                {                  
                    $_SESSION['udanaKasacjaIncome']=true;
                    echo $id;
                    header('Location:balance_backend.php');                   
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