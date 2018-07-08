<?php
set_time_limit(0);
ignore_user_abort(true);
include_once "connect.php";
include_once "scrapper.php";
$info_table = '';
$mark_table = '';
$atte_table = '';
while (1) {
    $query = "SELECT * FROM requesters";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $usermname = $row['username'];
        $password = $row['password'];

        $res = portalScrapper($usermname, $password);
        for ($jj = 0; $jj < 3; $jj++) {

            $all_th_arr = getALlHeadForTable($res[$jj]);
            $all_td_arr = getALlDataForTable($res[$jj]);

            if ($jj == 0)
                $atte_table = createAtteData($all_td_arr, $all_th_arr);
            if ($jj == 1)
                $mark_table = createMarkData($all_td_arr, $all_th_arr);
            if ($jj == 2)
                $info_table = createInfoData($all_td_arr, $all_th_arr);
        }

        $info_table = str_replace("FATHER'S", "FATHER", $info_table);

        $q_i = "UPDATE requesters SET attandance='$atte_table',marks='$mark_table',info='$info_table' WHERE username='$usermname' AND password='$password'";
        $cccc = mysqli_query($conn, $q_i);
        if (!$cccc)
            echo mysqli_error($conn);
    }
}

function getALlHeadForTable($result)
{
    $DOM = new DOMDocument();
    $DOM->loadHTML($result);

    $Header = $DOM->getElementsByTagName('th');
    $aDataTableHeaderHTML = [];
    foreach ($Header as $NodeHeader) {
        $aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
    }
    return $aDataTableHeaderHTML;
}

function getALlDataForTable($htmlContent)
{
    $DOM = new DOMDocument();
    $DOM->loadHTML($htmlContent);

    $Detail = $DOM->getElementsByTagName('td');

    $i = 0;
    $j = 0;
    $aDataTableDetailHTML = [];
    foreach ($Detail as $sNodeDetail) {
        $aDataTableDetailHTML[$j][] = trim($sNodeDetail->textContent);
        $i = $i + 1;
        $j = $i % count($aDataTableDetailHTML) == 0 ? $j + 1 : $j;
    }
    return $aDataTableDetailHTML;
}

function createAtteData($all_td_arr, $all_th_arr)
{
    $table = [];
    $heads = [$all_th_arr[0], $all_th_arr[1], $all_th_arr[2]];
    $table_row_count = 0;
    $table[$table_row_count++] = $heads;
    $count = 0;
    $f1 = 0;
    foreach ($all_th_arr as $in_heads) {
        if ($count++ > 2) {
            $table[$table_row_count++] = [$in_heads, $all_td_arr[$f1++][0], $all_td_arr[$f1++][0]];
        }
    }

    return json_encode($table);
}

function createMarkData($all_td_arr, $all_th_arr)
{
    $table = [];
    $heads = [$all_th_arr[0], $all_th_arr[1], $all_th_arr[2], $all_th_arr[3]];
    $table_row_count = 0;
    $table[$table_row_count++] = $heads;
    $count = 0;
    $a = sizeof($heads);
    $b = sizeof($all_td_arr);
    $c = $b / $a;
    for ($cc = 0; $cc < $c; $cc++) {
        $table[$table_row_count++] = [$all_td_arr[$count++][0], $all_td_arr[$count++][0], $all_td_arr[$count++][0], $all_td_arr[$count++][0]];
    }

    return json_encode($table);
}

function createInfoData($all_td_arr, $all_th_arr)
{
    $table = [];
    $count = 0;
    $cc = sizeof($all_th_arr) / 2;
    $h_c = 0;
    $d_c = 0;
    for ($i = 0; $i < $cc; $i++) {
        $table[$count++] = [$all_th_arr[$h_c++], $all_td_arr[$d_c++][0]];
        $d_c++;
        array_push($table[$count - 1], $all_th_arr[$h_c++]);
        array_push($table[$count - 1], $all_td_arr[$d_c++][0]);

    }
    return json_encode($table);
}

?>