<?php
    $method=$_SERVER['REQUEST_METHOD'];

    $showError="No Error";

    if($method=="POST"){
        include "_dbconnect.php";
        $user_name=$_POST['username'];
        $user_email=$_POST['email'];
        $user_password=$_POST['password'];
        $user_cpassword=$_POST["cpassword"];

        $sql_query="SELECT *FROM `users` WHERE user_email='$user_email'";
        $result=mysqli_query($connection,$sql_query);

        $num_row=mysqli_num_rows($result);

        if($num_row>0){
            $showError="User Already registered";
            header("location: /project-3/index.php?signupsuccess=false&error=$showError");
        }else{
            if($user_password==$user_cpassword){
                $hash=password_hash($user_password,PASSWORD_DEFAULT);
                $sql="INSERT INTO `users` (`user_name`, `user_email`, `user_password`) VALUES ('$user_name', '$user_email', '$hash')";
                $result=mysqli_query($connection,$sql);
                if($result){
                    header("location: /project-3/index.php?signupsuccess=true");
                }

            }else{
                $showError="Password do not match";
                header("location: /project-3/index.php?signupsuccess=false&error=$showError");
            }
        }
    }
?>