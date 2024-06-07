<?php
session_start();

$client_id = 'Ov23liTc7gTpOubx2haI';
$client_secret = '7a1f662c997f92e9c11b41cf3de663b811d179dc';
$redirect_uri = 'http://localhost/PHP/oauth/callback.php';

if (!isset($_GET['code']) || !isset($_GET['state']) || $_GET['state'] !== $_SESSION['oauth2_state']) {
    die('Authorization failed');
}

$code = $_GET['code'];

$token_url = 'https://github.com/login/oauth/access_token';
$params = [
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'code' => $code,
    'redirect_uri' => $redirect_uri,
    'state' => $_GET['state']
];

$options = [
    'http' => [
        'header' => "Content-Type: application/x-www-form-urlencoded\r\nAccept: application/json",
        'method' => 'POST',
        'content' => http_build_query($params)
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($token_url, false, $context);
$token_data = json_decode($response, true);

if (isset($token_data['access_token'])) {
    $_SESSION['access_token'] = $token_data['access_token'];
    header('Location: data.php');
    exit;
} else {
    die('Token exchange failed');
}
?>
