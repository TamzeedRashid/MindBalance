<?php
$name=$_POST['name'];
$unique_id=$_POST['unique_id'];
$email=$_POST['email'];
$password =$_POST['password'];
$address=$_POST['address'];
$age=$_POST['age'];
$gender=$_POST['gender'];

$conn=new mysqli('localhost','root','','doctors');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}else{
    $stmt= $conn->prepare("insert into patient_registartion(name,unique_id,email,password,address,age,gender) values(?,?,?,?,?,?,?)");
    $stmt->bind_param("sisssis",$name,$unique_id,$email,$password,$address,$age,$gender);
    $stmt->execute();
    echo "registration successfully";
	header("Location: patient_login(1).php");
    $stmt->close();
    $conn->close();
}
?>