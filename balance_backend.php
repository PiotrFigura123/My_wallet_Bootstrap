<?php

session_start();
$user_id=$_SESSION['$idUser'];
if(!isset($_SESSION['zalogowany']))
{
    header('Location:index.php');
    exit();
}
$userId=$_SESSION['$idUser'];
$_SESSION['udanaEdycjaIncome']=false;
$_SESSION['udanaEdycjaOutcome']=false;
$_SESSION['udanaKasacjaOutcome']=false;
$_SESSION['udanaKasacjaIncome']=false;
$_SESSION['udanaWdycjaWartosci']=true;
$wszystko_OK =true;
if(isset($_POST['endDate']))
$_SESSION['endDate']=$_POST['endDate'];

if(isset($_POST['startDate']))
$_SESSION['startDate']=$_POST['startDate'];
$endDate = $_SESSION['endDate'];
$startDate=$_SESSION['startDate'];
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
                $sqlIncome = "SELECT * FROM incomes WHERE `user_id`=$userId AND (date_of_income BETWEEN '$startDate' AND '$endDate')";
                $resultIncome = mysqli_query($polaczenie1,$sqlIncome);
                $incomes = mysqli_fetch_all($resultIncome,MYSQLI_ASSOC);
                mysqli_free_result($resultIncome);
                //print_r($incomes);
                $sqlOutcome = "SELECT * FROM expenses WHERE `user_id`=$userId AND (`date_of_expense` BETWEEN '$startDate' AND '$endDate')";
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
         
         <div class="container">
                        <p class="card-text">
                            <input type="value" placeholder="Value" name ="updatedIncomeValue" id="updatedIncomeValue" >
                        </p>
                        <p class="card-text">
                            <input type="date" name ="updateIncomeDate" id="updateIncomeDate">
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
                            do 
                            {                   
                        ?>
                        <div>
                        <input type="radio" id="drone" name="drone" value="<?php echo $rows['name'];?>" checked>
                        <label><?php echo $rows['name'];?></label>
                        </div>
                        <?php
                           }while($rows=mysqli_fetch_array($incomeSQL));
                           $polaczenie->close();                       
                        ?>  
                        

                        <input type="text" placeholder="Comment"name ="updateIncomeComment" id ="updateIncomeComment">
                        
                        </div>
                    </div>
           

        <!--BODY-->
        <?php
        if($_SESSION['udanaWdycjaWartosci']=true)
        {
            
        }
        
        ?>
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
         <div class="container ">
                        <p class="card-text">
                            <input type="value" placeholder="Value" name="updatedOutcomeValue" id="updatedOutcomeValue">
                        </p>
                        <p class="card-text">
                            <input type="date" name="updateOutcomeDate" id="updateOutcomeDate">
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
                            ("SELECT name FROM payment_methods_assigned_to_users WHERE user_id='$user_id'");
                            $ilu_userow = $rezultatt->num_rows;

                            $paidSQL=$polaczenie->query("SELECT name FROM payment_methods_assigned_to_users WHERE user_id='$user_id'");
                            $rows=mysqli_fetch_array($paidSQL);
                            }
                            ?>
                                <h3>Payment by:</h3>
                                <?php
                                    do
                                    {                   
                                ?>
                                <div>
                                <input type="radio"  name="updateOutcomePaidBy" id="updateOutcomePaidBy" value="<?php echo $rows['name'];?>" checked>
                                <label><?php echo $rows['name'];?></label>
                                </div>
                                <?php
                           }while($rows=mysqli_fetch_array($paidSQL));
                          
                            if($polaczenie->connect_errno!=0)
                            {
                                echo "Error".$polaczenie ->connect_erno;
                            }else
                            {
                            $rezultatt=@$polaczenie->query
                            ("SELECT name FROM expenses_category_assigned_to_users WHERE user_id='$user_id'");
                            $ilu_userow = $rezultatt->num_rows;

                            $outcomeSQL=$polaczenie->query("SELECT name FROM expenses_category_assigned_to_users WHERE user_id='$user_id'");
                            $rows=mysqli_fetch_array($outcomeSQL);
                            }
                            ?>
                        <h3 class="text-dark">Category:</h3>
	                    
                        <?php
                            do 
                            {                   
                        ?>
                            <div >
                                <input type="radio" name="updateOutcomePaidFor" id="updateOutcomePaidFor" value="<?php echo $rows['name'];?>" checked>
                                <label><?php echo $rows['name'];?></label>
                                </div>
                                <?php
                           }while($rows=mysqli_fetch_array($outcomeSQL));
                           $polaczenie->close();                       
                        ?> 
                        <input class="mt-2"type="Comment" placeholder="Comment" name="updateOutcomeComment" id="updateOutcomeComment">
                              
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
                                    <th>Category</th>
                                    <th>Value</th>
                                    <th>Date</th>                                  
                                    <th>Comment</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    </thead>
                                <tbody>
