<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inventory System Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background: linear-gradient(135deg,#1a3c2e,#2d6a4f,#52b788);
}

/* LOGIN CARD */

.login-container{
    background:#ffffff;
    padding:40px 35px;
    width:350px;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,0.15);
}

.login-container h2{
    text-align:center;
    margin-bottom:5px;
    color:#1a3c2e;
}

.subtitle{
    text-align:center;
    font-size:14px;
    color:#666;
    margin-bottom:25px;
}

/* INPUT FIELDS */

.input-group{
    margin-bottom:18px;
}

.input-group label{
    font-size:13px;
    color:#444;
}

.input-group input{
    width:100%;
    padding:10px;
    border-radius:6px;
    border:1px solid #ccc;
    margin-top:5px;
    font-size:14px;
    transition:0.2s;
}

.input-group input:focus{
    outline:none;
    border-color:#2d6a4f;
    box-shadow:0 0 4px rgba(45,106,79,0.3);
}

/* LOGIN BUTTON */

button{
    width:100%;
    padding:10px;
    border:none;
    border-radius:6px;
    background:#2d6a4f;
    color:white;
    font-size:15px;
    cursor:pointer;
    transition:0.2s;
}

button:hover{
    background:#1a3c2e;
}

/* FOOTER */

.footer{
    text-align:center;
    margin-top:18px;
    font-size:13px;
}

.footer a{
    text-decoration:none;
    color:#2d6a4f;
}

.footer a:hover{
    text-decoration:underline;
}

</style>
</head>

<body>

<div class="login-container">

<h2>Inventory System</h2>
<p class="subtitle">Login to your account</p>

<form action="login_process.php" method="POST">

<div class="input-group">
<label>Username</label>
<input type="text" name="username" placeholder="Enter username" required>
</div>

<div class="input-group">
<label>Password</label>
<input type="password" name="password" placeholder="Enter password" required>
</div>

<button type="submit" name="SUBMIT">Login</button>

</form>

<div class="footer">
<a href="CSV_upload_form.php">Upload CSV</a>
</div>

</div>

</body>
</html>