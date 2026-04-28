<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Course & Enrollment Manager | PHP Ready</title>
  <!-- Google Fonts & Font Awesome (lightweight) -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(145deg, #eef2f9 0%, #d9e0ec 100%);
      min-height: 100vh;
      padding: 2rem 1.5rem;
      color: #1a2c3e;
    }

    .dashboard-container {
      max-width: 1400px;
      margin: 0 auto;
    }

    /* header */
    .page-header {
      text-align: center;
      margin-bottom: 2.5rem;
    }
    .page-header h1 {
      font-size: 2.2rem;
      font-weight: 700;
      background: linear-gradient(135deg, #1f3a4b, #2b5e7a);
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
      letter-spacing: -0.3px;
      display: inline-flex;
      align-items: center;
      gap: 12px;
    }
    .page-header h1 i {
      background: none;
      color: #2c7da0;
      font-size: 2rem;
    }
    .page-header p {
      color: #2c4b5e;
      font-weight: 500;
      margin-top: 0.6rem;
      background: rgba(255,255,255,0.6);
      display: inline-block;
      padding: 0.25rem 1.2rem;
      border-radius: 40px;
      backdrop-filter: blur(2px);
    }

    /* two column grid */
    .forms-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      margin-top: 1rem;
    }

    /* card style */
    .form-card {
      background: rgba(255,255,255,0.96);
      border-radius: 2rem;
      box-shadow: 0 20px 35px -12px rgba(0,0,0,0.15);
      transition: transform 0.2s ease;
      overflow: hidden;
      border: 1px solid rgba(255,255,255,0.5);
    }
    .form-card:hover {
      transform: translateY(-4px);
    }

    .card-header {
      background: #f8fafd;
      padding: 1.2rem 1.8rem;
      border-bottom: 1px solid #e2edf2;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .card-header h2 {
      font-size: 1.55rem;
      font-weight: 600;
      color: #1b4f6e;
    }
    .card-header i {
      font-size: 1.7rem;
      color: #2c7da0;
    }

    form {
      padding: 1.6rem 1.8rem 2rem 1.8rem;
    }

    .input-group {
      margin-bottom: 1.25rem;
      display: flex;
      flex-direction: column;
    }

    .input-group label {
      font-weight: 600;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 0.4px;
      color: #2b5f7a;
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .input-group label i {
      font-size: 0.85rem;
      color: #408eac;
    }
    .required-star {
      color: #e05252;
      font-size: 0.9rem;
      margin-left: 4px;
    }

    input, select {
      font-family: 'Inter', sans-serif;
      font-size: 0.95rem;
      padding: 0.8rem 1rem;
      border-radius: 1rem;
      border: 1.5px solid #dfe9ef;
      background-color: #ffffff;
      transition: all 0.2s;
      outline: none;
      color: #1f3b4c;
      font-weight: 500;
    }
    input:focus, select:focus {
      border-color: #2c7da0;
      box-shadow: 0 0 0 3px rgba(44,125,160,0.2);
    }

    /* button group */
    .button-group {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      margin-top: 1.8rem;
    }
    .btn-primary, .btn-secondary {
      flex: 1;
      font-weight: 600;
      font-size: 0.9rem;
      padding: 0.8rem 0rem;
      border-radius: 2.2rem;
      border: none;
      cursor: pointer;
      transition: 0.2s;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      font-family: 'Inter', sans-serif;
    }
    .btn-primary {
      background: #1f5e7e;
      color: white;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .btn-primary:hover {
      background: #0f4c69;
      transform: scale(0.98);
    }
    .btn-secondary {
      background: #eef2f7;
      color: #2a5f7a;
      border: 1px solid #cbdde6;
    }
    .btn-secondary:hover {
      background: #e2eaf1;
      transform: scale(0.98);
    }

    /* small hint */
    small.hint {
      color: #6f9bb3;
      font-size: 0.7rem;
      margin-top: 0.3rem;
      display: block;
    }
    footer {
      text-align: center;
      margin-top: 3rem;
      font-size: 0.8rem;
      color: #466b80;
      font-weight: 500;
    }

    @media (max-width: 850px) {
      .forms-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }
      body {
        padding: 1rem;
      }
    }
  </style>
</head>
<body>
<div class="dashboard-container">
  <div class="page-header">
    <h1>
      <i class="fas fa-users-between"></i> 
      Add Officials & Students
    </h1>
    <p><i class="fas fa-pen-alt"></i> Fill the forms — data will be sent to your PHP processor</p>
  </div>

  <div class="forms-grid">

    <!-- OFFICIAL FORM CARD (PHP ready) -->
    <div class="form-card">
      <div class="card-header">
        <i class="fas fa-user-tie"></i>
        <h2>Register Official</h2>
      </div>
      <form action="add_student_officials_process.php" method="POST">
        <div class="input-group">
          <label><i class="fas fa-user"></i> First name <span class="required-star">*</span></label>
          <input type="text" name="official_first_name" placeholder="e.g., Sarah" required>
        </div>
        <div class="input-group">
          <label><i class="fas fa-user"></i> Last name <span class="required-star">*</span></label>
          <input type="text" name="official_last_name" placeholder="e.g., Williams" required>
        </div>
        <div class="input-group">
          <label><i class="fas fa-id-card"></i> Employee ID <span class="required-star">*</span></label>
          <input type="text" name="employee_id" placeholder="EMP-2025-001" required>
        </div>
        <div class="input-group">
          <label><i class="fas fa-briefcase"></i> Position <span class="required-star">*</span></label>
          <input type="text" name="position" placeholder="Dean, Coordinator, Principal" required>
        </div>

        <div class="button-group">
          <button type="submit" class="btn-primary"><i class="fas fa-plus-circle"></i> Add Official</button>
          <button type="reset" class="btn-secondary"><i class="fas fa-eraser"></i> Clear</button>
        </div>
      </form>
    </div>

    <!-- STUDENT FORM CARD (PHP ready with dynamic course dropdown from DB) -->
    <div class="form-card">
      <div class="card-header">
        <i class="fas fa-user-graduate"></i>
        <h2>Enroll Student</h2>
      </div>
      <form action="add_student_officials_process.php" method="POST">
        <div class="input-group">
          <label><i class="fas fa-user"></i> First name <span class="required-star">*</span></label>
          <input type="text" name="first_name" placeholder="e.g., Emily" required>
        </div>
        <div class="input-group">
          <label><i class="fas fa-user"></i> Last name <span class="required-star">*</span></label>
          <input type="text" name="last_name" placeholder="e.g., Clarke" required>
        </div>
        <div class="input-group">
          <label><i class="fas fa-id-badge"></i> Student ID <span class="required-star">*</span></label>
          <input type="text" name="student_id" placeholder="STU-24-1089" required>
        </div>
        <div class="input-group">
          <label><i class="fas fa-chart-line"></i> Year Level <span class="required-star">*</span></label>
          <select name="year" required>
            <option value="" disabled selected>— Select Year —</option>
            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>
          </select>
        </div>
        <div class="input-group">
          <label><i class="fas fa-book-open"></i> Course <span class="required-star">*</span></label>
          <select name="course" required>
            <option value="">Select Course</option>
            <?php
            include 'db.php';
            $courseQuery = mysqli_query($conn, "SELECT course_code, course_name FROM course");
            if ($courseQuery && mysqli_num_rows($courseQuery) > 0) {
                while ($row = mysqli_fetch_assoc($courseQuery)) {
                    $code = htmlspecialchars($row['course_code']);
                    $name = htmlspecialchars($row['course_name']);
                    echo "<option value=\"$code\">$name ($code)</option>";
                }
            } else {
                echo "<option disabled>No courses available</option>";
            }
            ?>
          </select>
  
        </div>
        <div class="button-group">
          <button type="submit" class="btn-primary"><i class="fas fa-user-plus"></i> Add Student</button>
          <button type="reset" class="btn-secondary"><i class="fas fa-eraser"></i> Clear</button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>