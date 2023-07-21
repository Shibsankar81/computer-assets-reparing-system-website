<?php
include('connection.php');
session_start();
if(!isset($_SESSION['admin_name'])){
   header('location:loginForm.php');   
}
/////////////////for bill creation//////////////////////
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `bill_section` WHERE complainid = '$remove_id'");
    header('location:admin.php');
 };
 if(isset($_GET['delete_all'])){
    mysqli_query($conn, "TRUNCATE `bill_section`");
    header('location:admin.php');
 }
 
//////////////////////////////////////

if(isset($_POST['register']))
{
    $user_type = $_POST['user_type'];
    $domain_name = $_POST['domainname'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile= $_POST['mobileno'];
    $pass1 = $_POST['password1'];
    $pass2 = $_POST['password2'];

    $select = "SELECT * FROM registration WHERE email='$email' && password='$pass1' ";
    $result = mysqli_query($conn, $select);
    if(mysqli_num_rows($result)>0){
        $error[] = 'user already exit !!';
    }
    else{
        if($pass1 != $pass2){
            $error[] = 'password not matching';
        }
        else{
            $insert = "INSERT INTO registration(usertype,domain,name, email, mobile, password) VALUES('$user_type','$domain_name','$name', '$email', '$mobile', '$pass1')";
            mysqli_query($conn, $insert);

            if($insert){
                ?>
                <script>
                    alert("Thank You your Data will submitted sucessfully");
                </script>
                <?php
            }
            else{
                ?>
                <script>
                    alert("Sorry!! there was problem");
                </script>
                <?php
            }
        }
    }
};

/////////////////////////////////for bill upload///////////////////////////////////////////////
if (isset($_POST['done'])) {
    $mobile = $_POST['mobile'];
    $date = $_POST['date'];
    $img = $_FILES['img']['name'];
    $img_tmp_name = $_FILES['img']['tmp_name'];
    $img_folder = 'upload/'.$img;
    
    $sql="INSERT INTO bill_store(mobile, date, pdf) values('$mobile', '$date', '$img')";
    $query=mysqli_query($conn,$sql);
    if($query){
        move_uploaded_file($img_tmp_name, $img_folder);
        ?>
        <script>
            alert("Thank You your Data will submitted sucessfully");
        </script>
        <?php
        // $message[] = 'product add succesfully';
     }else{
            ?>
                <script>
                    alert("Sorry!! there was problem");
                </script>
            <?php
        // $message[] = 'could not add the product';
     }
  };


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Admin Page</title>
    <!--for datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <div class="side-menu">
    <ul>
        <li><a href="#home" class="active"><span class="fas fa-house"></span>&nbsp; <span>Home</span></a></li>
        <li><a href="#vendor"><span class="fas fa-igloo"></span>&nbsp; <span>Authentication</span></a></li>
        <li><a href="#bill_section"><span class="fas fa-receipt"></span>&nbsp; <span>Bill Creat</span></a></li>
        <li><a href="#finance"><span class="fas fa-coins"></span>&nbsp; <span>finance</span></a></li>
        <li><a href="#Register"  id="login-btn"><span class="fas fa-user-circle"></span>&nbsp; <span>Registration</span></a></li>
        <li><a href="faculty.php"><span class="fas fa-users"></span>&nbsp; <span>faculty</span></a></li>
        <li><a href="logout.php"><span class="fas fa-right-from-bracket"></span>&nbsp; <span>logout</span></a></li>
        <!-- <li> <i class="fas fa-clipboard-list"></i>&nbsp; <span>view</span></li> -->
    </ul>
    </div>

    <header>
        <div class="header">
            <div class="nav">
                <div class="brand-name">
                 <h1>CEMK</h1>              
                 </div>
                <div class="search">
                    <input type="text" class="searchTerm" placeholder="What are you looking for?">
                    <button type="submit" class="searchButton">
                      <i class="fas fa-search"></i>
                   </button>
                </div>
                <div class="user">
                    <div class="img-case">
                    <img src="img1/user_1.png" alt="" onclick="toggleMenu()">
                    </div>
                    <!-- <p onclick="toggleMenu()"> <span class="welcome">Welcome,</span><br>?php echo $_SESSION['admin_name'] ?></p> -->
                    <div class="themes-container" data-aos="zoom-in-right">
                        <div class="theme-toggler">
                            <!-- <span>light</span> -->
                            <span class="toggler"></span>
                            <!-- <span>Dark</span> -->
                        </div>
                    </div>
                </div>
                <div class="sub-menu-wrap" id ="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="img1/cemk.png">
                            <h2><?php echo $_SESSION['admin_name'] ?></h2>
                        </div>
                           
                        <hr>
                        <div class="design">                            
                            <table>
                            <?php
                            $q = "SELECT * FROM registration WHERE name= '$_SESSION[admin_name]'&&usertype='$_SESSION[user_type]'";
                            $details = mysqli_query($conn, $q);
                            $row_details = mysqli_fetch_assoc($details);
                            ?>
                                <tr>
                                    <td>User-Type</td>
                                    <td><?php echo $row_details['usertype']?></td>
                                </tr>
                                <tr>
                                    <td>Depertment</td>
                                    <td><?php echo $row_details['domain']?></td>
                                </tr>
                                <tr>
                                    <td>Gmail</td>
                                    <td><?php echo $row_details['email']?></td>
                                </tr>
                                <tr>
                                    <td>Mobile No</td>
                                    <td><?php echo $row_details['mobile']?></td>
                                </tr>
                                <?php
                                ?>
                            </table>
                           
                        </div> 
                        <hr>
                        <a href="forgot.php"><button>Reset Password</button></a>
                        <a href="editprofile.php"><button>edit profile</button></a>
                    </div>
                </div>
            </div>
        </div>
        </header>


        <!-- --------------------------------- -->
        <section class="container" id="home">
        <div class="content">
            <div class="animated">
                <h2 data-text="ADMIN..PAGE">ADMIN..PAGE</h2>
            </div>
            <div class="cards">
                <div class="card">
                    <div class="box">
                        <h1>
                            <?php
                            $application = "SELECT * FROM problem_store";
                            $application_result = mysqli_query($conn, $application);
                            if($application_catagory_result = mysqli_num_rows($application_result)){
                                echo ' <h1>'.$application_catagory_result.'</h1>';
                            }
                            ?>
                        </h1>
                        <h3>Application</h3>
                    </div>
                    <div class="icon-case">
                    <img src="img1/application.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1><?php
                            $faculty = "SELECT * FROM registration";
                            $faculty_result = mysqli_query($conn, $faculty);
                            if($faculty_catagory_result = mysqli_num_rows($faculty_result)){
                                echo ' <h1>'.$faculty_catagory_result.'</h1>';
                            }
                            ?>
                            </h1>
                        <h3>Total Faculty</h3>
                    </div>
                    <div class="icon-case">
                    <img src="img1/student.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1><?php
                            $vendor = "SELECT * FROM registration WHERE usertype= 'vendor' ";
                            $vendor_result = mysqli_query($conn, $vendor);
                            if($vendor_catagory_result = mysqli_num_rows($vendor_result)){
                                echo ' <h1>'.$vendor_catagory_result.'</h1>';
                            }
                            ?></h1>
                        <h3>Total Vendor</h3>
                    </div>
                    <div class="icon-case">
                    <img src="img1/assistant.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1><?php
                            $finance = "SELECT * FROM registration WHERE usertype= 'user' ";
                            $finance_result = mysqli_query($conn, $finance);
                            if($finance_catagory_result = mysqli_num_rows($finance_result)){
                                echo ' <h1>'.$finance_catagory_result.'</h1>';
                            }
                            ?></h1>
                        <h3>Total User</h3>
                    </div>
                    <div class="icon-case">
                    <img src="img1/student.png" alt="">
                    </div>
                </div>
            </div>

        <!-- ------------------------ -->
        <div class="content2">
            <div class="recent-application">
                <div class="title">
                    <h1>Complaint Records</h1>
                </div>
                <form action="delete.php" method="post">
                <table id="example" class="display nowrap" >
                    <thead>
                        <tr>
                            <th><button type="submit" name="delete_multiple_btn" class="pending">delete</button></th>
                            <th>Sl No</th>
                            <th>ComplainId</th>
                            <th>Name</th>
                            <th>Phone No</th>
                            <th>APP-Date</th>
                            <th>Room No</th>
                            <th>Fin-Date</th>
                            <th>Problem</th>
                            <th>Status</th>
                            <th>Expenditure</th>
                            <th>Payment<br>status</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM problem_store ";
                        $query = mysqli_query($conn, $sql);

                        while($result = mysqli_fetch_array($query))
                    {
                        ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="delete_id[]" value ="<?= $result['id']; ?>">
                            </td>
                            <td><?php echo $result['id']?></td>
                            <td><?php echo $result['complainidno']?></td>
                            <td><?php echo $result['name']?></td>
                            <td><?php echo $result['phone']?></td>
                            <td><?php echo $result['date']?></td>
                            <td><?php echo $result['room']?></td>
                            <td><?php echo $result['finaldate']?></td>
                            <!-- && $result['user_conf']=="Yes" && $result['vendor_conf']=="Yes" -->
                            <!-- LEFT OUTER JOIN user_vendor_confirmation ON problem_store.name = user_vendor_confirmation.name -->
                            <td><?php echo $result['problem']?></td>
                            <td>
                                <?php
                                    if($result['userconf']=="Yes" && $result['vendorconf']=="Yes" ){
                                        echo '<button class="done">done</button>';
                                    }
                                    else{
                                       echo '<button class="pending">pending</button>';
                                    }
                                ?>
                            </td>                            
                            <td><?php echo $result['expandiature']?>.00 /-</td>

                            <td>
                            <?php
                                  if($result['status']==1){
                                      echo '<button class="done">done</button>';
                                    }           
                                   else{
                                      echo '<button class="pending">pending</button>';
                                    }           

                            ?>
                            </td>
                        </tr>
                    <?php
                    }
                        ?>
                    
                   
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Delete</th>
                            <th>Sl No</th>
                            <th>ComplainId</th>
                            <th>Name</th>
                            <th>Ph-No</th>
                            <th>Date</th>
                            <th>Room-No</th>
                            <th>finalDate</th>
                            <th>Problem</th>
                            <th>status</th>
                            <th>Expenditure</th>
                            <th>Payment<br>status</th>
                        </tr>
                    </tfoot>
                    </table>
                </form>

            </div>

        </div>


        </div>
    </section>

<!-- --------------------------------Authentication Check---------------------------------------- -->
    <section class="book" id="vendor">

        <h1 class="heading">
            <span>A</span>
            <span>U</span>
            <span>T</span>
            <span>H</span>
            <span>E</span>
            <span>N</span>
            <!-- <span class="space"></span> -->
            <span>T</span>
            <span>I</span>
            <span>C</span>
            <span>A</span>
            <span>T</span>
            <span>I</span>
            <span>O</span>
            <span>N</span>
        </h1>

        <div class="row">
            <div class="authentication-vendor">
                <div class="title">
                    <h3>User & Vendor Confirmation</h3>
                </div>
                <form action="delete.php" method="post">
                <table id="example" class="display nowrap" >
                    <thead>
                        <tr>
                            <th><button type="submit" name="delete_btn" class="pending">delete</button></th>
                            <th><button type="submit" name="select_btn" class="select">select<br>for bill</button></th>
                            <th>Sl No</th>
                            <th>ComplainID</th>
                            <th>Name</th>                           
                            <th>Room No</th>
                            <th>Problem</th>
                            <th>user-conf</th>
                            <th>vendor-conf</th>
                            <th>Expenditure</th>
                            <th>Break-up<br>Details</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM user_vendor_confirmation";
                        $query = mysqli_query($conn, $sql);

                        while($result = mysqli_fetch_array($query))
                    {
                        ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="delete_id[]" value ="<?= $result['id']; ?>">
                            </td>
                            <!-- --------------------------- -->
                            <td>
                                <input type="checkbox" name="select_id[]" value ="<?= $result['id']; ?>">
                            </td>
                            <!-- -------------------------------------- -->
                            <td><?php echo $result['id']?></td>
                            <td><?php echo $result['jobid']?></td>
                            <td><?php echo $result['name']?></td>
                            <td><?php echo $result['room']?></td>
                            <td><?php echo $result['problem']?></td>
                            <td>
                            <?php
                                    if($result['user_conf']=="Yes"){
                                        echo '<button class="done">Yes</button>';
                                    }
                                    else{
                                       echo '<button class="pending">No</button>';
                                    }
                                ?>
                            </td>
                            <td>
                            <?php
                                    if($result['vendor_conf']=="Yes"){
                                        echo '<button class="done">Yes</button>';
                                    }
                                    else{
                                       echo '<button class="pending">No</button>';
                                    }
                                ?>
                            </td>
                            <td><?php echo $result['price']?>.00 /-</td>
                            <td><?php echo $result['breakup']?>...</td>
                        </tr>
                    <?php
                    }
                        ?>
                        </tbody>
                        </table>
                        </form>
                </div>
                </div>
           
    </section>

    <!-- ---------------------------bill section---------------------------------- -->

<section class="shopping-cart" id="bill_section">

    <h1 class="heading">
            <span>B</span>
            <span>I</span>
            <span>L</span>
            <span>L</span>
            <span class="space"></span>
            <span>G</span>
            <span>E</span>
            <span>N</span>
            <span>E</span>
            <span>R</span>
            <span>A</span>
            <span>T</span>
            <span>I</span>
            <span>O</span>
            <span>N</span>
    </h1>
        <div class="bill_generet">
            <div class="bill">
                <div class="title">
                <h2>Bill Generate</h2>
                </div>
            <table id="tblCustomers" cellspacing="0" cellpadding="0">

                <thead>
                    <tr>
                    <th>ComplainId</th>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Problem</th>
                    <th>Description</th>
                    <th>total price</th>
                    <th>action</th>
                    </tr>
                </thead>

                <tbody>
                <?php 
                    
                    $select_cart = mysqli_query($conn, "SELECT * FROM `bill_section`");
                    $grand_total = 0;
                    if(mysqli_num_rows($select_cart) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    ?>
                    <tr>
                        <td><?php echo $fetch_cart['complainid'] ?></td>
                        <td><?php echo $fetch_cart['name'] ?></td>
                        <td><?php echo $fetch_cart['room'] ?></td>
                        <td><?php echo $fetch_cart['problem'] ?></td>
                        <td><?php echo $fetch_cart['breakup'] ?></td>
                        <td><?php echo $fetch_cart['price'] ?>.00 /-</td>
                        <td><a href="admin.php?remove=<?php echo $fetch_cart['complainid']; ?>" onclick="return
                        confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
                        </tr>
                    <?php
                    $grand_total += $fetch_cart['price'];

                        };
                    };
                    ?>
                    <tr class="table-bottom">
                        <!-- <td></td> -->
                        <td><a href="#vendor" class="btn1" style="margin-top:0">continue add</a></td>
                        <td colspan="4"><p>Grand Total</p></td>
                        <!-- <td></td> -->
                        <td><?php echo $grand_total; ?>.00/-</td>
                        <td><a href="admin.php?delete_all" 
                        onclick="return confirm('are you sure you want to delete all?');"
                        class="delete-btn"> <i class="fas fa-trash"></i> delete all </a>
                        </td>
                    </tr>
                </tbody>

   </table>
   <br />
    <input type="button" id="btnExport" value="download pdf" />
   </div>
    </div>

