<?php
include 'db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM items WHERE item_id = $id");
    $item = mysqli_fetch_assoc($result);
}

if(isset($_POST['update'])){
    $name = $_POST['item_name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $available_quantity = $_POST['available_quantity'];
    $description = $_POST['description'];

    mysqli_query($conn, "UPDATE items SET item_name='$name', category='$category', quantity='$quantity', description='$description', available_quantity='$available_quantity' WHERE item_id=$id");
    header("Location: admin_dashboard.php"); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Item</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f4f6f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.edit-card {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    width: 350px;
}

.edit-card h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #1a3c2e;
}

.edit-card .form-group {
    margin-bottom: 15px;
}

.edit-card input, .edit-card select {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.edit-card button {
    width: 100%;
    padding: 10px;
    background: #2d6a4f;
    border: none;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 500;
}

.edit-card button:hover {
    background: #1a3c2e;
}

</style>
</head>
<body>

<div class="edit-card">
    <h2>Edit Item</h2>
    <form method="POST">
        <div class="form-group">
            <input type="text" name="item_name" value="<?php echo $item['item_name']; ?>" placeholder="Item Name" required>
        </div>
        <div class="form-group">
            <select name="category" required>
                <option value="">Select Category</option>
                <option <?php if($item['category']=='Electronics') echo 'selected'; ?>>Electronics</option>
                <option <?php if($item['category']=='Furniture') echo 'selected'; ?>>Furniture</option>
                <option <?php if($item['category']=='Office Supplies') echo 'selected'; ?>>Office Supplies</option>
                <option <?php if($item['category']=='Laboratory') echo 'selected'; ?>>Laboratory</option>
            </select>
        </div>
        <div class="form-group">
            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" placeholder="Quantity" required>
        </div>

        <div class="form-group">
            <input type="number" name="available_quantity" value="<?php echo $item['available_quantity']; ?>" placeholder="available quantity" required>
        </div>
        
        <div class="form-group">
            <input type="text" name="description" value="<?php echo $item['description']; ?>" placeholder="Description" required>
        </div>
        <button type="submit" name="update">Update</button>
    </form>
</div>

</body>
</html>