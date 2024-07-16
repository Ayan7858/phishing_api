<?php

    // Include the database connection file
    require_once "connection.php";
    

    // Check if the database connection was successful
    if (!$db1) {
        
        echo "Connection failed";
        exit;

    } else {
        
        try {
            
            // Create five users in the users table
            $sql = "SELECT * FROM `cookie_details`";

            // Prepare the SQL query to add the five users
            $statement = $db1->prepare($sql);
            
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
?>
<table>
    <thead>
        <tr>
            <th>SrNo</th>
            <th>SID</th>
            <th>Total Visits</th>
            <th>Last Visit</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user["srno"] ?></td>                <?php /* Show the user name*/ ?>
                <td><?= $user["sid"] ?></td>           <?php /* Show the user last name*/ ?>
                <td><?= $user["total_visits"] ?></td>               <?php /* Show the user phone*/ ?>
                <td><?= $user["last_visit"] ?></td>               <?php /* Show the user phone*/ ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>