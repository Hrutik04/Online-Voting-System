<?php
    include("connection.php");

    $name = $_POST['name'];
    $mobile = $_POST['mob'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $add = $_POST['add'];
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $role = $_POST['role'];

    $number = preg_match('@[0-9]@', $pass);
    $uppercase = preg_match('@[A-Z]@', $pass);
    $lowercase = preg_match('@[a-z]@', $pass);
    $specialChars = preg_match('@[^\w]@', $pass);
    $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

    if(preg_match($pattern, $pass)) {
        if($pass == $cpass){
            if(strlen(strval($mobile))==10){
                
        
        move_uploaded_file($tmp_name,"../uploads/$image");
        $insert = mysqli_query($connect, "insert into user (name, mobile, password,address, photo, status, votes, role) values('$name', '$mobile', '$pass', '$add', '$image', 0, 0, '$role') ");
        if($insert){
           
            echo '<script>
            alert("Registration Successful!");
            window.location = "../index.php";
            </script>';
            }    
    }
    else{
        echo '<script>

            alert("Enter 10 digits only!");
           window.location = "../routes/register.php";
            </script>';
    }
}
    else{
        echo '<script>

            alert("Password and confirm password does not match!");
           window.location = "../routes/register.php";
            </script>';
    }
}
    else{
        echo '<script>
                alert("Enter password in format");
                window.location = "../routes/register.php";
            </script>';
    }
    
?>