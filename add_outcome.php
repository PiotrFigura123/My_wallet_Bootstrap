<?php

session_start();
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
    <title>Outcome</title>
</head>
<body class="bg-dark">
    
    <nav class="navbar bg-dark navbar-white">
        <div class="container ps-2">
        <a href="index.php" class="navbar-brand"><i class="bi bi-wallet2"></i>My Wallet</a>
        </div>
    </nav>
    
    <section class="p-3 " >
    <form action="add_outcome_backend.php" method="post">
        <div class="container ">
            <div class="row text-center g-4">
                <div class="col-md">
                    <div class="card bg-secondary text-light">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="bi bi-shop"></i>
                        </div>
                        <h3 class="card-title mb-3">
                            Outcome
                        </h3>
                        <p class="card-text">
                            <input type="value" placeholder="Value" name="outcomeValue">
                        </p>
                        <p class="card-text">
                            <input type="date" name="outcomeDate">
                        </p>
                            
                        <h3>Payment by:</h3>
	                    
                                <div>
                                <input type="radio"  name="drone" value="Card" checked>
                                <label>Card</label>
                                </div>
        
                                <div>
                                <input type="radio"  name="drone" value="Cash">
                                <label >Cash</label>
                                </div>
        
                                <div>
                                <input type="radio"  name="drone" value="Different">
                                <label >Different</label>
                                </div>
                               
                        
                        <h3 class="text-dark">Category:</h3>
	                    
                            <div >
                                <input type="radio" name="drone1" value="Food" checked>
                                <label>Food</label>
                                </div>
        
                                <div>
                                <input type="radio"  name="drone1" value="Flat">
                                <label>Flat</label>
                                </div>
        
                                <div>
                                <input type="radio"  name="drone1" value="Auto">
                                <label >Auto</label>
                                </div>
                                <div>
                                <input type="radio"  name="drone1" value="Allegro">
                                <label >Allegro</label>
                                </div>
                                <div>
                                    <input type="radio" name="drone1" value="Restaurant" checked>
                                    <label >Restaurant</label>
                                    </div>
            
                                    <div>
                                    <input type="radio"  name="drone1" value="Cinema">
                                    <label >Cinema</label>
                                    </div>
            
                                    <div>
                                    <input type="radio"  name="drone1" value="Fines">
                                    <label >Fines</label>
                                    </div>
                                    <div>
                                    <input type="radio"  name="drone1" value="Different">
                                    <label >Different</label>
                                    </div>
                                           
                        <input class="mt-2"type="Comment" placeholder="Comment" name="outcomeComment">
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

</body>
</html>