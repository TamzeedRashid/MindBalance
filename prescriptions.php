<?php
$patient_id=$_POST['patient_id'];
$medication=$_POST['medication'];
$dosage=$_POST['dosage'];
$instructions=$_POST['instructions'];
$doctor_id=$_POST['doctor_id'];

$conn=new mysqli('localhost','root','','doctors');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}else{
    $stmt= $conn->prepare("insert into prescriptions(patient_id,medication,dosage,instructions,doctor_id) values(?,?,?,?,?)");
    $stmt->bind_param("isssi",$patient_id,$medication,$dosage,$instructions,$doctor_id);
    $stmt->execute();
    echo "Prescription ADDED";
    $stmt->close();
}
?>