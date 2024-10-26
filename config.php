
<?php
class Database
{
    private $connection;

    public function __construct($servername = 'localhost', $username = 'root', $password = '', $dbname = 'crud')
    {
        try {
            $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function closeConnection()
    {
        $this->connection = null;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
?>
