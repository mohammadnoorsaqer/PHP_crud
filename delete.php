<?php
include '../php_curd/includes/config.php';
$db = new Database('localhost', 'root', '', 'crud');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM Employees WHERE id = :id";
    $stmt = $db->getConnection()->prepare($sql);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        header('Location: index.php');
        exit(); 
    } else {
        echo "Error deleting employee: " . $stmt->errorInfo()[2];
    }
} else {
    echo "No employee ID specified.";
}
?>
