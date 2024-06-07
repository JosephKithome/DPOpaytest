<?php
require_once 'Database.php';

class App {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getData() {
        $sql = "
            SELECT
                t1.column1,
                t2.column2,
                COUNT(t3.column3) as total
            FROM
                table1 t1
            JOIN
                table2 t2 ON t1.id = t2.foreign_id
            LEFT JOIN
                table3 t3 ON t1.id = t3.foreign_id
            GROUP BY
                t1.column1, t2.column2
        ";

        try {
            $results = $this->db->query($sql);
            return $results;
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }
}
?>
