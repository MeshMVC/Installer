<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tagUrl = 'https://api.github.com/repos/MeshMVC/Installer/tags';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $tagUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$response = curl_exec($ch);
curl_close($ch);

if (curl_errno($ch)) {
    $error = curl_error($ch);
    echo "cURL Error: " . $error;
    die();
}

$data = json_decode($response, true);

// Access the data retrieved from the API
// For example, to access the first tag name:
$releaseTag = $data[0]['name'];

if (isset($_REQUEST["w"])) {
    header("Location: https://raw.githubusercontent.com/MeshMVC/Installer/".$releaseTag."/ps-setup");
} else {
    header("Location: https://raw.githubusercontent.com/MeshMVC/Installer/".$releaseTag."/bash-setup");
}
exit();