</section>
<!-- ------------------------------bill sending -------------------------------------------- -->

<section class="register" id="finance">

            <h1 class="heading">
                <span>C</span>
                <span>O</span>
                <span>N</span>
                <span>F</span>
                <span>I</span>
                <span>R</span>
                <span>M</span>
                <span>A</span>
                <span>T</span>
                <span>I</span>
                <span>O</span>
                <span>N</span>
            </h1>
            <div class="row">
                <div class="details1">
                <div class="details-header">
                    <h2>Recent Sending Bill </h2>
                </div>
                <form action="delete.php" method="post">
                <table>
                            <thead>
                                <tr>
                                    <th><button type="submit" name="deletebill_btn" class="pending">delete</button></th>
                                    <th>Sl No</th>
                                    <th>Mobile No</th>
                                    <!-- <th>Name</th> -->
                                    <th>Date</th>
                                    <!-- <th>Room-No</th> -->
                                    <th>File</th>
                                    <th>Payment<br>status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $sql = "SELECT * FROM bill_store";
                                $query = mysqli_query($conn, $sql);

                                while($result = mysqli_fetch_array($query))
                            {
                                ?>
                                <tr>
                                    <td>
                                    <input type="checkbox" name="deletebill_id[]" value ="<?= $result['id']; ?>">
                                    </td>
                            
                                    <td><?php echo $result['id']?></td>
                                    <td><?php echo $result['mobile']?></td>
                                    <td><?php echo $result['date']?></td>
                                    <td><a href="upload/<?php echo $result['pdf']; ?>"><?php echo $result['pdf'] ?></a></td>
                                     <!-- ---<embed type="application/pdf" src="upload/" height="70" width="100">------- -->
                                    <td>
                                        <?php
                                            if($result['status']==1){
                                                echo '<button class="done">done</button>';
                                            }           
                                            else{
                                                echo '<button class="pending">pending</button>';
                                            }           

                                        ?>
                                    </td>

                                </tr>    
                          <?php  
                    }
                        ?>
                            
                                </tbody>
                    </table>
                </form>
                </div>
            <div class="registration-page">
        
                <form action="" method="post" enctype="multipart/form-data">
                    <h2>Bill Send To Finance</h2>
                    <div class="input-name">
                        <input type="number" name="mobile" required>
                        <span>Mobile No</span>
                    </div>
                    <div class="input-name">
                        <input type="date" name="date" required>
                    </div>

                    <div class="input-name">
                            <input type="file" type="file" name="img" value="" required>
                        </div> 
                    <div class="input-name">
                        <input type="submit" name="done" class="btn">
                    </div>
        
                </form>
            </div>
            </div>   
        </section>

