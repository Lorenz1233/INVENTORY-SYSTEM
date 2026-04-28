<!DOCTYPE html>
<html>
<head>
<title>CSV Upload</title>

<style>

body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.container{
    background:white;
    padding:40px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    text-align:center;
    width:350px;
}

h2{
    margin-bottom:20px;
}

input[type="file"]{
    margin:20px 0;
    padding:10px;
    border:1px solid #ccc;
    border-radius:5px;
    width:100%;
}

button{
    background:#2b7cff;
    color:white;
    border:none;
    padding:12px;
    width:100%;
    border-radius:5px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#1a5fd1;
}

.note{
    font-size:12px;
    color:#666;
    margin-top:10px;
}

</style>
</head>

<body>

<div class="container">

<h2>Upload Student CSV</h2>

<form action="CSV_reader.php" method="POST" enctype="multipart/form-data">

<input type="file" name="csv_file" accept=".csv" required>

<button type="submit" name="submit">Upload CSV</button>

</form>
<a href="location: login_index.php">BACK TO LOG IN PAGE </a>
<p class="note">Upload the student master list in CSV format.</p>

</div>

</body>
</html>