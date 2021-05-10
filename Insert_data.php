<?php
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $username = "root";
            $password = "mysql";
            $query = "INSERT INTO `user_data`(`First_Name`, `Last_Name`, `Email`, `Password`) VALUES ('$fname','$lname','$email','$pass')"; 
            $hostname = "localhost";
            $dbname = "online_pharmacy";

            try{

                $db = new mysqli($hostname, $username, $password, $dbname);

                // Select Query
                $statement = $db->query($query);

                // Checking if query is executed or not
                if($statement === TRUE){
                    echo "Account Registered successfully!<br>";
                    echo "Please Login into your account to proceed further <a href='new_login.php'>Log in</a>";
                }else{
                    echo "Failed to register the record<br>";
                    echo "Please enter the Correct Details";
                }
             
                //Close the COnnection
                $db->close();

            }catch(Exception $e){
                
                $error = $e->getMessage();
                echo "<p>Error Message: $error</p>";            
                
            }
        ?>