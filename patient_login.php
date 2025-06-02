<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['unique_id']) && isset($_POST['password'])) {
        $unique_id = $_POST['unique_id'];
        $password = $_POST['password'];

        $conn = new mysqli("localhost", "root", "", "doctors");

        if ($conn->connect_error) {
            die("Failed to connect: " . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("SELECT * FROM patient_registartion WHERE unique_id = ? OR email = ?");
            $stmt->bind_param("ss", $unique_id, $unique_id);
            $stmt->execute();
            $stmt_result = $stmt->get_result();

            if ($stmt_result->num_rows > 0) {
                $data = $stmt_result->fetch_assoc();

                if ($password == $data['password']) {
                    echo "<h2>Login Successfully</h2>";
                    header("Location: patient_dashboard_new.php");
                } else {
                    echo "<h2>Invalid password</h2>";
                }
            } else {
                echo "<h2>Invalid Unique ID</h2>";
            }

            $stmt->close();
            $conn->close();
        }
    } else {
        echo "Please enter both ID and password.";
    }
} else {
    echo "Invalid request method.";
}
?>




