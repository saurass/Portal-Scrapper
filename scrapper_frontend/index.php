<!DOCTYPE HTML>
<html>
<head>
    <title>CSV Editor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <h2 class="active"> Sign In </h2>

        <!-- Icon -->
        <div class="fadeIn first">
            <img style="width: 200px;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHp5fIE8s-dHlJeaFFNiOVm9PEgaw2Jmj35cR5ilc4C3Mr0vyP" id="icon" alt="User Icon"/>
        </div>
        <div class="row"></div>
        <div class="row"></div>

        <!-- Login Form -->
        <form action="welcome.php" method="post">
            <input type="text" id="login" class="fadeIn second" name="username" placeholder="University Roll Number">
            <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
            <div class="row"></div>
            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="#">Forgot Password?</a>
        </div>

    </div>
</div>

<script type="text/javascript" src="assets/plugins/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/plugins/materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
</body>
</html>