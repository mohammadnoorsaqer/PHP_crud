<?php
include '../php_curd/includes/config.php';
$db = new Database('localhost', 'root', '', 'crud'); 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $salary = htmlspecialchars($_POST['salary']);
    $sql = "INSERT INTO employees (Name, Address, Salary) VALUES (:name, :address, :salary)";
    $stmt = $db->getConnection()->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':salary', $salary);

    if ($stmt->execute()) {
        header('Location: index.php'); 
        exit();
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Employee</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    form {
        width: 50%;
        margin: 0 auto;
    }
    input[type=text], input[type=number] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
    }
</style>
<body>
    <form action="create.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>
        <br>
        <label for="salary">Salary:</label>
        <input type="number" id="salary" name="salary" required>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
