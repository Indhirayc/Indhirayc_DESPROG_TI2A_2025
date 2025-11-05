<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMTL aman</title>
</head>
<body>
    <h2>HTML aman</h2>  


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="input">Input:</label>
        <input type="text" id="input" name="input">
        <br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <br>

        <input type="submit" value="Submit">
    </form>

    <br>

    <?php

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = $_POST['input'];
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        echo "Input: " . $input;

        echo "<br>";
   
        $email = $_POST['email'];

        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email valid: ";
            echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        } else {
            echo "Email tidak valid";
        }
    }
    ?>
</body>
</html>
