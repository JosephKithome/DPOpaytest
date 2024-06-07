<?php
session_start();

$client_id = 'XXXXXXXXXXX';
$redirect_uri = 'http://localhost/PHP/oauth/callback.php';
$scope = 'read:user user:email';
$state = bin2hex(random_bytes(8)); 
$_SESSION['oauth2_state'] = $state;

$params = [
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'scope' => $scope,
    'state' => $state
];

$auth_url = 'https://github.com/login/oauth/authorize?' . http_build_query($params);
header('Location: ' . $auth_url);
exit;
?>
