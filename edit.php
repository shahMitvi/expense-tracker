<?php include 'db.php'; ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM expenses WHERE id=$id";
    $result = $conn->query($sql);
    $expense = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $date = $_POST['date'];

    $sql = "UPDATE expenses SET amount='$amount', category='$category', date='$date' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Expense</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Edit Expense</h1>

    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $expense['id']; ?>">

        <label for="amount">Amount:</label>
        <input type="number" name="amount" step="0.01" value="<?php echo $expense['amount']; ?>" required><br>

        <label for="category">Category:</label>
        <select name="category" required>
            <option value="Food" <?php if ($expense['category'] == 'Food') echo 'selected'; ?>>Food</option>
            <option value="Transport" <?php if ($expense['category'] == 'Transport') echo 'selected'; ?>>Transport</option>
            <option value="Utilities" <?php if ($expense['category'] == 'Utilities') echo 'selected'; ?>>Utilities</option>
            <option value="Others" <?php if ($expense['category'] == 'Others') echo 'selected'; ?>>Others</option>
        </select><br>

        <label for="date">Date:</label>
        <input type="date" name="date" value="<?php echo $expense['date']; ?>" required><br>

        <input type="submit" name="update" value="Update Expense">
    </form>

    <a href="index.php">Back to Dashboard</a>
</body>

</html>