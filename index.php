<?php 
include '../php_curd/includes/config.php';
$db = new Database('localhost', 'root', '', 'crud');
$sql = "SELECT * FROM employees"; 
$stmt = $db->getConnection()->prepare($sql);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {background-color: #f5f5f5;}
        a {
            text-decoration: none;
            color: blue;
        }
        a:hover {
            color: red;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }   
    </style>
</head>
<body>
    <h1>Employee Management</h1>
    <a href="../php_curd/create.php"><button class="add">Add New Employee</button></a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Salary</th>
            <th>Action</th>
        </tr>
        <?php if ($employees): ?>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?php echo htmlspecialchars($employee['id']); ?></td>
                    <td><?php echo htmlspecialchars($employee['Name']); ?></td>
                    <td><?php echo htmlspecialchars($employee['Address']); ?></td>
                    <td><?php echo htmlspecialchars($employee['Salary']); ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $employee['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $employee['id']; ?>" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No records found.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
