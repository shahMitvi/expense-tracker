<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Expense</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Add New Expense</h1>

    <?php

    $errors = [];


    if (isset($_POST['submit'])) {
        $amount = $_POST['amount'];
        $category = $_POST['category'];
        $date = $_POST['date'];


        if (!is_numeric($amount) || $amount <= 0) {
            $errors[] = "Please enter a valid positive amount.";
        }


        // // if (empty($category))
        // if ($category == 0) {
        //     $errors[] = "Please select a category.";
        // }


        if (empty($date) || $date > date('Y-m-d')) {
            $errors[] = "Please enter a valid date (not in the future).";
        }


        if (empty($errors)) {
            $sql = "INSERT INTO expenses (amount, category, date) VALUES ('$amount', '$category', '$date')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Expense added successfully!</p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    ?>


    <?php if (!empty($errors)): ?>
        <div class="error-messages">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="add.php" method="POST">
        <label for="amount">Amount:</label>
        <input type="number" name="amount" step="0.01" required><br>

        <label for="category">Category:</label>
        <select name="category" required>
            <option value="Select">Select any one</option>
            <option value="Food">Food</option>
            <option value="Transport">Transport</option>
            <option value="Utilities">Utilities</option>
            <option value="Others">Others</option>
        </select><br>

        <label for="date">Date:</label>
        <input type="date" name="date" required><br>

        <input type="submit" name="submit" value="Add Expense">
    </form>

    <a href="index.php">Back to Dashboard</a>
</body>

</html>