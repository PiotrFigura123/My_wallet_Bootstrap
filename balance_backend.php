<?php

session_start();
if(!isset($_SESSION['zalogowany']))
{
    header('Location:index.php');
    exit();
}
$userId=$_SESSION['idUser'];
$startDate=$_POST['startDate'];
$endDate=$_POST['endDate'];
$wszystko_OK =true;

if($startDate>0 && $endDate>0)
{
    if(($startDate)<($endDate))
    {
        echo $userId."</br>".$startDate."</br>".$endDate;

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
                $sqlincome = "SELECT * FROM `bilans` WHERE `userId`=$userId AND (`date` BETWEEN '$startDate' AND '$endDate')";
                $result = mysqli_query($polaczenie1,$sqlincome);
                $incomes = mysqli_fetch_all($result,MYSQLI_ASSOC);
                mysqli_free_result($result);
                print_r($incomes);

            }
            $polaczenie1->close();
      }
    
    }
    catch(Exception $I)
      {
        echo '<span style="color:red;">"Blad serwera, poprosimy orejestracje w innym terminie"</span>';
        echo '</br>';
      }
    }
    



    elseif(($startDate)>($endDate))
    $_SESSION['e_date']="Data startowa po koncowej ";
}
else//($startDate>$endDate)
{
    $_SESSION['e_date']="Wybierz daty ";
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
    <title>Balance2</title>
    <script type ="text/javascript">
        var dzisiaj=new Date();
        var dzien=dzisiaj.getDate();
        var miesiac = dzisiaj.getMonth()+1;
        var rok = dzisiaj.getFullYear();
        var aktualnaData =rok+'-'+miesiac+'-'+dzien;
        var poczMiesiaca=rok+'-'+miesiac+'-'+"01";
        var poczRoku = rok+"-"+"01"+"-"+"01";
    function setDate(s1,d1,d2){
        var s1=document.getElementById(s1);
        var d1=document.getElementById(d1);
        var d2=document.getElementById(d2);
        //document.write(aktualnaData);
            if(s1.value==1)
        {
            
            d1.value=poczMiesiaca;
            d2.value=aktualnaData;
        }

        else if(s1.value==2)
        {
            d1.value=poczRoku;
            d2.value=aktualnaData;
        }
        else if(s1.value==3)
        {
            d1.value=aktualnaData;
            d2.value=aktualnaData;
        }

    }

    </script>
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
                            <select id="balance" name ="balance" onchange="setDate(this.id,'startDate','endDate')">
                            <option value="" ></option>    
                            <option value="1" >This month</option>
                                <option value="2" >This year</option>
                                <option value="3" >define</option>
                            </select>
                                
                        </p>
                        <?php
                        if(isset($_SESSION['e_date']))
                        {
                            echo '<div class="error">'.$_SESSION['e_date'].'</div';
                            unset($_SESSION['e_date']);
                           
                        }
                        ?>
                        <p class="card-text">
                           
                            <input type="date" id ="startDate" name ="startDate">
                            <input type="date" id ="endDate" name ="endDate">

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