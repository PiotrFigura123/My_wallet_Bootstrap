<?php

session_start();



require_once"connect.php";
$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error".$polaczenie ->connect_erno;
}
else{

$login=$_POST['name'];
$email=$_POST['email'];
$haslo=$_POST['password'];



if($rezultat=@$polaczenie->query(
    sprintf("SELECT * FROM logownie WHERE name='%s'",
    mysqli_real_escape_string($polaczenie,$login))))
{
    $ilu_userow = $rezultat->num_rows;
        if($ilu_userow>0)
        {
            $wiersz=$rezultat->fetch_assoc();
            if(password_verify($haslo,$wiersz['password']))
            {
                $_SESSION['zalogowany']=true;
                $_SESSION['id']=$wiersz['userId'];
                $_SESSION['user']=$login;
                $_SESSION['nazwisko']=$wiersz['surename'];
                $_SESSION['Email']=$wiersz['email'];
                unset($_SESSION['blad']);
                $rezultat->free_result();
                header('Location:main_meni.php');
            }
            else
            {
            $_SESSION['blad']='<span style="color:red">Nieprawidlowy login lub haslo </span>';
            header('Location:zly_login.php');
            }
        }else{
            $_SESSION['blad']='<span style="color:red">Nieprawidlowy login lub haslo </span>';
            header('Location:zly_login.php');
        }

        $polaczenie->close();
}
}

?>
</br>
<a href="login.php">powrot do index</a>