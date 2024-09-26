<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Expense Tracker Dashboard</h1>

    <a href="add.php">Add New Expense</a>

    <h2>Expenses</h2>
    <table border="1">
        <tr>
            <th>Amount</th>
            <th>Category</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>

        <?php
        $sql = "SELECT * FROM expenses";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['amount']}</td>
                        <td>{$row['category']}</td>
                        <td>{$row['date']}</td>
                        <td>
                            <a href='edit.php?id={$row['id']}'>Edit</a> | 
                            <a href='delete.php?id={$row['id']}'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No expenses found</td></tr>";
        }
        ?>
    </table>

    <h2>Total Expenses</h2>
    <form action="index.php" method="GET">
        <label for="period">Select Period:</label>
        <select name="period">
            <option value="day">Today</option>
            <option value="week">This Week</option>
            <option value="month">This Month</option>
        </select>
        <input type="submit" value="Show Total">
    </form>

    <?php
    if (isset($_GET['period'])) {
        $period = $_GET['period'];

        switch ($period) {
            case 'day':
                $sql = "SELECT SUM(amount) as total FROM expenses WHERE date = CURDATE()";
                break;
            case 'week':
                $sql = "SELECT SUM(amount) as total FROM expenses WHERE YEARWEEK(date, 1) = YEARWEEK(CURDATE(), 1)";
                break;
            case 'month':
                $sql = "SELECT SUM(amount) as total FROM expenses WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
                break;
        }

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo "<p>Total expenses for selected period: {$row['total']}</p>";
    }
    ?>
</body>

</html>