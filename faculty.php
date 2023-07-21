<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="faculty.css">
    <title>Faculty page</title>
</head>
<body>
    <div class="container">
        <div class="title">
            <h2>All Faculty Records</h2>
        </div>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>SL No</th>
                <th>Name</th>
                <th>Email</th>
                <th>PhoneNo</th>
                <th>Depertment</th>
                <th>User-type</th>
                <!-- <th>password</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
                include('connection.php');
                $sql = "SELECT * FROM registration";
                $query = mysqli_query($conn, $sql);
                while($result = mysqli_fetch_array($query))
                {
                    ?>
                    <tr>
                        <td><?php echo $result['id']?></td>
                        <td><?php echo $result['name']?></td>
                        <td><?php echo $result['email']?></td>
                        <td><?php echo $result['mobile']?></td>
                        <td><?php echo $result['domain']?></td>
                        <td><?php echo $result['usertype']?></td>
                </tr>
                <?php

        
                }
            ?>
        </tbody>
        <!-- <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot> -->
    </table>
    </div>



    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> 
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
 -->

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>    
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
   <script>
     $(document).ready(function () {
        $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    });
   </script>
</body>
</html>