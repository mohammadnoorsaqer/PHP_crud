<?php
include '../php_curd/includes/config.php';
$db = new Database('localhost', 'root', '', 'crud'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employees WHERE id = :id";
    $stmt = $db->getConnection()->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $salary = htmlspecialchars($_POST['salary']);
    
    $sql = "UPDATE employees SET Name = :name, Address = :address, Salary = :salary WHERE id = :id";
    $stmt = $db->getConnection()->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':salary', $salary);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header('Location: index.php'); 
        exit();
    } else {
        echo 'Error updating employee: ' . $stmt->errorInfo()[2];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
</head>
<body>
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
<?php if (isset($employee)): ?>
    <form action="update.php?id=<?php echo $id; ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($employee['Name']); ?>" required>
        <br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($employee['Address']); ?>" required>
        <br>
        <label for="salary">Salary:</label>
        <input type="number" id="salary" name="salary" value="<?php echo htmlspecialchars($employee['Salary']); ?>" required>
        <br>
        <button type="submit">Update Employee</button>
    </form>
<?php else: ?>
    <p>No employee found for this ID.</p>
<?php endif; ?>
</body>
</html>
