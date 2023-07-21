<?php
@include 'connection.php';

    if(isset($_POST['select_btn'])){
        $all_id= $_POST['select_id'];
        $extract_id =implode(',', $all_id);
        $sql = "INSERT INTO bill_section SELECT * FROM user_vendor_confirmation WHERE id IN($extract_id)";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("location:admin.php");
        }
        else{
            header("location:admin.php");
        }
    }
?>