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
    
    <script type ="text/javascript">
        var dzisiaj=new Date();
        var dzien=dzisiaj.getDate();
        if(dzien<10)
        dzien="0"+dzien;
        var miesiac = dzisiaj.getMonth()+1;
        if(miesiac<10)
        miesiac="0"+miesiac;
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

</head>
<body class="bg-dark">
    
    <nav class="navbar bg-dark navbar-white">
        <div class="container ps-2">
        <a href="index.php" class="navbar-brand"><i class="bi bi-wallet2"></i>My Wallet</a>
        </div>
    </nav>

    <section class="p-3" >
        <form action="balance_backend.php" method ="post">
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
                        <p class="card-text">
                           
                            <input type="date" id ="startDate" name ="startDate">
                            <input type="date" id ="endDate" name ="endDate">

                        </p>
                    
                        <p class="mt-3">
                            <input type="submit" value="Display">
                            <a href="main_meni.php" class=""><input type="button" value="Cancel"></a>
                        </p>

    
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