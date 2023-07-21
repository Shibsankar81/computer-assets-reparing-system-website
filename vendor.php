<?php

@include 'connection.php';

session_start();

if(!isset($_SESSION['vendor_name'])){
   header('location:loginForm.php');
}


if(isset($_POST['submit'])){
    //$name = mysqli_real_escape_string($conn, $_POST['name']);
    $jobid = $_POST['jobid'];
    //$date = $_POST['date'];
    $expandiature = $_POST['expandiature'];
    // $problem = $_POST['problem'];
    $confirmation = $_POST['confirmation'];
    $breakup = $_POST['breakup'];

    // $insert = "INSERT INTO user_vendor_confirmation(date, vendor_conf) VALUES( '$date', '$confirmation') WHERE name='$name'";
    $insert = "UPDATE user_vendor_confirmation set vendor_conf='$confirmation', price='$expandiature', breakup='$breakup' WHERE jobid='$jobid'";
    mysqli_query($conn, $insert);

    if($insert){
        $upd = "UPDATE problem_store set vendorconf='$confirmation',expandiature='$expandiature' WHERE complainidno='$jobid'&&userconf='Yes'";
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="vendor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>vendor page</title>
</head>
<body>

     <!-- -------------------------header----------------------- -->
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
                    <img src="img1/user.png" alt="" onclick="toggleMenu()">
                    </div>
        </div>
        <div class="sub-menu-wrap" id ="subMenu">
                    <div class="sub-menu">
                    <div class="user-info">
                            <img src="img1/user.png" alt="">
                            <h2><?php echo $_SESSION['vendor_name'] ?></h2>
                        </div>
                           
                        <hr>
                        <div class="design">
                            <table>
                            <?php
                            $q = "SELECT * FROM registration WHERE name= '$_SESSION[vendor_name]'&&usertype='$_SESSION[user_type]'";
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
            <a href="#user_conf">
            <span class="fas fa-igloo"></span>
            <p>Confirmation</p>
            </a>
        </div>

        <div class="sidebar-menu">
            <a href="logout.php">
            <span class="fas fa-right-from-bracket"></span>
            <p>log-out</p>
            </a>
        </div>
    </div>
    <!-- -------------maindashboard---------- -->
    
    <main>
    <div class="content">
        <div class="animated">
            <h2 data-text="VENDOR..PAGE">VENDOR..PAGE</h2>
        </div>
        </div>
           
        <section class="dashboard-container" id="home">
            <div class="card detail">
                <div class="details-header">
                    <h2>All the Details</h2>
                </div>
                <table id="example" class="display nowrap" >
                    <thead>
                        <tr>
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
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM problem_store";
                        $query = mysqli_query($conn, $sql);

                        while($result = mysqli_fetch_array($query))
                    {
                        ?>
                        <tr>
                            <td><?php echo $result['id']?></td>
                            <td><?php echo $result['complainidno']?></td>
                            <td><?php echo $result['name']?></td>
                            <td><?php echo $result['phone']?></td>
                            <td><?php echo $result['date']?></td>
                            <td><?php echo $result['room']?></td>
                            <td><?php echo $result['finaldate']?></td>
                            <td><?php echo $result['problem']?></td>
                            <td>
                                <?php
                                    if($result['userconf']=="Yes" && $result['vendorconf']=="Yes"){
                                        echo '<button class="done">Done</button>';
                                    }
                                    else{
                                       echo '<button class="pending">Pending</button>';
                                    }
                                ?>
                            </td>
                            <td><?php echo $result['expandiature']?>.00/-</td>
                        </tr>
                    <?php
                    }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
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
                        </tr>
                    </tfoot>
                </table>
    </div>
            
        </section>
        <!-- ------------------------------------user conf--------------------------------------------- -->
        <section class="dashboard-container" id="user_conf">
        <h1 class="heading">
                <span>A</span>
                <span>U</span>
                <span>T</span>
                <span>H</span>
                <span>E</span>
                <span>N</span>
                <span>T</span>
                <span>I</span>
                <span>C</span>
                <span>A</span>
                <span>T</span>
                <span>I</span>
                <span>O</span>
                <span>N</span>
            </h1>

            <div class="card detail">
                <div class="details-header">
                    <h2>User Confirmation</h2>
                </div>



                <table id="example" class="display nowrap" >
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>ComplainId</th>
                            <th>Name</th>
                            <!-- <th>Ph-No</th> -->
                            <!-- <th>Date</th> -->
                            <th>Room-No</th>
                            <!-- <th>finalDate</th> -->
                            <th>Problem</th>
                            <th>User_conf</th>
                            <th>Vendor_conf</th>
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
                        </tr>
                    <?php
                    }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="card customer">
                <div class="login-page">
                    <h2>Work Order Completion</h2>
                    <form action="" method="post">
                        <div class="input-name">
                            <input type="text" name="jobid" required>
                            <span>Enter JobId</span>
                        </div>       
                        <div class="input-name">
                        <select name="confirmation" id="" class="problem" required>
                            <option>Select your conformation</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        </div>
                        <div class="input-name">
                            <input type="text" name="expandiature" required>
                            <span>Expandiature</span>
                        </div>
                        <div class="input-name">
                            <input type="text" name="breakup" required>
                            <span>Break-up Details</span>
                        </div>
                        <div class="input-name">
                            <input type="submit" name="submit" class="btn btn1">
                        </div>
                    </form>
            </div>
            </div>
            
        </section>







        <!-- --------------------------------------------------------------------------------------------------- -->
</main>
        <section class="footer">

            <div class="box-container" data-aos="fade-up">
                <div class="box">
                    <h3>about us</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis unde voluptatum, fugiat totam explicabo reprehenderit placeat molestiae laboriosam praesentium amet quam aliquam quod mollitia omnis!</p>
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
<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
             'excel', 'pdf', 'print'
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
</script>

</body>
</html>