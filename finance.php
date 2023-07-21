<?php

@include 'connection.php';

session_start();

if(!isset($_SESSION['finance_name'])){
  header('location:loginForm.php');
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
    <link rel="stylesheet" href="finance.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Finance Page</title>
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
                            <h2><?php echo $_SESSION['finance_name'] ?></h2>
                        </div>
                           
                        <hr>
                        <div class="design">
                            <table>
                            <?php
                            $q = "SELECT * FROM registration WHERE name= '$_SESSION[finance_name]'&&usertype='$_SESSION[user_type]'";
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

        <!-- <div class="sidebar-menu">
            <a href="#user_conf">
            <span class="fas fa-igloo"></span>
            <p>Confirmation</p>
            </a>
        </div> -->

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
            <h2 data-text="FINANCE..PAGE">FINANCE..PAGE</h2>
        </div>
        </div>
           
        <section class="dashboard-container" id="home">
            <div class="card detail">
                <div class="details-header">
                    <h2>All Payment Order List</h2>
                </div>
                <table id="example" class="display nowrap" >
                <thead>
                        <tr>
                            <th>ComplainId</th>
                            <th>Name</th>
                            <th>Room No</th>
                            <th>Problem</th>
                            <th>Job Status</th>
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
                            <td><?php echo $result['complainidno']?></td>
                            <td><?php echo $result['name']?></td>
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
                            <td><?php echo $result['expandiature']?>.00 /-</td>
                            <td>
                            <?php
                                  if($result['status']==1){
                                      echo '<button class="done"><a href="payment_status.php?id='.$result['id'].'&status=0">done</a></button>';
                                    }           
                                   else{
                                      echo '<button class="pending"><a href="payment_status.php?id='.$result['id'].'&status=1">pending</a></button>';
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
                            <th>ComplainId</th>
                            <th>Name</th>
                            <th>Room-No</th>
                            <th>Problem</th>
                            <th>Job Status</th>
                            <th>Expenditure</th>
                            <th>Payment<br>status</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            
        </section>

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

        <div class="card detail">
                <div class="details-header">
                    <h2>Recent Bill From Admin</h2>
                </div>
                <table id="example" class="display nowrap" >
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Date</th>
                            <th>Ph-No</th>
                            <th>Bill Pdf</th>
                            <th>status</th>
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
                            
                                    <td><?php echo $result['id']?></td>
                                    <td><?php echo $result['mobile']?></td>
                                    <td><?php echo $result['date']?></td>
                                    <td class="pdfbtn"><a href="upload/<?php echo $result['pdf']; ?>"><?php echo $result['pdf'] ?></a></td>
                                     <!-- ---<embed type="application/pdf" src="upload/" height="70" width="100">------- -->
                                    <td>
                                        <?php
                                            if($result['status']==1){
                                                echo '<button class="done"><a href="status.php?id='.$result['id'].'&status=0">done</a></button>';
                                            }           
                                            else{
                                                echo '<button class="pending"><a href="status.php?id='.$result['id'].'&status=1">pending</a></button>';
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


</section>

<!-- <section class="footer">

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
</div>
</div>
<h1 class="credit">created by<span> our Team</span> | all rights reserved!</h1>

</section> -->


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