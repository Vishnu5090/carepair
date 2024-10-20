<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational Support for Differently-Abled Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #3E6FF4; /* Same background color as Bus Route Finder */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }

        .back-button {
            position: absolute;
            top: 30px;
            left: 30px;
            background-color: #ffffff;
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .back-button:hover {
            background-color: #d1cfcf;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        section {
            padding: 20px;
            margin: 20px auto;
            width: 90%;
            max-width: 1000px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            color: #666;
            line-height: 1.6;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .back-button img {
            display: block;
        }

        select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 10px;
            width: 100%;
            max-width: 400px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            h1 {
                font-size: 24px;
            }

            section {
                width: 100%;
                padding: 15px;
            }

            table, th, td {
                font-size: 14px;
            }

            select {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 20px;
            }

            th, td {
                font-size: 12px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <button class="back-button" onclick="goBack()" style="position: fixed;">
        <img src="back icon.png" alt="Back" style="width: 40px; height: 40px;">
    </button>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <h1 style="color: #fff;">Educational Support for Differently-Abled Students</h1>
    
    <section>
        <h2>Differently Abled Special Schools</h2>
        <p>Discover a range of specialized institutions designed to cater to the unique educational needs of differently-abled students. 
            These schools offer various services such as early intervention, special education, and vocational training.</p>
        
        <!-- Dropdown for Special Institutions -->
        <form method="POST" action="">
            <label for="special-institutions">Select Institution Type:</label>
            <select id="special-institutions" name="institution_type" onchange="this.form.submit()">
                <option value="">--Please choose an option--</option>
                <option value="educational_institutions">Early Intervention Centers - Age 0-6 Years</option>
                <option value="disability_homes">Home For Persons With Intellectual Disability and Locomotor Disability</option>
                <option value="mental_health_homes">Home for Mental Ill Persons under Mental Health Act</option>
                <option value="special_schools">Special School for Intellectual Disability / Autism and Vocational Training</option>
                <option value="hearing_impaired_schools">Vocational Training Center For Persons with Hearing Impairment</option>
                <option value="hearing_impaired_school">Special School for Deaf Blind</option>
                <option value="blind_schools">Vocational Training Center For Persons with Visual Impairment</option>
                <option value="training_institutions">Rehabilitation Council of India Recognized Institution</option>
            </select>
        </form>

        <?php
        // PHP code to fetch data from MySQL based on the selected option
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $selectedOption = $_POST['institution_type'];
        
            // Database connection setup (replace with your own database credentials)
            $servername = "localhost"; 
            $username = "root"; 
            $password = ""; 
            $dbname = "carepair";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        
            // Query the database based on selected option
            if ($selectedOption != "") {
                // Escaping table name to avoid SQL injection
                $selectedOption = $conn->real_escape_string($selectedOption);
                
                $sql = "SELECT Institution, `Address`, `Contact_Number`, `Email_ID` FROM `$selectedOption`";
                $result = $conn->query($sql);
        
                // Error handling - check if query execution was successful
                if (!$result) {
                    echo "<p>SQL Error: " . $conn->error . "</p>";
                } else if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>Institution Name</th><th>Address</th><th>Contact Number</th><th>Email</th></tr>";
        
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['Institution'] . "</td>
                                <td>" . $row['Address'] . "</td>
                                <td>" . $row['Contact_Number'] . "</td>
                                <td>" . $row['Email_ID'] . "</td>
                              </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No data found for this institution type.</p>";
                }
            }
        
            // Close connection
            $conn->close();
        }
        ?>
    </section>

    <section>
        <h2>Special Schools and Virtual Learning Platforms</h2>
        <p>Find accredited online schools tailored for students with special needs. These platforms provide flexible schedules and personalized education programs:</p>
        <ul>
            <li><a href="https://www.k12.com" target="_blank">K12 Online School</a>: Offers flexible learning plans for students with disabilities, including IEP and 504 Plan support.</li>
            <li><a href="https://www.connectionsacademy.com" target="_blank">Connections Academy</a>: Virtual schooling platform that follows ADA and IDEA guidelines to ensure inclusive education.</li>
        </ul>
    </section>

    <section>
        <h2>Learning Resources and Materials</h2>
        <p>Access specialized resources that help differently-abled students thrive in an online environment:</p>
        <ul>
            <li><a href="https://www.do2learn.com" target="_blank">Do2Learn</a>: Provides thousands of free activities, communication cards, and academic materials tailored to special needs students.</li>
            <li><a href="https://www.ldonline.org" target="_blank">LD OnLine</a>: Offers instructional strategies and behavior management resources for educators and parents.</li>
        </ul>
    </section>

    <section>
        <h2>Virtual Expert Teachers</h2>
        <p>Expert teachers provide individualized support and guidance for students through virtual classrooms:</p>
        <ul>
            <li><a href="https://www.connectionsacademy.com" target="_blank">Connections Academy</a>: Certified teachers guide students with special needs through personalized lesson plans.</li>
            <li><a href="https://www.k12.com" target="_blank">K12 Special Education Services</a>: State-certified teachers provide support for students with learning challenges, helping them succeed academically.</li>
        </ul>
    </section>

    <section>
        <h2>Competitive Exam Preparation</h2>
        <p>Prepare for competitive exams with resources tailored to differently-abled students:</p>
        <ul>
            <li><a href="https://www.microsoft.com/learningtools" target="_blank">Microsoft Learning Tools</a>: Offers tools like the Immersive Reader to help students with reading disabilities prepare for exams.</li>
            <li><a href="https://www.aaaamath.com" target="_blank">AAA Math</a>: Provides interactive math practice for differently-abled students to strengthen core skills.</li>
        </ul>
    </section>
</body>
</html>
