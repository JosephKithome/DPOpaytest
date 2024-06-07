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
                u.user_id,
                COALESCE(SUM(w.balance), 0) AS total_wallet_balance,
                COALESCE(SUM(b.balance), 0) AS total_bank_balance,
                t.transaction_id,
                t.transaction_type,
                t.amount,
                t.transaction_date
            FROM 
                (SELECT DISTINCT user_id FROM wallet
                 UNION 
                 SELECT DISTINCT user_id FROM bank) u
            LEFT JOIN wallet w ON u.user_id = w.user_id
            LEFT JOIN bank b ON u.user_id = b.user_id
            INNER JOIN transactions t ON (t.wallet_id = w.wallet_id OR t.bank_id = b.bank_id)
            WHERE 
                t.transaction_date >= NOW() - INTERVAL '30 days'
            GROUP BY 
                u.user_id, t.transaction_id, t.transaction_type, t.amount, t.transaction_date
            ORDER BY 
                u.user_id, t.transaction_date;
        ";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            print_r($results); 
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

$app = new App();
$app->getData();
?>
