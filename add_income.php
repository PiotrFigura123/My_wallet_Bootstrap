<?php

session_start();
$user_id=$_SESSION['$idUser'];


if(!isset($_SESSION['zalogowany']))
{
    header('Location:index.php');
    exit();
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
</head>
<body class="bg-dark">
    
    <nav class="navbar bg-dark navbar-white">
        <div class="container ps-2">
        <a href="index.php" class="navbar-brand"><i class="bi bi-wallet2"></i>My Wallet</a>
        </div>
    </nav>

    <section class="p-3" >
        <form action="addAmountToSql.php" method="post">
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
                            <input type="value" placeholder="Value" name ="valueForm" >
                        </p>
                        <p class="card-text">
                            <input type="date" name ="incomeDate">
                        </p>
                        

<?php


require_once "connect.php";
$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error".$polaczenie ->connect_erno;
}else
{
$rezultatt=@$polaczenie->query
("SELECT name FROM incomes_category_assigned_to_users WHERE user_id='$user_id'");
$ilu_userow = $rezultatt->num_rows;

$incomeSQL=$polaczenie->query("SELECT name FROM incomes_category_assigned_to_users WHERE user_id='$user_id'");
$rows=mysqli_fetch_array($incomeSQL);

}
?>
                        <h3>Select category:</h3>
	                    <?php
                            while($rows=mysqli_fetch_array($incomeSQL))
                            {                   
                        ?>
                        <div>
                        <input type="radio" id="huey" name="drone" value="<?php echo $rows['name'];?>" checked>
                        <label><?php echo $rows['name'];?></label>
                        </div>
                        <?php
                           }
                           $polaczenie->close();                       
                        ?>  
                        

                        <input type="Comment" placeholder="Comment"name ="incomeComment">
                        <p class="mt-3">
                            <input type="submit" value="Save">
                            <a href="main_meni.php" class=""><input type="button" value="Cancel"></a>
                        </p>
                        
                        </div>
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
