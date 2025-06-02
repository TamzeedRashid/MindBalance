<?php
$name=$_POST['name'];
$unique_id=$_POST['unique_id'];
$email=$_POST['email'];
$password =$_POST['password'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$experience=$_POST['experience'];

$conn=new mysqli('localhost','root','','doctors');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}else{
    $stmt= $conn->prepare("insert into doctor_registration(name,unique_id,email,password,age,gender,experience) values(?,?,?,?,?,?,?)");
    $stmt->bind_param("sissisi",$name,$unique_id,$email,$password,$age,$gender,$experience);
    $stmt->execute();
    echo "registration successfully";
	header("Location: doctor_login(1).php"); 
    $stmt->close();
    $conn->close();
}
?>