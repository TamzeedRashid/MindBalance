<?php
$doctor_id=$_POST['doctor_id'];
$appointment_date=$_POST['appointment_date'];
$appointment_time=$_POST['appointment_time'];
$patient_id=$_POST['patient_id'];

$conn=new mysqli('localhost','root','','doctors');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}else{
    $stmt= $conn->prepare("insert into appointment(doctor_id,patient_id,appointment_date,appointment_time) values(?,?,?,?)");
    $stmt->bind_param("iiss",$doctor_id,$patient_id,$appointment_date,$appointment_time);
    $stmt->execute();
    echo "Doctor Appointed";
    $stmt->close();
}
?>
