<?php
session_start();
$user_id=$_SESSION['$idUser'];
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
        $paidForOutcome=$_POST['updateOutcomePaidFor'];
        $comment=$_POST['updateOutcomeComment'];

        echo '$paidByOutcome = '.$paidByOutcome.'paidForOutcome = '.$paidForOutcome;
        if($sqlexpenses_category_assigned_to_users=@$polaczenie1->query(
            "SELECT id FROM expenses_category_assigned_to_users WHERE user_id='$user_id' AND name='$paidForOutcome'"))
        { 
            $wiersz=$sqlexpenses_category_assigned_to_users->fetch_assoc();
            $expenses_category_assigned_to_users=$wiersz['id'];
        } 
        //echo '$expenses_category_assigned_to_users = '.$expenses_category_assigned_to_users;

        if($sqlpayment_methods_assigned_to_users=@$polaczenie1->query(
            "SELECT id FROM payment_methods_assigned_to_users WHERE user_id='$user_id' AND name='$paidByOutcome'"))
        { 
            $wiersz=$sqlpayment_methods_assigned_to_users->fetch_assoc();
            $payment_methods_assigned_to_users=$wiersz['id'];
        }
       // echo '$payment_methods_assigned_to_users = '.$payment_methods_assigned_to_users;
               if($polaczenie1->query("UPDATE expenses SET amount=$value, 
               date_of_expense='$date', 
               payment_method_assigned_to_user_id='$payment_methods_assigned_to_users',
               expense_category_assigned_to_user_id='$expenses_category_assigned_to_users', 
               expense_comment='$comment' WHERE id=$id"))
               
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
               if($polaczenie1->query("UPDATE incomes SET amount=$value, 
               date_of_income='$date', 
               income_category_assigned_to_user_id='$incomeFrom', 
               income_comment='$comment' WHERE id=$id"))              
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