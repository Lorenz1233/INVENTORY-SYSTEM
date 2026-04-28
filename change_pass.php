<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green-dark:  #1a3c2e;
            --green-mid:   #2d6a4f;
            --green-light: #52b788;
            --green-pale:  #d8f3dc;
            --cream:       #f8f5f0;
            --text-dark:   #1a1a1a;
            --text-muted:  #6b7c74;
            --white:       #ffffff;
        }

        body {
            min-height: 100vh;
            background-color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: -120px;
            right: -120px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: var(--green-pale);
            opacity: 0.6;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -100px;
            left: -100px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: var(--green-pale);
            opacity: 0.4;
            z-index: 0;
        }

        .card {
            background: var(--white);
            border-radius: 20px;
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 1;
            box-shadow: 0 8px 40px rgba(26, 60, 46, 0.10);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 10%; right: 10%;
            height: 4px;
            background: linear-gradient(90deg, var(--green-mid), var(--green-light));
            border-radius: 0 0 8px 8px;
        }

        .icon-wrap {
            width: 54px;
            height: 54px;
            background: var(--green-pale);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.4rem;
        }

        .icon-wrap svg {
            width: 24px;
            height: 24px;
            stroke: var(--green-mid);
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.7rem;
            color: var(--green-dark);
            margin-bottom: 0.4rem;
        }

        .subtitle {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .notice {
            background: var(--green-pale);
            border-left: 3px solid var(--green-light);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.8rem;
            color: var(--green-mid);
            margin-bottom: 1.75rem;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.4rem;
            letter-spacing: 0.02em;
        }

        input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid #e0dbd4;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            color: var(--text-dark);
            background: var(--cream);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="password"]:focus {
            border-color: var(--green-light);
            box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.15);
            background: var(--white);
        }

        .hint {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.35rem;
        }

        .btn-submit {
            width: 100%;
            padding: 0.85rem;
            background: var(--green-mid);
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            margin-top: 0.75rem;
            letter-spacing: 0.02em;
            transition: background 0.2s;
        }

        .btn-submit:hover  { background: var(--green-dark); }
        .btn-submit:active { transform: scale(0.98); }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .back-link a {
            color: var(--green-mid);
            text-decoration: none;
            font-weight: 500;
        }

        .back-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="card">

    <div class="icon-wrap">
        <svg viewBox="0 0 24 24">
            <rect x="3" y="11" width="18" height="11" rx="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
        </svg>
    </div>

    <h1>Set New Password</h1>
    <p class="subtitle">Welcome! Since this is your first login, please set a new password to secure your account.</p>

    <div class="notice">
        🔒 Your default password was your <strong>Student ID + Last Name</strong>. Please change it now.
    </div>

    <form action="change_pass.php" method="POST">

     <div class="form-group">
            <label for="id">Enter id</label>
            <input type="text" id="confirm_password" name="id" placeholder="Enter id" required>
        </div>

        <div class="form-group">
            <label for="new_password">Current password</label>
            <input type="text" id="new_password" name="current_password" placeholder="Enter curent password" required>
            <p class="hint">At least 8 characters recommended.</p>
        </div>

        <div class="form-group">
            <label for="confirm_password">New password</label>
            <input type="password" id="confirm_password" name="new_password" placeholder="Enter new password" required>
        </div>

        <button type="submit" name="SUBMIT" class="btn-submit">Update Password</button>
        <a href="login_index.php">BACK TO LOG IN</a>
    </form>

    <p class="back-link"><a href="login_index.php">← Back to Login</a></p>

</div>

</body>
</html>

<?php
include 'db.php';

if(isset($_POST['SUBMIT'])){

    $user_id = $_POST['id'];
    $curr = $_POST['current_password'];
    $newpass = $_POST['new_password'];
    
    $sql = mysqli_query($conn,"SELECT * FROM users WHERE student_id='$user_id'");
    $user = mysqli_fetch_assoc($sql);

    if($user){

        if($curr == $user['password']){

            if(strlen($newpass) < 8){
                echo "New password must be at least 8 characters.";
                exit();
            }

            $update = mysqli_query($conn,
            "UPDATE users 
            SET password='$newpass', is_default_password='0' 
            WHERE student_id='$user_id'");

            if($update){
                echo "SUCCESSFULLY EDITED."; 
            }

            else{
                echo "Password update failed.";
            }

        }
        else{
            echo "Current password is incorrect.";
        }

    }else{
        echo "Student ID not found.";
    }
}
?>