<?php

session_start();
$_SESSION['udanaEdycjaUsera']=false;
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

     <!-- EDIT POPUP BOOSTRAP MODEL-->

<!-- Modal EDIT USER -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit user data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="PHPEditUserData.php" method="POST">
      
      <div class="modal-body">
         <!--BODY-->
                        <label for="nick" class="form-label">Name:</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                        <input type="text" class="form-control" name="nick" value=<?php echo $_SESSION['user'];?>>
                        </div>
                        <?php
                        if(isset($_SESSION['e_nick']))
                        {
                            echo '<div class="error">'.$_SESSION['e_nick'].'</div';
                            unset($_SESSION['e_nick']);
                        }
                        ?>
                        <label for="email" class="form-label">Email adress:</label>
                        <div class="mb-2 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill"></i>
                            </span>
                        <input type="email" class="form-control" name="email" value =<?php echo $_SESSION['Email']?>>
                        </div>
                        <?php
                        if(isset($_SESSION['e_email']))
                        {
                            echo '<div class="error">'.$_SESSION['e_email'].'</div';
                            unset($_SESSION['e_email']);
                        }
                        ?>
                        <label for="email" class="form-label">Your password:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-shield-exclamation"></i>
                            </span>

                        <input type="password" class="form-control"name ="haslo1">
                        </div>
                        <?php
                        if(isset($_SESSION['e_haslo']))
                        {
                            echo '<div class="error">'.$_SESSION['e_haslo'].'</div';
                            unset($_SESSION['e_haslo']);
                        }
                        ?>
                        <label for="email" class="form-label">Repeat password:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-shield-exclamation"></i>
                            </span>
                        <input type="password" class="form-control"name ="haslo2">
                        </div>
                    


        <!--BODY-->
        
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name ="editUserData" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
  </div>
</div>
        <!--###################################################################################################-->


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
                            <button type="button" class="btn btn-primary editUserData" >
                            Settings
                            </button>  
                            <?php 
                        if($_SESSION['udanaEdycjaUsera']==true)
                        {
                            echo "Udana edycja";
                            $_SESSION['udanaEdycjaUsera']=false;
                        }
                       
                        ?>
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
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <script>
    $(document).ready(function(){
        $('.editUserData').on('click',function(){
            $('#editUserModal').modal('show');

            
        });
    });
</script>


</body>
</html>