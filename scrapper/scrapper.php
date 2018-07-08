<?php
function portalScrapper($username,$password)
{
    include_once "simple_html_dom.php";
    $ch = curl_init();
    $data = [
        'username1' => $username,
        'password' => $password
    ];
    curl_setopt($ch, CURLOPT_URL, '10.10.156.201/login-process.php');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    $response = curl_exec($ch);

    $html = new simple_html_dom();
    $html->load($response);

    $alldata = [];
    for ($i = 0; $i <= 2; $i++) {
        $alldata[] = $html->find('table', $i) . "<br>";
    }
    return $alldata;
}

?>