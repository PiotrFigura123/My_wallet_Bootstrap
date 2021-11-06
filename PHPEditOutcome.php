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
    
        if(isset($_POST['saveEditedOutcome']))
        {
        $id=$_POST['outcomeId'];
        $value=$_POST['updatedOutcomeValue'];
        $date=$_POST['updateOutcomeDate'];
        $paidByOutcome=$_POST['updateOutcomePaidBy'];
        $paidForOutcome=$_POST['gridRadios1'];
        $comment=$_POST['updateOutcomeComment'];
               if($polaczenie1->query("UPDATE bilans SET value=$value, date='$date', paidBy='$paidByOutcome',paidFor='$paidForOutcome', comment='$comment' WHERE balanceId=$id"))
               
                {
                   
                    $_SESSION['udanaEdycjaIncome']=true;
                    header('Location:balance_backend.php');
                    
                }
                else
                throw new Exception($polaczenie1->error);
            $polaczenie1->close();
        } 

      if(isset($_POST['saveEditedIncome']))
        {
            $id=$_POST['incomeId'];
            $value=$_POST['updatedIncomeValue'];
            $date=$_POST['updateIncomeDate'];
            $incomeFrom=$_POST['drone'];
            $comment=$_POST['updateIncomeComment'];
               if($polaczenie1->query("UPDATE bilans SET value=$value, date='$date', incomeFrom='$incomeFrom', comment='$comment' WHERE balanceId=$id"))              
                {                 
                    $_SESSION['udanaEdycjaOutcome']=true;
                    header('Location:balance_backend.php');                   
                }
                else
                throw new Exception($polaczenie1->error);
            $polaczenie1->close();
        }   

    }
    }catch(Exception $I)
      {
        echo '<span style="color:red;">"Blad serwera, poprosimy orejestracje w innym terminie"</span>';
        echo '</br>';
      }
?>