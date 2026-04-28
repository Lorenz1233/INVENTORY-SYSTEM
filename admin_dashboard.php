<?php
include 'db.php';

$result = mysqli_query($conn, "
SELECT items.*, unit.unit_name, category.category_name 
FROM items 
LEFT JOIN unit ON items.unit_id = unit.unit_id
LEFT JOIN category ON items.category_id = category.category_id
LEFT JOIN officials_masterlist ON items.received_by_official_id = officials_masterlist.last_name
WHERE items.status='active'
");        

$category = mysqli_query($conn,"SELECT * FROM category");
$units = mysqli_query($conn, "SELECT * FROM unit");
$official= mysqli_query($conn, "SELECT * FROM officials_masterlist");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inventory System</title>

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
}

h1{
    margin-bottom:20px;
    color:#1a3c2e;
}

.container{
    display:flex;
    gap:30px;
}

.card{
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.form-card{
    width:300px;
}

.form-group{
    margin-bottom:15px;
}

input, select{
    width:100%;
    padding:8px;
    border-radius:5px;
    border:1px solid #ccc;
}

button{
    width:100%;
    padding:10px;
    background:#2d6a4f;
    border:none;
    color:white;
    border-radius:5px;
    cursor:pointer;
}

button:hover{
    background:#1a3c2e;
}

.table-card{
    flex:1;
}

table{
    width:100%;
    border-collapse:collapse;
}

th, td{
    padding:10px;
    border-bottom:1px solid #ddd;
    text-align:left;
}

th{
    background:#2d6a4f;
    color:white;
}

tr:hover{
    background:#f1f1f1;
}

a{
    margin-right:10px;
    text-decoration:none;
    color:#2d6a4f;
}

a:hover{
    text-decoration:underline;
}
</style>
</head>

<body>

<h1>Inventory System</h1>

<div class="container">

<!-- LEFT SIDE -->
<div class="form-card">

<!-- ADD CATEGORY -->
<div class="card" style="margin-bottom:20px;">
<h3>Add Category</h3>
<form action="add_category_process.php" method="POST">

<div class="form-group">
<input type="text" name="category_name" placeholder="New Category" required>
</div>

<button type="submit">Add Category</button>
</form>
</div>

<!-- ADD UNIT -->
<div class="card" style="margin-bottom:20px;">
<h3>Add Unit</h3>
<form action="add_unit_process.php" method="POST">

<div class="form-group">
<input type="text" name="unit_name" placeholder="New Unit (e.g. pcs, kg)" required>
</div>

<button type="submit">Add Unit</button>
</form>
</div>

<!-- ADD ITEM -->
<div class="card">
<h3>Add Item</h3>

<form action="add_item_process.php" method="POST">

<div class="form-group">
<input type="text" name="item_name" placeholder="Item Name" required>
</div>

<div class="form-group">
<select name="category" required>
<option value="">Select Category</option>
<?php while($cat = mysqli_fetch_assoc($category)){ ?>
<option value="<?php echo $cat['category_id']; ?>">
<?php echo $cat['category_name']; ?>
</option>
<?php } ?>  
</select>
</div>

<div class="form-group">
<input type="number" name="quantity" min="1" placeholder="Quantity" required>
</div>

<div class="form-group">
<select name="unit_id" required>
<option value="">Select Unit</option>
<?php while($u = mysqli_fetch_assoc($units)){ ?>
<option value="<?php echo $u['unit_id']; ?>">
<?php echo $u['unit_name']; ?>
</option>
<?php } ?>
</select>
</div>

<div class="form-group">
<input type="number" name="available_quantity" min="0" placeholder="Available Quantity" required>
</div>

<div class="form-group">
<input type="text" name="description" placeholder="Description" required>
</div>

<div class="form-group">
<select name="received" required>
<option value="">Select official who received</option>
<?php while($u = mysqli_fetch_assoc($official)){ ?>
<option value="<?php echo $u['official_id']; ?>">
<?php echo $u['first_name']; ?>
</option>
<?php } ?>
</select>
</div>

<button type="submit">Add Item</button>
</form>

</div>
</div>

<!-- RIGHT SIDE -->
<div class="table-card card">

<h2>Inventory List</h2>

<table>
<tr>
<th>ID</th>
<th>Item Name</th>
<th>Category</th>   
<th>Quantity</th>
<th>Available Quantity</th>
<th>Date</th>
<th>Description</th>
<th>Received by:</th>
<th>Actions</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo $row['item_id']; ?></td>
<td><?php echo $row['item_name']; ?></td>
<td><?php echo $row['category_name']; ?></td>
<td><?php echo $row['total_quantity'] . " " . $row['unit_name']; ?></td>
<td><?php echo $row['available_quantity'] . " " . $row['unit_name']; ?></td>
<td><?php echo $row['date_added']; ?></td>
<td><?php echo $row['description']; ?></td>
<td><?php echo $row['received_by_official_id']; ?></td>

<td>
<a href="edit_item.php?id=<?php echo $row['item_id']; ?>">Edit</a>
<a href="delete_item.php?id=<?php echo $row['item_id']; ?>">Delete</a>
</td>
</tr>
<?php } ?>

</table>

</div>

</div>

</body>
</html>