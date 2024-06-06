<?php
class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->connect();
    }

    private function connect() {
        try {
            $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully "; 
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function fetchData() {
        try {
            echo "Fetching data.... <br>";

            $sql = "SELECT ch.call_type, ch.customer_group, COUNT(*) as total 
                      FROM call_history as ch
                      GROUP BY ch.call_type, ch.customer_group";

            $stmt = $this->conn->query($sql); 
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            header('Content-Type: application/json');
            echo json_encode($result);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

$db = new Database("localhost", "root", "", "macmobile");
$db->fetchData();
?>
