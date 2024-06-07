<?php
session_start();

if (!isset($_SESSION['access_token'])) {
    die('Access token not found');
}

$access_token = $_SESSION['access_token'];
$user_info_url = 'https://api.github.com/user';
$email_info_url = 'https://api.github.com/user/emails';

$options = [
    'http' => [
        'header' => [
            "Authorization: Bearer $access_token",
            "User-Agent: PHP OAuth"
        ]
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($user_info_url, false, $context);
$user_info = json_decode($response, true);

$response = file_get_contents($email_info_url, false, $context);
$email_info = json_decode($response, true);

echo '<pre>';
print_r($user_info);
print_r($email_info);
echo '</pre>';
?>
