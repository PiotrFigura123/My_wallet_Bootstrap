<?php

session_start();
if(isset($_POST['email']))
{
    //Udana walidacja! 
    $wszystko_OK =true;

    //sprawdz nickname
    $nick=$_POST['nick'];
    //sprawdzenie dlugoci nicka
    if((strlen($nick)<3)||(strlen($nick)>20))
    {
        $wszystko_OK=false;
        $_SESSION['e_nick']='Nick musi posiadac od 3 do 20 znakow';
    }

    //Sprawdz poprawnosc formularza

    $email=$_POST['email'];
    $haslo1=$_POST['haslo1'];
    $haslo2=$_POST['haslo2'];
    
    if((strlen($haslo1)<8)||(strlen($haslo2)>20))
    {
        $wszystko_OK=false;
        $_SESSION['e_haslo']='Haslo musi posiadac od 8 do 20 znakow';
    
    }
    if($haslo1!=$haslo2)
    {
        $wszystko_OK=false;
        $_SESSION['e_haslo']='Hasla musza byc rowne';
    
    }

    $haslo_hash=password_hash($haslo1,PASSWORD_DEFAULT);
    
    //czy zaakceptowano regulamin
    if(!isset($_POST['regulamin']))
    {
        $wszystko_OK=false;
        $_SESSION['e_regulamin']='Potwierdz akceptacje regulaminu';
    
    }

    require_once "connect.php";

    mysqli_report(MYSQLI_REPORT_STRICT);
    try
    {
        
        $polaczenie = new mysqli($host, $db_user,$db_password,$db_name);
        if($polaczenie->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            $rezultat = $polaczenie->query("SELECT userId FROM logownie WHERE name='$nick'");
            
            if(!$rezultat) throw new Exception($polaczenie->error);
            $ile_takich_nickow=$rezultat->num_rows;
            if($ile_takich_nickow>0)
            {
                $wszystko_OK = false;
                $_SESSION['e_nick']="Istnieje juz konto o tym nicku";
            }

            $rezultat = $polaczenie->query("SELECT userId FROM logownie WHERE email='$email'");
            
            if(!$rezultat) throw new Exception($polaczenie->error);
            $ile_takich_emaili=$rezultat->num_rows;
            if($ile_takich_emaili>0)
            {
                $wszystko_OK = false;
                $_SESSION['e_email']="Istnieje juz konto o tym emailu";
            }

           
            if($wszystko_OK==true)
        {
            //wsystko zalicone, dodajemy do bazy
           if($polaczenie->query("INSERT INTO logownie VALUES(NULL,'$nick','$email','$email','$haslo_hash')"))
            {
                $_SESSION['udanarejestracja']=true;
                header('Location:registration.php');

            }
            else
            {
                throw new Exception($polaczenie->error);
            }
        }
            $polaczenie->close();
        }
    }
    catch(Exception $e)
    {
        echo '<span style="color:red;">"Blad serwera, poprosimy orejestracje w innym terminie"</span>';
        echo '</br>';
    }

    if($wszystko_OK==true)
    {
        //wsystko zalicone, dodajemy do bazy
        echo "Udana walidacja";
        exit();
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
    <title>Stworz konto</title>
    <script src="https://www.google.com/recaptcha/api.js"></script>
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
 <!--Boxes-->
 <section class="p-3 " >
    <div class="container ">
        <div class="row text-center g-4 ">
            <div class="col-sm-6  mx-auto">
                <div class="card bg-success text-light ">
                    <form  method="post">
                        
    
                        <label for="nick" class="form-label">Name:</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                        
                        <input type="text" class="form-control" name="nick" placeholder="e.g.Mario">
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
                        <input type="email" class="form-control" name="email" placeholder="example@wp.pl">
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
                        <label >
                        <input type="checkbox" name ="regulamin"> Akceptuje regulamin
                        </label>
                        <?php
                        if(isset($_SESSION['e_regulamin']))
                        {
                            echo '<div class="error">'.$_SESSION['e_regulamin'].'</div';
                            unset($_SESSION['e_regulamin']);
                        }
                        ?>
                        <div class="g-recaptcha " data-sitekey="6LdgO9gcAAAAABT4mVvtiu5gxTaALya1ntbKUS91"></div>
                        <input type="submit" value="Send">
                        <div class="mb-4 input-group">
                            <input type="submit" class="form-control m-2 " value="Register">
                            <input type="submit" class="form-control m-2 " value="Powrot">
                        </div>

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