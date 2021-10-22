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
    <title>Logins</title>
</head>
<body class="bg-dark">
    
    <nav class="navbar bg-dark navbar-white">
        <div class="container ps-2">
        <a href="index.php" class="navbar-brand"><i class="bi bi-wallet2"></i>My Wallet</a>
        </div>
    </nav>
 <!--Boxes-->
 <section class="p-3 " >
    <div class="container ">
        <div class="row text-center g-4 ">
            <div class="col-sm-6  mx-auto">
                <div class="card bg-success text-light ">
                    <form action="login_backend.php" method="post">
                        
                        <label for="email" class="form-label">Email adress:</label>
                        <div class="mb-2 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill"></i>
                            </span>
                        <input type="email" class="form-control" name="email" placeholder="example@wp.pl">
                        </div>
                        <label for="email" class="form-label">Password:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-shield-exclamation"></i>
                            </span>
                        <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-4 input-group">
                            <input type="submit" class="form-control m-2 " value="Zaloguj sie">
                            <input type="submit" class="form-control m-2 " value="Powrot do">
                        </div>
                       
                        <?php
if(isset($_SESSION['blad']))
echo $_SESSION['blad'];
?>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>  
 
</body>
</html>

</body>
</html>