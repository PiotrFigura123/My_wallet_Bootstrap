<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Main_menu</title>
</head>
<body class="bg-dark">

    <nav class="navbar bg-dark navbar-white">
        <div class="container ps-2">
        <a href="#" class="navbar-brand"><i class="bi bi-wallet2"></i>My Wallet</a>
        </div>
    </nav>
    <!--Boxes-->
    <section class="p-2">
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
                            Whatever on plus 
                        </p>
                        <a href="add_income.php" class="btn btn-dark">Add income</a>
                        </div>
                    </div>
                </div>
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
                          Whatever on minus</p>
                        <a href="add_outcome.php" class="btn btn-dark">Add outcome</a>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card bg-info text-light">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="bi bi-pie-chart"></i>
                        </div>
                        <h3 class="card-title mb-3">
                            Check balance
                        </h3>
                        <p class="card-text">
                          Wynikowa dwoch poprzednich</p>
                        <a href="check_balance.php" class="btn btn-dark">Check</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-2">
                <div class="row text-center g-4">
                    <div class="col-md">
                        <div class="card bg-dark text-light">
                            <div class="card-body text-center">
                                <div class="h1 mb-3">
                                    <i class="bi bi-gear"></i>
                            </div>
                            <h3 class="card-title mb-3">
                                <a href="" class="btn btn-primary">Settings</a>
                            </h3>
                            
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card bg-dark text-light">
                            <div class="card-body text-center">
                                <div class="h1 mb-3">
                                    <i class="bi bi-door-open"></i>
                            </div>
                            <h3 class="card-title mb-3">
                                <a href="logout.php" class="btn btn-primary">Log out</a>
                            </h3>
                            
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>  
</body>
</html>