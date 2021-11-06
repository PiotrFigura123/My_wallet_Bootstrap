<?php

session_start();
if(!isset($_SESSION['zalogowany']))
{
    header('Location:index.php');
    exit();
}
$userId=$_SESSION['idUser'];
$_SESSION['udanaEdycjaIncome']=false;
$_SESSION['udanaEdycjaOutcome']=false;
$_SESSION['udanaKasacja']=false;
$wszystko_OK =true;
$endDate=$_POST['endDate'];
$startDate=$_POST['startDate'];
if($startDate>0 && $endDate>0)
{
    if(($startDate)<($endDate))
    {
        //echo $userId."</br>".$startDate."</br>".$endDate;
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
                $sqlIncome = "SELECT * FROM `bilans` WHERE `userId`=$userId AND (`date` BETWEEN '$startDate' AND '$endDate') AND `incomeFrom`<>'' ORDER BY `date` ";
                $resultIncome = mysqli_query($polaczenie1,$sqlIncome);
                $incomes = mysqli_fetch_all($resultIncome,MYSQLI_ASSOC);
                mysqli_free_result($resultIncome);
                //print_r($incomes);
                $sqlOutcome = "SELECT * FROM `bilans` WHERE `userId`=$userId AND (`date` BETWEEN '$startDate' AND '$endDate') AND `incomeFrom`='' ORDER BY `date` ";
                $resultOutcome = mysqli_query($polaczenie1,$sqlOutcome);
                $outcomes = mysqli_fetch_all($resultOutcome,MYSQLI_ASSOC);
                mysqli_free_result($resultOutcome);
                //print_r($incomes);

            }
        if(isset($_POST['saveOutcome']))
            {
                $vOutcome=$_POST['vOutcome'];
                $dOutcome=$_POST['dOutcome'];
                $gridRadios=$_POST['gridRadios'];
                $gridRadios1=$_POST['gridRadios1'];
            
                $query = "INSERT INTO bilans VALUES(NULL,,$vOutcome,'$dOutcome','','$gridRadios','$gridRadios1','')";
                $edit = mysqli_query($polaczenie1,$query);
                if($edit)
                {
                    echo 'udany zapis';
                    header('Location:balance_backend.php');
                }
                    
                else
                    echo 'lipa';
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    
    <title>Balance2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

 
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
    
        <!--###################################################################################################-->
        <!-- EDIT POPUP BOOSTRAP MODEL-->

<!-- Modal EDIT INCOME -->
<div class="modal fade" id="editIncomeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Income</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="PHPEditOutcome.php" method="POST">
          
      <div class="modal-body">
         <!--BODY-->
         <input type="hidden" name ="incomeId" id ="incomeId">
                <div class="row mb-3">
                
                    <label  class="col-sm-2 col-form-label">Value</label>
                    <div class="col-sm-10">
                    <input type="text" name ="updatedIncomeValue" id ="updatedIncomeValue">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                    <input type="date" name ="updateIncomeDate" id ="updateIncomeDate">
                    </div>
                </div>
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
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Comment</label>
                    <div class="col-sm-10">
                    <input type="value" name ="updateIncomeComment" id="updateIncomeComment">
                    </div>
                </div>
                        
        </div>

        <!--BODY-->
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name ="saveEditedIncome" class="btn btn-primary">Save changes</button>
        </div>
        </form>
    </div>
  </div>
</div>
        <!--###################################################################################################-->



<!-- Modal EDIT OUTCOME -->
<div class="modal fade" id="editOutcomeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Outcome</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="PHPEditOutcome.php" method="POST">
          
      <div class="modal-body">
         <!--BODY-->
         <input type="hidden" name ="outcomeId" id ="outcomeId">
                <div class="row mb-3">
                
                    <label  class="col-sm-2 col-form-label">Value</label>
                    <div class="col-sm-10">
                    <input type="text" name ="updatedOutcomeValue" id ="updatedOutcomeValue">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                    <input type="date" name ="updateOutcomeDate" id ="updateOutcomeDate">
                    </div>
                </div>

                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Paid By</legend>
                    <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="updateOutcomePaidBy"  value="Card" >
                        <label class="form-check-label" >
                        Card
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="updateOutcomePaidBy" value="Cash">
                        <label class="form-check-label" >
                        Cash
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="updateOutcomePaidBy" value="Different" >
                        <label class="form-check-label" >
                        Different
                        </label>
                    </div>
                    </div>
                </fieldset>

                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Paid for</legend>
                    <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios1"  value="Food">
                        <label class="form-check-label" >
                        Food
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios1"  value="Flat">
                        <label class="form-check-label" >
                        Flat
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="gridRadios1"  value="Auto" >
                        <label class="form-check-label" >
                        Auto
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="gridRadios1"  value="Allegro" >
                        <label class="form-check-label" >
                        Allegro
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="gridRadios1"  value="Restaurant">
                        <label class="form-check-label" >
                        Restaurant
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="gridRadios1"  value="Cinema">
                        <label class="form-check-label" >
                        Cinema
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="gridRadios1"  value="Fines">
                        <label class="form-check-label" >
                        Fines
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="gridRadios1"  value="Different" >
                        <label class="form-check-label" >
                        Different
                        </label>
                    </div>
                    </div>
                </fieldset>
                  
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Comment</label>
                    <div class="col-sm-10">
                    <input type="value" name ="updateOutcomeComment" id="updateOutcomeComment">
                    </div>
                </div>
                        
        </div>

        <!--BODY-->
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name ="saveEditedOutcome" class="btn btn-primary">Save changes</button>
        </div>
        </form>
    </div>
  </div>
</div>
        <!--###################################################################################################-->

   <!--###############################            DELETE  OUTCOME MODAL           #############################-->

   <div class="modal" id="deleteOutcomeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Outcome</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="PHPDeleteRecord.php" method="POST">
      <div class="modal-body">
          
        <p>Do You want to delete this data? </p>
        <input type="hidden" name ="delete_outcomeId" id ="delete_outcomeId">
      </div>
      <div class="modal-footer">
        <button type="submit" name ="deleteOutcome" class="btn btn-primary">DELETE</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

  <!--###################################################################################################-->
  <!--###############################            DELETE  INCOME MODAL           #############################-->
  <div class="modal" id="deleteIncomeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Income</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="PHPDeleteRecord.php" method="POST">
      <div class="modal-body">
          
        <p>Do You want to delete this data? </p>
        <input type="hidden" name ="delete_incomeId" id ="delete_incomeId">
      </div>
      <div class="modal-footer">
      <button type="submit" name ="deleteIncome" class="btn btn-primary">DELETE</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

  <!--###################################################################################################-->


        <form method ="post">
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
                           
                            <input type="date" id ="startDate" name ="startDate" value="<?php if(isset($startDate)){echo $startDate;} ?>">
                            <input type="date" id ="endDate" name ="endDate" value="<?php if(isset($endDate)){echo $endDate;} ?>">

                        </p>
                        <input type="submit" value="Display">
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
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <th scope ="col">Id</th>
                                    <th>Value</th>
                                    <th>Date</th>
                                    <th>IncomeForm</th>
                                    <th>Comment</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    </thead>
                                <tbody>
                            <?php foreach($incomes as $income) {?>
                                <tr>
                                    <td><span id="incomeId"><h6><?php echo $income['balanceId'] ?></h6></span></td>
                                    <td><span id="incomeValue"><h6><?php echo $income['value'] ?></h6></span></td>
                                    <td><span id="incomeDate"><h6><?php echo $income['date'] ?></h6></span></td>
                                    <td><span id="incomeFrom"><h6><?php echo $income['incomeFrom'] ?></h6></span></td>

                                    <td><span id="comment"><h6><?php echo $income['comment'] ?></h6></span></td>
                                   
                                    <td>
                                    <button type="button" class="btn btn-primary editIncome" >
                                    <i class="bi bi-pencil"> </i>
                                    </button>
                                    </td>

                                    <td>
                                    <button type="button" class="btn btn-danger deleteIncome" ><i class="bi bi-trash"></i>
                                    </button>
                                    </td> 
                                </tr>
                            <?php }?>
                            </tbody>
                            
                                </table>
                                <?php 
                        if($_SESSION['udanaEdycjaIncome']==true)
                        {
                            echo "Udana edycja";
                        }
                        ?>
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
                        
                        <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <th scope ="col">Id</th>
                                    <th scope ="col">Value</th>
                                    <th scope ="col">Date</th>
                                    <th scope ="col">PaidBy</th>
                                    <th scope ="col">PaidFor</th>
                                    <th scope ="col">Comment</th>
                                    <th scope ="col">Edit</th>
                                    <th scope ="col">Delete</th>
                                    </thead>
                                
                            <?php foreach($outcomes as $outcome) {?>
                                <tbody>
                                <tr>
                                    
                                <td><span id="outcomeId"><h6><?php echo $outcome['balanceId'] ?></h6></span></td>
                                    <td><span id="outcomeValue"><h6><?php echo $outcome['value'] ?></h6></span></td>
                                    <td><span id="outcomeDate"><h6><?php echo $outcome['date'] ?></h6></span></td>
                                    <td><span id="paidBy"><h6><?php echo $outcome['paidBy'] ?></h6></span></td>
                                    <td><span id="paidFor"><h6><?php echo $outcome['paidFor'] ?></h6></span></td>
                                    <td><span id="Comment"><h6><?php echo $outcome['comment'] ?></h6></span></td>
                                    
                                    <td>
                                    <button type="button" class="btn btn-primary editOutcome" >
                                    <i class="bi bi-pencil"> </i>
                                    </button>
                                    </td>
                                    <td>
                                    <button type="button" class="btn btn-danger deleteOutcome" ><i class="bi bi-trash"></i>                                    
                                    </button>
                                    </td>
                                </div>
                                </tr>
                                </tbody>
                            <?php }?>
                            
                            
                                </table>
                        <?php 
                        if($_SESSION['udanaEdycjaOutcome']==true)
                        {
                            echo "Udana edycja";
                        }
                        ?>
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
                            
                            <a href="main_meni.php" class="btn btn-dark">Main manu</a>
                    </div>
                   
                    
                </div>
            </div> 
        </div>
        
    </div>
    </form>
    </section>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('.editOutcome').on('click',function(){
            $('#editOutcomeModal').modal('show');

            $tr=$(this).closest('tr');
            var data=$tr.children("td").map(function(){
                return $(this).text();
            }).get();

            console.log(data);
            $('#outcomeId').val(data[0]);
           $('#updatedOutcomeValue').val(data[1]);
           $('#updateOutcomeDate').val(data[2]);
           $('#updateOutcomePaidBy').val(data[3]);
           $('#updateOutcomePaidFor').val(data[4]);
           $('#updateOutcomeComment').val(data[5]);
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('.editIncome').on('click',function(){
            $('#editIncomeModal').modal('show');

            $tr=$(this).closest('tr');
            var data=$tr.children("td").map(function(){
                return $(this).text();
            }).get();

            console.log(data);
            $('#incomeId').val(data[0]);
           $('#updatedIncomeValue').val(data[1]);
           $('#updateIncomeDate').val(data[2]);
           $('#updateIncomeFrom').val(data[3]);
           $('#updateIncomeComment').val(data[4]);
           
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.deleteIncome').on('click',function(){
            $('#deleteIncomeModal').modal('show');

            $tr=$(this).closest('tr');
            var data=$tr.children("td").map(function(){
                return $(this).text();
            }).get();

            console.log(data);
        $('#delete_incomeId').val(data[0]);
           
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.deleteOutcome').on('click',function(){
            $('#deleteOutcomeModal').modal('show');

            $tr=$(this).closest('tr');
            var data=$tr.children("td").map(function(){
                return $(this).text();
            }).get();

            console.log(data);
        $('#delete_outcomeId').val(data[0]);
           
        });
    });
</script>
</body>
</html>

</body>
</html>