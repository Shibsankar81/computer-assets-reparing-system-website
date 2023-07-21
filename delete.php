<?php
@include 'connection.php';

    if(isset($_POST['delete_multiple_btn'])){
        $all_id= $_POST['delete_id'];
        $extract_id =implode(',', $all_id);
        $sql = "DELETE FROM problem_store WHERE id IN($extract_id)";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("location:admin.php#home");
        }
        else{
            header("location:admin.php#home");
        }
    }
    if(isset($_POST['delete_btn'])){
        $all_id= $_POST['delete_id'];
        $extract_id =implode(',', $all_id);
        $sql = "DELETE FROM user_vendor_confirmation WHERE id IN($extract_id)";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("location:admin.php#vendor");
        }
        else{
            header("location:admin.php#vendor");
        }
    }


    if(isset($_POST['deletebill_btn'])){
        $all_id= $_POST['deletebill_id'];
        $extract_id =implode(',', $all_id);
        $sql = "DELETE FROM bill_store WHERE id IN($extract_id)";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("location:admin.php#finance");
        }
        else{
            header("location:admin.php#finance");
        }
    }


    if(isset($_POST['select_btn'])){
        $forall_id= $_POST['select_id'];
        $extract_id =implode(',', $forall_id);
        $sql = "INSERT INTO bill_section (SELECT * FROM user_vendor_confirmation WHERE id IN($extract_id)) ";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("location:admin.php#bill_section");
        }
        else{
            header("location:admin.php#bill_section");
        }
    }

?>