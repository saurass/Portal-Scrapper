<?php
$att_data = [];
$info_data = [];
$mark_data = [];
require_once "connect.php";
$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM requesters WHERE username='$username' AND password='$password'";
$rum = mysqli_query($conn, $query);

if (mysqli_num_rows($rum) == 0) {
    $query = "INSERT INTO requesters VALUES ('$username','$password','','','')";
    $res = mysqli_query($conn, $query);
    if (!$res)
        die(json_encode(['status' => 'error', 'message' => 'Unable to connect to database']));
}

while (1) {
    $query = "SELECT * FROM requesters WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($res);
    if ($row['info'] == ''){}
    else {
        $att_data = $row['attandance'];
        $info_data = $row['info'];
        $mark_data = $row['marks'];
        break;
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>CSV Editor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/custom1.css">

</head>

<body>


<nav class="fixed navbar-fixed">
    <div class="nav-wrapper blue lighten-2">
        <a href="#" class="brand-logo center">Portal</a>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
        </ul>
    </div>
</nav>


<div class="row"></div>
<div class="row"></div>
<div class="row blue-text">
    <center><h5 style="color: #00C853">Welcome,</h5></center>
    <center><h3 id="stu_name"></h3></center>
</div>
<div class="row"></div>
<div class="row"></div>

<div class="blue lighten-4">
    <center><h5>Attendance Table</h5></center>
    <div class="row"></div>
</div>
<div class="container">
    <div id="atttab"></div>
</div>
<div class="row"></div>

<div class="blue lighten-4">
    <center><h5>Marks Table</h5></center>
    <div class="row"></div>
</div>
<div class="container">
    <div id="marktab"></div>
</div>
<div class="row"></div>

<script type="text/javascript" src="assets/plugins/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/plugins/materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="assets/js/custom1.js"></script>
<script type="text/javascript">
    var att = <?php print_r($att_data)?>;
    var mark = <?php print_r($mark_data) ?>;
    var info = <?php print_r($info_data) ?>;
    //        alert(att[0][0]);
    var att_table = makeTableHTML(att);
    document.getElementById('atttab').innerHTML = att_table;
    var mark_table = makeTableHTML(mark);
    document.getElementById('marktab').innerHTML = mark_table;

    document.getElementById('stu_name').innerText=info[0][1];
</script>

</body>
