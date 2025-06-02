<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard - MindBalance</title>
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
            color: #319795;
            animation: textPulse 0.5s ease infinite;
        }

        .navbar a::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #2c5282, #319795);
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
            color: #319795;
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
            background: #319795;
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
            border-color: #319795;
            box-shadow: 0 0 5px rgba(49, 151, 149, 0.3);
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
            background: linear-gradient(45deg, #319795, #68d391);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .submit-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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
            background: #319795;
            color: white;
            font-weight: 500;
        }

        .data-table tr:hover {
            background: rgba(49, 151, 149, 0.1);
        }

        .doctors-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
            margin-top: 20px;
        }

        .doctor-card {
            width: 300px;
            height: 400px;
            position: relative;
            perspective: 1000px;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.6s;
            transform-style: preserve-3d;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border-radius: 15px;
        }

        .doctor-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front,
        .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            display: flex;
            flex-direction: column;
			justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
        }

        .flip-card-front {
            z-index: 2;
        }

        .flip-card-back {
            transform: rotateY(180deg);
            justify-content: center;
        }

        .flip-card-front img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .flip-card-front h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 22px;
            font-weight: 600;
            color: #2c5282;
        }

        .flip-card-back p {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            color: #555;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .flip-card-back p.speciality {
            font-weight: 500;
            color: #2c5282;
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
            <h2>Prescriptions</h2>
			<form action="" method="GET">
				<div class="form-group">
					<label for="patient-id">Patient ID</label>
					<input type="text" id="patient-id" name="patient-id" value="<?php if(isset($_GET['patient-id'])){echo $_GET ['patient-id'];} ?>" placeholder="Enter ID" required>
				</div>
				<button type="submit" class="submit-btn">View Prescriptions</button>
			</form>
            <table class="data-table">
                <thead>
                    <tr>
						<th>patient_id</th>
						<th>prescription_id</th>
			            <th>medication</th>
						<th>dosage</th>
						<th>instructions</th>
						<th>doctor_id</th>
                    </tr>
                </thead>
                <tbody>
					<?php
						$con=mysqli_connect("localhost","root","","doctors");
						if(isset($_GET['patient-id']))
						{
							$filtervalues= $_GET['patient-id'];
							$query = "SELECT a.patient_id,p.prescription_id,p.Medication,p.Dosage,p.Instructions,p.doctor_id from appointment a left join prescriptions p on a.patient_id=p.patient_id WHERE a.patient_id = '$filtervalues'";
							$query_run=mysqli_query($con,$query);
							if(mysqli_num_rows($query_run)>0)
							{
								foreach($query_run as $items)
								{
									?>
									<tr>
										<td><?= $items['patient_id']; ?></td>
										<td><?= $items['prescription_id']; ?></td>
										<td><?= $items['Medication']; ?></td>
										<td><?= $items['Dosage']; ?></td>
										<td><?= $items['Instructions']; ?></td>
										<td><?= $items['doctor_id']; ?></td>
									</tr>
									<?php
								}
							}
							else
							{
								?>
									<tr>
										<td colspan="5"> No Record Found </td>
									</tr>
								<?php
							}
						}
					?>
					
                </tbody>
            </table> 
        </div>

        <div class="section">
            <h2>Book Appointment</h2>
            <form action="appointment.php" method="post">
				<div class="form-group">
				<div class="form-group">
                    <label for="name">doctor_id</label>
                    <input type="text" id="doctor_id" name="doctor_id" value="" required>
                </div>
                </div>
                <div class="form-group">
                    <label for="name">patient_id</label>
                    <input type="text" id="patient_id" name="patient_id" value="" required>
                </div>
                <div class="form-group">
                    <label for="appointment-date">Date</label>
                    <input type="date" id="appointment-date" name="appointment_date" required>
                </div>
                <div class="form-group">
                    <label for="appointment-time">Time</label>
                    <input type="time" id="appointment-time" name="appointment_time" required>
                </div>
                <button type="submit" class="submit-btn">Book Appointment</button>
            </form>
            <div class="doctors-container">
                <div class="doctor-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <h3>Dr. Trump</h3>
                        </div>
                        <div class="flip-card-back">
                            <p class="speciality">Geriatric Psychiatrist</p>
                            <p>15+ years of experience</p>
                        </div>
                    </div>
                </div>
                <div class="doctor-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <h3>Dr. Yunus</h3>
                        </div>
                        <div class="flip-card-back">
                            <p class="speciality">Forensic Psychiatrist</p>
                            <p>12+ years of experience</p>
                        </div>
                    </div>
                </div>
                <div class="doctor-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <h3>Dr. Hilary</h3>
                        </div>
                        <div class="flip-card-back">
                            <p class="speciality">Child and Adolescent Psychiatrist</p>
                            <p>8+ years of experience</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <p>© 2025 MindBalance. All rights reserved.</p>
    </footer>
</body>
</html>