<!-- ---------------------------------------Registration----------------------------- -->
<section class="register" id="Register">

    <h1 class="heading">
        <span>R</span>
        <span>E</span>
        <span>G</span>
        <span>I</span>
        <span>S</span>
        <span>T</span>
        <span>R</span>
        <span>A</span>
        <span>T</span>
        <span>I</span>
        <span>O</span>
        <span>N</span>
    </h1>
    <div class="row">
        <div class="details">
            <img src="img1/cemk.png" alt="">
            <p>This form is contain the registration details and the registration data will be saved in faculty database. If any one of college(faculty, finance Depertment, vendor) want to join this website then first he/she registration his/her details through admin.After completion his/her registration he/she change his/her password using forgot-passwod and easily he/she use all the availablity of this website.</p>
        </div>
    <div class="registration-page">

        <form action="" method="POST">
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                }
            }
            ?>
            <h2>Register Now</h2>
            <div class="input-name">
                <select name="user_type" id="" class="problem" required>
                    <option value="User">User</option>
                    <option value="Admin">Admin</option>
                    <option value="Finance">Finance</option>
                    <option value="Vendor">Vendor</option>
                </select>
                <!-- <span>User Type</span> -->
            </div>
            <div class="input-name">
                <select name="domainname" id="" class="problem" required>
                    <option>Select your Domain</option>
                    <option value="CSE">CSE</option>
                    <option value="IT">IT</option>
                    <option value="ECE">ECE</option>
                    <option value="EE">EE</option>
                    <option value="ME">ME</option>
                    <option value="Vendor">Vendor</option>
                    <option value="Finance">Finance</option>
                </select>
            </div>
            <div class="input-name">
                <input type="text" name="name" required >
                <span>Full Name</span>
            </div>
            <div class="input-name">
                <input type="Email" name="email" required >
                <span>Email</span>
            </div>
            <div class="input-name">
                <input type="number" name="mobileno" required >
                <span>phone No</span>
            </div>
            <div class="input-name">
                <input type="password" name="password1" required >
                <span>password</span>
            </div>
            <div class="input-name">
                <input type="password" name="password2" required >
                <span>Confirm password</span>
            </div>
            <div class="input-name">
                <input type="submit" name="register" class="btn">
            </div>

        </form>
    </div>
    </div>


    </section>

