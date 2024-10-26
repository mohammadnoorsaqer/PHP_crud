<?php
include '../php_curd/includes/config.php';
$db = new Database('localhost', 'root', '', 'crud'); 
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM employees WHERE id = :id";
    $stmt = $db->getConnection()->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        echo "<h1>Employee Details</h1>";
        echo "Name: " . htmlspecialchars($row['Name']) . "<br>"; 
        echo "Address: " . htmlspecialchars($row['Address']) . "<br>";
        echo "Salary: " . htmlspecialchars($row['Salary']) . "<br>"; 
        echo "<br><a href='index.php'>Back to Home</a>";
    } else {
        echo "<h1>No record found</h1>";
        echo "<br><a href='index.php'>Back to Home</a>";
    }
} else {
    echo "<h1>Invalid ID</h1>";
    echo "<br><a href='index.php'>Back to Home</a>";
}
?>
