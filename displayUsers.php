<?php
class FetchUsers {
    private $url;

    public function __construct($url) {
        $this->url = $url;
    }

    public function fetchUsers() {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                throw new Exception(curl_error($ch));
            }
            curl_close($ch);

            $users = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception(json_last_error_msg());
            }
            return $users;
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function displayUsers() {
        $users = $this->fetchUsers();
        if (is_array($users)) {
            echo '
            <style>
                table {
                    width: 50%;
                    border-collapse: collapse;
                    margin: 25px 0;
                    font-size: 18px;
                    text-align: left;
                }
                th, td {
                    padding: 12px;
                    border-bottom: 1px solid #ddd;
                }
                th {
                    background-color: #f2f2f2;
                }
                tr:hover {
                    background-color: #f5f5f5;
                }
            </style>
            ';
            echo '<table>';
            echo '<tr><th>Name</th><th>Email</th></tr>';
            foreach ($users as $user) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($user['name']) . '</td>';
                echo '<td>' . htmlspecialchars($user['email']) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo $users;
        }
    }
}

$url = "https://jsonplaceholder.typicode.com/users";
$userFetcher = new FetchUsers($url);
$userFetcher->displayUsers();
?>