<?php

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

                            foreach($incomes as $income) {?>
                                <tr>
                                    <td><span id="incomeId"><h6><?php echo $income['id'] ?></h6></span></td>
                                    <td><span id="incomeFrom"><h6><?php echo $income['income_category_assigned_to_user_id'] ?></h6></span></td>
                                    <td><span id="incomeValue"><h6><?php echo $income['amount'] ?></h6></span></td>
                                    <td><span id="incomeDate"><h6><?php echo $income['date_of_income'] ?></h6></span></td>
                                    <td><span id="comment"><h6><?php echo $income['income_comment'] ?></h6></span></td>
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
            <?php }}
            $polaczenie1->close();
            }catch(Exception $I)
      {
        echo '<span style="color:red;">"Blad serweraaaaaaaaa, poprosimy orejestracje w innym terminie"</span>';
        echo '</br>';
      }?>
                            </tbody>
                            
                                </table>
                                <?php 
                        if($_SESSION['udanaEdycjaIncome']==true)
                        {
                            echo "Udana edycja";
                            $_SESSION['udanaEdycjaIncome']=false;
                        }
                        if($_SESSION['udanaKasacjaIncome']==true)
                        {
                            echo "Udana kasacja";
                            $_SESSION['udanaKasacjaIncome']=false;
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
                            Expenses
                        </h3>
                        
                        <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <th scope ="col">Id</th>
                                    <th scope ="col">Paid for</th>
                                    <th scope ="col">PaidBy</th>
                                    <th scope ="col">Vlue</th>
                                    <th scope ="col">Date</th>
                                    <th scope ="col">Comment</th>
                                    <th scope ="col">Edit</th>
                                    <th scope ="col">Delete</th>
                                    </thead>
                                
                            <?php 
                            require_once("connect.php");
                            mysqli_report(MYSQLI_REPORT_STRICT);
                            $polaczenie1 = new mysqli($host,$db_user,$db_password,$db_name);

                            foreach($outcomes as $outcome) {?>
                                <tbody>
                                <tr>
                                    
                                <td><span id="outcomeId"><h6><?php echo $outcome['id'] ?></h6></span></td>
                
                                    <td><span id="paidFor"><h6><?php 

                                        
                                    echo 7;
                                    ?></h6></span></td>
                                    <td><span id="paidBy"><h6><?php echo $outcome['payment_method_assigned_to_user_id'] ?></h6></span></td>
                                    <td><span id="outcomeValue"><h6><?php echo $outcome['amount'] ?></h6></span></td>
                                    <td><span id="outcomeDate"><h6><?php echo $outcome['date_of_expense'] ?></h6></span></td>
                                    <td><span id="Comment"><h6><?php echo $outcome['expense_comment'] ?></h6></span></td>
                                    
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
                            <?php }
                            $polaczenie1->close();
                            ?>
                            
                            
                                </table>
                        <?php 
                        if($_SESSION['udanaEdycjaOutcome']==true)
                        {
                            echo "Udana edycja";
                            $_SESSION['udanaEdycjaOutcome']=false;
                        }
                        if($_SESSION['udanaKasacjaOutcome']==true)
                        {
                            echo "Udana kasacja";
                            $_SESSION['udanaKasacjaOutcome']=false;
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
            $('#updateOutcomePaidFor').val(data[1]);
            $('#updateOutcomePaidBy').val(data[2]);
           $('#updatedOutcomeValue').val(data[3]);
           $('#updateOutcomeDate').val(data[4]);  
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
            $('#updateIncomeFrom').val(data[1]);
           $('#updatedIncomeValue').val(data[2]);
           $('#updateIncomeDate').val(data[3]);
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