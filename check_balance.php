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
    <title>Balance</title>
</head>
<body class="bg-dark">
    
    <nav class="navbar bg-dark navbar-white">
        <div class="container ps-2">
        <a href="index.php" class="navbar-brand"><i class="bi bi-wallet2"></i>My Wallet</a>
        </div>
    </nav>

    <section class="p-3" >
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md">
                    <div class="card bg-info text-dark">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="bi bi-pie-chart"></i>
                        </div>
                        <h3 class="card-title mb-3">
                            Balance
                        </h3>
                        <p class="card-text">
                            Choose period: 
                            <select name="balane-menu" id="balane-menu">
                                <option value="last month">last month</option>
                                <option value="current year">current year</option>
                                <option value="define">define</option>
                                </select>
                        </p>
                        <p class="card-text">
                            <input type="date">
                            <input type="date">
                        </p>
                        <a href="#" class="btn btn-dark">Display</a>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row text-center g-3 mt-1">
                <div class="col-md">
                    <div class="card bg-info text-dark">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="bi bi-cash-stack"></i>
                        </div>
                        <h3 class="card-title mb-3">
                            Incomes
                        </h3>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                       
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card bg-info text-dark">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="bi bi-shop"></i>
                        </div>
                        <h3 class="card-title mb-3">
                            Outcomes
                        </h3>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                       
                        </div>
                    </div>
                </div>
            </div>  
            <div class="col-md mt-2">
                <div class="card bg-info text-dark">
                    <div class="card-body text-center">
                        <div class="h1 mb-3">
                            <h3 class="card-title mb-3">
                                Summary:
                            </h3>
                        
                    </div>
                   
                    
                </div>
            </div> 
            <div class="col-md mt-2">
                <div class="card bg-info text-dark">
                    <div class="card-body text-center">
                        <div class="h1 mb-3">
                            
                            <a href="" class="btn btn-dark">Main manu</a>
                    </div>
                   
                    
                </div>
            </div> 
        </div>
        
    </div>
    
    </section>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>  
 
</body>
</html>

</body>
</html>