<!-- ----footer--------------------------- -->
    <section class="footer">

        <div class="box-container" data-aos="fade-up">
            <div class="box">
                <h3>about us</h3>
                <p>This website is using for computer -Assets reparing system for any organization. Website contain Amin Page, User Page, Vendor page. Using this website any user of any organization requisition his/her details then all the data will goes to admin and vendor after complition of the work user and vendor gives his/her work-complete conformation. After Admin verification admin send complition-details to the finance and payment will done by finance to the vendor.</p>
            </div>
            <div class="box">
                <h3>vendor side</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, cupiditate consequatur tempore placeat minus numquam nam rem dolores, modi illo dignissimos assumenda? Animi libero eaque provident iure repellat doloribus unde.</p>

            </div>
            <div class="box">
                <h3>quick links</h3>
                <a href="#home">home</a>
                <a href="#vendor">vendor</a>
                <a href="#Registration">Registration</a>
                <a href="#>faculty">faculty</a>
        </div>
        </div>
    <h1 class="credit">created by<span> our Team</span> | all rights reserved!</h1>
    
    </section>









<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>    
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<!-- ------------------------------------------------------ -->
<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<!-- -------------------------------------------------------------- -->
<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            // 'copy', 'csv', 'excel', 'pdf', 'print'
            'excel', 'print'
        ]
    } );
} );

    let subMenu = document.getElementById("subMenu");

    function toggleMenu(){
        subMenu.classList.toggle("open-menu");
    }
    window.onscroll = () =>{
            subMenu.classList.remove('open-menu');
            }

let themeToggler = document.querySelector('.theme-toggler');
themeToggler.onclick = () =>{
themeToggler.classList.toggle('active');

if(themeToggler.classList.contains('active')){
document.body.classList.add('active');
}else{
document.body.classList.remove('active');
}
}
// --------------------------------------------------------------------------
        $("body").on("click", "#btnExport", function () {
            html2canvas($('#tblCustomers')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Bill-details.pdf");
                }
            });
        });
// -----------------------------------------------------------------------------


    </script>










</body>
</html>
