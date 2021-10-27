<?php
session_start();
if(isset($_POST['valueForm']))
{

$userId=$_SESSION['idUser'];
$value=$_POST['valueForm'];
$date=$_POST['incomeDate'];
$paymentMethod=$_POST['drone'];
$comment=$_POST['incomeComment'];

$wszystko_OK =true;
//echo $value."</br>".$userId;

/*if(is_float($value))
    {
      $wszystko_OK=false;
      $_SESSION['e_value']='Nie jest liczba';
    }
*/

if(is_numeric($value))
  {
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
    
        if($wszystko_OK==true)
            {
                //wsystko zalicone, dodajemy do bazy
               if($polaczenie1->query("INSERT INTO bilans VALUES(NULL,$userId,$value,'$date','$paymentMethod','','','$comment')"))
               
                {
                    $_SESSION['udanyZapis']=true;
                    
                }
                else
                throw new Exception($polaczenie1->error);
            }
            $polaczenie1->close();
      }
    
    }
    catch(Exception $I)
      {
        echo '<span style="color:red;">"Blad serwera, poprosimy orejestracje w innym terminie"</span>';
        echo '</br>';
      }
      /*
      if($wszystko_OK==true)
        {
            //wsystko zalicone, dodajemy do bazy
            echo "Udana walidacja";
            exit();
        }*/
    
  }
  else
  {
    //$wszystko_OK = false;
    $_SESSION['e_value']="nie jest to float ";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Incomes</title>
    <style>
        .error
        {
            color:red;
            margin-top:10px;
            margin-bottom:10px;
            font-weight:bold;
        }
    </style>
</head>
<body class="bg-dark">
    
    <nav class="navbar bg-dark navbar-white">
        <div class="container ps-2">
        <a href="index.php" class="navbar-brand"><i class="bi bi-wallet2"></i>My Wallet</a>
        </div>
    </nav>

    <section class="p-3" >
        <form method ="post">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md">
                    <div class="card bg-success text-light">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="bi bi-cash-stack"></i>
                        </div>
                        <h3 class="card-title mb-3">
                            Income
                        </h3>
                        
                        <p class="card-text">
                            <input type="value" placeholder="Value" name ="valueForm">
                        <?php
                        if(isset($_SESSION['e_value']))
                        {
                            echo '<div class="error">'.$_SESSION['e_value'].'</div';
                            unset($_SESSION['e_value']);
                            $_SESSION['udanyZapis']=false;
                        }
                        ?>
                        </p>
                        
                        <p class="card-text">
                            <input type="date" name ="incomeDate">
                        </p>
                            
                        <h3>Select category:</h3>
	                    
                        <div>
                        <input type="radio" id="huey" name="drone" value="Salary" checked>
                        <label>Salary</label>
                        </div>

                        <div>
                        <input type="radio" id="dewey" name="drone" value="Bank transation">
                        <label >Bank transation</label>
                        </div>

                        <div>
                        <input type="radio" id="louie" name="drone" value="Allegro">
                        <label>Allegro</label>
                        </div>
                        <div>
                        <input type="radio" id="louie" name="drone" value="Different">
                        <label>Different</label>
                        </div>

                        <input type="Comment" placeholder="Comment"name ="incomeComment">
                        <p class="mt-3">
                            <input type="submit" value="Save">
                            <a href="main_meni.php" class=""><input type="button" value="Cancel"></a>
                        </p>
                        
                        </div>
                        <?php 
                            if($_SESSION['udanyZapis']==true)
                            {
                                echo "Dodales przychod";
                                //$_SESSION['udanyZapis']=false;
                            }
                            ?>
                    </div>
                </div>
            </div>   
        </div>
    </div>
    </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>  
</body>
</html>
