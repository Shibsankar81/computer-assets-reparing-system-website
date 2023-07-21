<?php

@include 'connection.php';

session_start();
$rand= rand(9999,1000000);
if(!isset($_SESSION['user_name'])){
   header('location:loginForm.php');
}
if(isset($_POST['submit'])){
    $captcha = $_POST['captcha'];
    $captcharandom = $_POST['captcha-rand'];
    // $name = mysqli_real_escape_string($conn, $_POST['name']);
    $name = $_SESSION['user_name'];
    $phone = $_POST['phnumber'];
    $date = $_POST['date'];
    $room = $_POST['room'];
    $finaldate = $_POST['finaldate'];
    $problem = $_POST['asset'];

    if($captcha != $captcharandom){
        ?>
        <script type="text/javascript">
        alert("invalid captcher code");
        </script>
        <?php
    }
    else{

    $insert = "INSERT INTO problem_store(complainidno, name, phone, date, room, finaldate, problem) VALUES('$captcharandom', '$name', '$phone', '$date', '$room', '$finaldate', '$problem')";
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

if(isset($_POST['done'])){
    $name = $_SESSION['user_name'];
    $jobid = $_POST['jobid'];
    $room = $_POST['room'];
    $problem = $_POST['problem'];
    $confirmation = $_POST['confirmation'];

    $insert = "INSERT INTO user_vendor_confirmation(jobid,name, room, problem, user_conf) VALUES('$jobid','$name', '$room', '$problem', '$confirmation')";
    $result = mysqli_query($conn, $insert);

    if($result==1){
        $upd = "UPDATE problem_store set userconf='$confirmation' WHERE complainidno='$jobid'";
        $query = mysqli_query($conn, $upd);
    

    if($query){
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



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>User_Page</title>
</head>
<body>
    <nav class="navbar">
        <div class="brand-name">
        <h4>CEMK</h4>
        </div>
        <div class="search">
            <input type="text" class="searchTerm" placeholder="What are you looking for?">
            <button type="submit" class="searchButton">
              <i class="fas fa-search"></i>
           </button>
        </div>
        <div class="profile">
            <div class="img-case">
                <img src="img1/user.png" onclick="toggleMenu()">
            </div>                  
        </div>
        <div class="sub-menu-wrap" id ="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="img1/user.png" alt="">
                            <h2><?php echo $_SESSION['user_name'] ?></h2>
                        </div>
                           
                        <hr>
                        <div class="design">
                            <table>
                            <?php
                            $q = "SELECT * FROM registration WHERE name= '$_SESSION[user_name]'&&usertype='$_SESSION[user_type]'";
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
        
    </nav>
    <!-- --------------------------------sidebar----------------------- -->
    <input type="checkbox" id="toggle">
    <label for="toggle" class="side-toggle"><span class="fas fa-bars"></span></label>

    <div class="sidebar">
       <div class="sidebar-menu">
        <a href="#home">
            <span class="fas fa-house"></span>
            <p>Home</p>
        </a>
        </div>

        <div class="sidebar-menu">
            <a href="">
            <span class="fas fa-envelope email"></span>
            <p>Authentication</p>
            </a>
        </div>

        <div class="sidebar-menu">
            <a href="logout.php">
            <span class="fas fa-right-from-bracket"></span>
            <p>log-out</p>
            </a>
        </div>
    </div>
    

    <main>
    <div class="content">
        <div class="animated">
            <h2 data-text="USER..PAGE">USER..PAGE</h2>
        </div>
        </div>

        <section class="query" id="home">
            <div class="row">
                <div class="details">
                    <img src="img1/cemk.png" alt="">
                    <p>This form is contain requisition data from user(college faculty, college Staff) and when user log-in this website when he/she fillup this form the data will goes to vendor and Admin database. After the Admin verification vendor will complete his work with in the final days. </p>
                </div>

                <div class="problem-page">
                    <h2> Requisition Send to Admin</h2>
                    <form action="" method="Post">
                        <!-- <div class="input-name">
                            <input type="name" name="name" required>
                            <span>Full Name</span>
                        </div>       -->
                        <div class="input-name">
                            <input type="text" name="room" required>
                            <span>Your Room No</span>
                        </div> 
                        <div class="input-name">
                            <input type="number" name="phnumber" required>
                            <span>phone number</span>
                        </div> 
                        <div class="input-name">
                            <p>Apply Date</p>
                            <input type="date" name="date" required>
                        </div>
                        <div class="input-name">
                        <p>Expect Date</p>
                            <input type="date" name="finaldate" required>
                        </div>
                        <div class="input-name">
                            <select name="asset" id="" class="problem" required>
                                    <option>Select your problem</option>
                                    <option value="Computer">Computer</option>
                                    <option value="Projecter">Projecter</option>
                                    <option value="Printer">printer</option>
                                    <option value="LAN">LAN</option>
                                    <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="input-name">
                             <input type="text" name="captcha" id="captcha" required>
                             <span>Enter Code</span>
                             <input type="hidden" name="captcha-rand" value="<?php echo $rand; ?>">
                         </div>

                         <div class="input-name">
                             <label for="">captcha-code</label>
                             <div class="captcha"><?php echo $rand ?></div>
                         </div>

                        <div class="input-name">
                            <input type="submit" name="submit" class="btn btn1">
                        </div>
                    </form>
            </div>
            </div>

        </section>

        <section class="register" id="Register">

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
                    <h2>Your Recent Complain</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <!-- <th>Sl No</th> -->
                            <th>ComplainId</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Room-No</th>
                            <th>Problem</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM problem_store WHERE name= '$_SESSION[user_name]'";
                        $query = mysqli_query($conn, $sql);

                        while($result = mysqli_fetch_array($query))
                    {
                        ?>
                        <tr>
                            
                            <td><?php echo $result['complainidno']?></td>
                            <td><?php echo $result['name']?></td>
                            <td><?php echo $result['date']?></td>
                            <td><?php echo $result['room']?></td>
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
                          <?php  
                    }
                        ?>
                        </tbody>
                        </table>
                </div>
            <div class="registration-page">
        
                <form action="" method="post">
                    <h2>User Confirmation</h2>

                    <div class="input-name">
                        <input type="text" name="jobid" required >
                        <span>Enter JobId No</span>
                    </div>

                    <!-- <div class="input-name">
                        <input type="text" name="name" required >
                        <span>Full Name</span>
                    </div> -->
                    <div class="input-name">
                        <input type="text" name="room" required >
                        <span>Room No</span>
                    </div>
                    <!-- <div class="input-name">
                        <input type="date" name="date" required>
                    </div> -->
                    <div class="input-name">
                        <input type="text" name="problem" required >
                        <span>Problem</span>
                    </div>
                    <div class="input-name">
                        <select name="confirmation" id="" class="problem" required>
                            <option>Select your conformation</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                    </select>
                    </div>
                    <div class="input-name">
                        <input type="submit" name="done" class="btn">
                    </div>
        
                </form>
            </div>
            </div>   
        </section>
    </main>
        <section class="footer">

            <div class="box-container" data-aos="fade-up">
                <div class="box">
                    <h3>about us</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis unde voluptatum, fugiat totam explicabo reprehenderit placeat molestiae laboriosam praesentium amet quam aliquam quod mollitia omnis!</p>
                </div>
                <div class="box">
                    <h3>Admin side</h3>
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


        <script>
             let subMenu = document.getElementById("subMenu");
             function toggleMenu(){
             subMenu.classList.toggle("open-menu");
            }
            window.onscroll = () =>{
            subMenu.classList.remove('open-menu');
            }
        </script>
</body>
</html>