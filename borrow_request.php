<?php
include 'db.php';

$borrow = mysqli_query($conn,"SELECT * FROM items");
$category = mysqli_query($conn,"SELECT * FROM category");
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Borrow Item Request</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#f4f6f9;
padding:40px;
display:flex;
align-items:flex-start;
gap:30px;
}

/* BORROW FORM */

.borrow-card{
background:white;
padding:30px;
border-radius:10px;
width:350px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.borrow-card h2{
text-align:center;
margin-bottom:20px;
color:#1a3c2e;
}

.form-group{
margin-bottom:15px;
}

label{
font-size:14px;
display:block;
margin-bottom:5px;
}

input, select, textarea{
width:100%;
padding:8px;
border-radius:5px;
border:1px solid #ccc;
}

textarea{
resize:none;
height:70px;
}

button{
width:100%;
padding:10px;
background:#2d6a4f;
border:none;
color:white;
border-radius:5px;
cursor:pointer;
font-weight:500;
}

button:hover{
background:#1a3c2e;
}

/* TABLE AREA */

.tables-container{
display:flex;
gap:30px;
}

/* TABLE CARD */

.items-card{
background:white;
padding:25px;
border-radius:10px;
width:500px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.items-card h3{
margin-bottom:15px;
color:#1a3c2e;
}

table{
width:100%;
border-collapse:collapse;
}

th, td{
padding:10px;
border-bottom:1px solid #ddd;
text-align:left;
font-size:14px;
}

th{
background:#2d6a4f;
color:white;
}

tr:hover{
background:#f1f1f1;
}

.items-card{
background:white;
padding:25px;
border-radius:10px;
width:650px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.items-card h3{
margin-bottom:15px;
color:#1a3c2e;
font-size:18px;
}

.table-wrapper{
overflow-x:auto;
}

table{
width:100%;
border-collapse:collapse;
font-size:14px;
}

th{
background:#2d6a4f;
color:white;
padding:12px;
text-align:left;
}

td{
padding:12px;
border-bottom:1px solid #eee;
}

tr:hover{
background:#f7f7f7;
}

td:nth-child(1){
font-weight:600;
color:#555;
}

td:nth-child(4){
color:#2d6a4f;
font-weight:500;
}

</style>
</head>

<body>

<!-- BORROW FORM -->

<div class="borrow-card">

<h2>Borrow Item Request</h2>

<form action="borrow_request_process.php" method="POST">

<div class="form-group">
<label>Select Item</label>
<select name="item_id" required>
<option value="">Choose Item</option>

<?php while($cat = mysqli_fetch_assoc($borrow)){ ?>
<option value="<?php echo $cat['item_id']; ?>">
<?php echo $cat['item_id']; ?> - <?php echo $cat['item_name']; ?>
</option>
<?php } ?> 


</select>
</div>

<!-- form for requesting item -->

<div class="form-group">
<label>Quantity</label>
<input type="number" name="quantity" min="1" required>
</div>

<div class="form-group">
<label>Borrower Student_ID</label>
<input type="number" name="student_id" required>
</div>

<div class="form-group">
<label>Days to Return</label>
<input type="number" name="return_date" required>
</div>

<div class="form-group">
<label>Purpose</label>
<textarea name="purpose"></textarea>
</div>

<button type="submit">Submit Request</button>

</form>

</div>

<div class="items-card">

<h3>Available Items</h3>

<div class="table-wrapper">

<table>

<thead>
<tr>
<th>ID</th>
<th>Item</th>
<th>Total</th>
<th>Available</th>
<th>Description</th>
</tr>
</thead>

<tbody>

<?php
$borrow = mysqli_query($conn,"SELECT * FROM items");

while($row = mysqli_fetch_assoc($borrow)){
?>

<tr>

<td><?php echo $row['item_id']; ?></td>
<td><?php echo $row['item_name']; ?></td>
<td><?php echo $row['quantity']; ?></td>
<td><?php echo $row['available_quantity']; ?></td>
<td><?php echo $row['description']; ?></td>

</tr>

<?php } ?>

</tbody>
</table>

</div>

</div>

</div>

</body>
</html>