<?php

    // Include the database connection file
    require_once "connection.php";

    // Check if the database connection was successful
    if (!$db) {
        
        echo "Connection failed";
        exit;

    } else {
        
        try {
            
            // Create five users in the users table
            $sql = "SELECT * FROM `users`";

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
?>
<table>
    <thead>
        <tr>
            <th>SrNo</th>
            <th>Username</th>
            <th>Password</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user["srno"] ?></td>                <?php /* Show the user name*/ ?>
                <td><?= $user["username"] ?></td>           <?php /* Show the user last name*/ ?>
                <td><?= $user["password"] ?></td>               <?php /* Show the user phone*/ ?>
                <td><?= $user["date"] ?></td>               <?php /* Show the user phone*/ ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>