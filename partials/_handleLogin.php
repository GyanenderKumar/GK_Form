<?php
    $method=$_SERVER['REQUEST_METHOD'];

    $showError="No Error";

    if($method=="POST"){
        include "_dbconnect.php";

        $user_email=$_POST['email'];
        $user_password=$_POST['password'];

        $sql_query="SELECT *FROM `users` WHERE user_email='$user_email'";
        $result=mysqli_query($connection,$sql_query);

        $num_row=mysqli_num_rows($result);

        if($num_row==1){
            $row=mysqli_fetch_assoc($result);

            $user_name=$row['user_name'];
            $sno=$row['s_no'];
            
            if(password_verify($user_password,$row['user_password'])){
                session_start();
                $_SESSION['login']=true;
                $_SESSION['sno']=$sno;
                $_SESSION['useremail']=$user_email;
                $_SESSION['username']=$user_name;
                
                header("location: /project-3/index.php");
            }else{
                header("location: /project-3/index.php");
            }
        }
    }
    
    
?>