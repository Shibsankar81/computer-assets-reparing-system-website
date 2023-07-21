<?php
include('connection.php');
session_start();
if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM registration WHERE email='".$email."' && password='".$pass."' && usertype='".$user_type."' ";
    $result = mysqli_query($conn, $select);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        if($row['usertype'] == 'Admin'){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['user_type'] = $row['usertype'];
            $_SESSION['gmail'] = $row['gmail'];
            $_SESSION['depertment'] = $row['domain_name'];
            header('location:admin.php');
        }
        elseif($row['usertype'] == 'User'){
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_type'] = $row['usertype'];
            $_SESSION['email'] = $row['email'];
            header('location:userpage.php');
        }
        elseif($row['usertype'] == 'Vendor'){
            $_SESSION['vendor_name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['user_type'] = $row['usertype'];
            header('location:vendor.php');
        }
        elseif($row['usertype'] == 'Finance'){
            $_SESSION['finance_name'] = $row['name'];
            $_SESSION['user_type'] = $row['usertype'];
            $_SESSION['email'] = $row['email'];
            header('location:finance.php');
        }

    }
    else{
        $error[] = 'incorrect email or password';
    }
};
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div class="content">
        <div class="animated">
            <h2 data-text="WELCOME TO OUR COLLEGE OF ENGINEERING & MANAGEMENT, KOLAGHAT">WELCOME TO OUR COLLEGE OF ENGINEERING & MANAGEMENT, KOLAGHAT</h2>
        </div>
        </div>
    
    <div class="container">
        <div class="form1 signin">
            <h2>Sign In</h2>
            <form action="" method="post">
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class= "error-msg">'.$error.'</span>';
                    };
                };
                ?>
            <div class="inputBox">
                <select name="user_type" id="" class="problem" required>
                    <option value="">Select User_type</option>
                    <option value="User">User</option>
                    <option value="Admin">Admin</option>
                    <option value="Finance">Finance</option>
                    <option value="Vendor">Vendor</option>
                </select>
            </div>
            <div class="inputBox">
                <input type="Email" name="email" required="required">
                <i class="fa-regular fa-user"></i>
                <span>Email Id</span>
            </div>
            <div class="inputBox">
                <input type="password" name="password" required="required">
                <i class="fa-solid fa-lock"></i>
                <span>password</span>
            </div>

            <div class="inputBox">
                <input type="submit" name="submit" value="login">
            </div>
        </form>
            <p>For create Account ? <a href="#" class="create">create</a> </p>  
            <p>For change your password? <a href="forgot.php" >forgotpassword</a> </p>       
        </div>
        <div class="form1 signup">
            <h2>Sign Up</h2>
            <div class="inputBox">
            <p>This website only for college Faculty and staff, so if you have no account,
                 you contact our admin faculty.
            </p>
            </div>
            <p>Already have Account ? <a href="#" class="login">login</a> </p>         
        </div>
        </div>
    

    <script>
        let login = document.querySelector('.login');
        let create = document.querySelector('.create');
        let container = document.querySelector('.container');

        create.onclick = function(){
            container.classList.add('signupForm');
        }
        login.onclick = function(){
            container.classList.remove('signupForm');
        }
    </script>
</body>
</html>