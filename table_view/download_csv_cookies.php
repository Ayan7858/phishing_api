<?php

 // Include the database connection file
 include "./connection.php";

 // Check if the database connection was successful
 if (!$db) {
     
     echo "Connection failed";
     exit;

 } else {
     
     try {
         
         // Create five users in the users table
         $sql = "SELECT * FROM `cookie_details`";

         // Prepare the SQL query to add the five users
         $statement = $db->prepare($sql);
         
         // Execute the SQL query to add the five users
         $statement->execute();

         // Save the result in a variable named $users
         $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        
         // Close the database connection
         $db = null;

     } catch (PDOException $e) {
         // Handle any PDO exceptions and display an error message if necessary
         echo $e->getMessage();
     }

 }

 // Section to download the CSV file

    // Define the filename
    $filename = "cookie_details.csv";

    // Define the delimiter (separating character)
    $delimiter = ",";

    // Create a file pointer
    $f = fopen('php://memory', 'w');

    // Get the column names
    $fields = array_keys(current($users));

    // Write the column names to the CSV file
    fputcsv($f, $fields, $delimiter);

    // Write all the user records to the CSV file
    
    foreach ($users as $user) {
        fputcsv($f, $user, $delimiter);
    }

    // Move the file pointer to the beginning of the file
    fseek($f, 0);

    // Set the HTTP headers to download the CSV file rather than displaying it
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    // Output all the remaining data on a file pointer
    fpassthru($f);

    // Close the file pointer
    fclose($f);

    // Stop the PHP script
    exit;

?>