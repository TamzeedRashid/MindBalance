<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard - MindBalance</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f0f4f8;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(108, 164, 196, 0.2), rgba(116, 196, 188, 0.2));
            z-index: -2;
        }

        .navbar {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
            display: flex;
            justify-content: center;
            gap: 60px;
        }

        .navbar a {
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: #1e3a5f;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            padding: 5px 10px;
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: #2c5282;
            animation: textPulse 0.5s ease infinite;
        }

        .navbar a::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #2c5282, #63b3ed);
            transition: width 0.3s ease, left 0.3s ease;
        }

        .navbar a:hover::before {
            width: 100%;
            left: 0;
        }

        @keyframes textPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .container {
            margin-top: 100px;
            max-width: 1200px;
            width: 100%;
            flex-grow: 1;
        }

        .section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .section:hover {
            transform: translateY(-5px);
        }

        .section h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            font-weight: 600;
            color: #2c5282;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: #2c5282;
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 500;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #2c5282;
            box-shadow: 0 0 5px rgba(44, 82, 130, 0.3);
            outline: none;
        }

        .submit-btn {
            display: inline-block;
            padding: 12px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            color: white;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            background: linear-gradient(45deg, #2c5282, #63b3ed);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .submit-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .action-btn {
            display: inline-block;
            padding: 8px 15px;
            margin-right: 10px;
            border-radius: 5px;
            text-decoration: none;
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .edit-btn {
            background: #4CAF50;
            color: white;
        }

        .delete-btn {
            background: #f44336;
            color: white;
        }

        .action-btn:hover {
            opacity: 0.9;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .data-table th,
        .data-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
            font-family: 'Roboto', sans-serif;
        }

        .data-table th {
            background: #2c5282;
            color: white;
            font-weight: 500;
        }

        .data-table tr:hover {
            background: rgba(44, 82, 130, 0.1);
        }

        .footer {
            width: 100%;
            padding: 40px 20px;
            text-align: center;
            background: transparent;
            position: relative;
            z-index: 5;
            margin-top: auto;
        }

        .footer p {
            font-family: 'Roboto', sans-serif;
            font-size: 18px;
            font-weight: 500;
            color: #5A8AA6;
            margin: 10px 0;
            line-height: 1.6;
            transition: transform 0.3s ease, text-shadow 0.3s ease;
        }

        .footer p:hover {
            transform: scale(1.02);
            text-shadow: 0 0 10px rgba(116, 196, 188, 0.5);
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.html">Home</a>
        <a href="doctors.html">Doctors</a>
    </nav>
    <div class="container">
        <div class="section">
            <h2>Patient Records</h2>
            <form action="" method="GET">
                <div class="form-group">
                    <label for="patient-id">Patient ID</label>
                    <input type="text" id="patient-id" name="patient-id" value="<?php if(isset($_GET['patient-id'])){echo htmlspecialchars($_GET['patient-id']);} ?>" placeholder="Enter Patient ID" required>
                </div>
                <button type="submit" class="submit-btn">View Records</button>
            </form>
            <?php
            $con = mysqli_connect("localhost", "root", "", "doctors");
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }

            // Handle Delete Operation
            if (isset($_GET['delete'])) {
                $prescription_id = $_GET['delete'];
                $patient_id = $_GET['patient-id'];
                $query = "DELETE FROM prescriptions WHERE prescription_id = '$prescription_id'";
                if (mysqli_query($con, $query)) {
                    header("Location: doctor_dashboard_new.php?patient-id=" . urlencode($patient_id) . "&success=Prescription deleted successfully");
                    exit();
                } else {
                    echo "<p style='color: red;'>Error deleting record: " . mysqli_error($con) . "</p>";
                }
            }

            // Handle Update Operation
            if (isset($_POST['update'])) {
                $prescription_id = $_POST['prescription_id'];
                $patient_id = $_POST['patient_id'];
                $medication = mysqli_real_escape_string($con, $_POST['medication']);
                $dosage = mysqli_real_escape_string($con, $_POST['dosage']);
                $instructions = mysqli_real_escape_string($con, $_POST['instructions']);

                $query = "UPDATE prescriptions SET Medication='$medication', Dosage='$dosage', Instructions='$instructions' WHERE prescription_id='$prescription_id'";
                if (mysqli_query($con, $query)) {
                    header("Location: doctor_dashboard_new.php?patient-id=" . urlencode($patient_id));
                    exit();
                } else {
                    echo "Error updating record";
                }
            }

            // Display Success Message
            if (isset($_GET['success'])) {
                echo "<p style='color: green;'>" . htmlspecialchars($_GET['success']) . "</p>";
            }

            // Edit Form
            if (isset($_GET['edit'])) {
                $prescription_id = $_GET['edit'];
                $query = "SELECT * FROM prescriptions WHERE prescription_id = '$prescription_id'";
                $result = mysqli_query($con, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <h3>Edit Prescription</h3>
                    <form action="" method="POST">
                        <input type="hidden" name="prescription_id" value="<?php echo htmlspecialchars($row['prescription_id']); ?>">
                        <input type="hidden" name="patient_id" value="<?php echo htmlspecialchars($_GET['patient-id']); ?>">
                        <div class="form-group">
                            <label for="medication">Medication</label>
                            <input type="text" id="medication" name="medication" value="<?php echo htmlspecialchars($row['Medication']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="dosage">Dosage</label>
                            <input type="text" id="dosage" name="dosage" value="<?php echo htmlspecialchars($row['Dosage']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="instructions">Instructions</label>
                            <textarea id="instructions" name="instructions" rows="4" required><?php echo htmlspecialchars($row['Instructions']); ?></textarea>
                        </div>
                        <button type="submit" name="update" class="submit-btn">Update Prescription</button>
                    </form>
                    <?php
                }
            }
            ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Medication</th>
                        <th>Dosage</th>
                        <th>Instructions</th>
                        <th>Doctor ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['patient-id'])) {
                        $filtervalues = mysqli_real_escape_string($con, $_GET['patient-id']);
                        $query = "SELECT a.patient_id, a.appointment_date, a.appointment_time, p.prescription_id, p.Medication, p.Dosage, p.Instructions, p.doctor_id 
                                  FROM appointment a 
                                  LEFT JOIN prescriptions p ON a.patient_id = p.patient_id 
                                  WHERE a.patient_id = '$filtervalues'";
                        $query_run = mysqli_query($con, $query);
                        if ($query_run && mysqli_num_rows($query_run) > 0) {
                            while ($items = mysqli_fetch_assoc($query_run)) {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($items['patient_id']); ?></td>
                                    <td><?php echo htmlspecialchars($items['appointment_date']); ?></td>
                                    <td><?php echo htmlspecialchars($items['appointment_time']); ?></td>
                                    <td><?php echo htmlspecialchars($items['Medication'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($items['Dosage'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($items['Instructions'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($items['doctor_id'] ?? ''); ?></td>
                                    <td>
                                        <?php if (!empty($items['prescription_id'])) { ?>
                                            <a href="?patient-id=<?php echo urlencode($filtervalues); ?>&edit=<?php echo urlencode($items['prescription_id']); ?>" class="action-btn edit-btn">Edit</a>
                                            <a href="?patient-id=<?php echo urlencode($filtervalues); ?>&delete=<?php echo urlencode($items['prescription_id']); ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this prescription?');">Delete</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="8">No Record Found</td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Manage Prescriptions</h2>
            <form action='prescriptions.php' method='POST'>
                <div class="form-group">
                    <label for="patient_id">Patient ID</label>
                    <input type="text" id="patient_id" name="patient_id" value="<?php if(isset($_POST['patient-id'])){echo htmlspecialchars($_POST['patient-id']);} ?>" required>
                </div>
                <div class="form-group">
                    <label for="medication">Medication</label>
                    <input type="text" id="medication" name="medication" required>
                </div>
                <div class="form-group">
                    <label for="dosage">Dosage</label>
                    <input type="text" id="dosage" name="dosage" required>
                </div>
                <div class="form-group">
                    <label for="instructions">Instructions</label>
                    <textarea id="instructions" name="instructions" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="doctor_id">Doctor ID</label>
                    <input type="text" id="doctor_id" name="doctor_id" required>
                </div>
                <button type="submit" class="submit-btn">Add Prescription</button>
            </form>
        </div>
    </div>
    <footer class="footer">
        <p>© 2025 MindBalance. All rights reserved.</p>
    </footer>
</body>
</html>
<?php ob_end_flush(); ?>



