<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Course & Section Manager | PHP Ready</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: linear-gradient(135deg, #f5f7fc 0%, #e9eef5 100%);
      font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
      min-height: 100vh;
      padding: 2rem;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* main grid container for two cards */
    .dashboard {
      max-width: 1400px;
      width: 100%;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
      gap: 2rem;
    }

    /* reusable card style */
    .form-card {
      background: #ffffff;
      border-radius: 2rem;
      box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      transition: transform 0.2s ease;
    }

    .form-card:hover {
      transform: translateY(-4px);
    }

    .card-header {
      background: #1e3a5f;
      padding: 1.5rem 2rem;
      color: white;
    }

    .card-header h1 {
      font-size: 1.8rem;
      font-weight: 600;
      letter-spacing: -0.3px;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .card-header h1::before {
      font-size: 2rem;
    }

    .course-header h1::before {
      content: "📘";
    }

    .section-header h1::before {
      content: "📂";
    }

    .card-header p {
      margin-top: 0.5rem;
      opacity: 0.85;
      font-size: 0.9rem;
    }

    /* form body */
    .form-body {
      padding: 2rem;
    }

    .form-group {
      margin-bottom: 1.4rem;
    }

    label {
      display: block;
      font-weight: 600;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #2c4b6e;
      margin-bottom: 0.5rem;
    }

    .required-star {
      color: #d9534f;
      margin-left: 3px;
    }

    input, select, textarea {
      width: 100%;
      padding: 0.85rem 1rem;
      font-size: 1rem;
      border: 1.5px solid #e2e8f0;
      border-radius: 1rem;
      background: #fefefe;
      transition: all 0.2s ease;
      font-family: inherit;
      outline: none;
    }

    input:focus, select:focus, textarea:focus {
      border-color: #1e3a5f;
      box-shadow: 0 0 0 3px rgba(30, 58, 95, 0.15);
      background: #ffffff;
    }

    textarea {
      resize: vertical;
      min-height: 80px;
    }

    .row-2cols {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.2rem;
    }

    /* buttons */
    .btn-submit {
      background: #1e3a5f;
      color: white;
      border: none;
      padding: 0.9rem 1.8rem;
      font-size: 1rem;
      font-weight: 600;
      border-radius: 2rem;
      cursor: pointer;
      width: 100%;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-top: 0.8rem;
      font-family: inherit;
    }

    .btn-submit:hover {
      background: #0f2c48;
      transform: translateY(-2px);
      box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
    }

    .btn-submit:active {
      transform: translateY(1px);
    }

    .btn-reset {
      background: #eef2f7;
      color: #3a5a7a;
      border: none;
      padding: 0.75rem 1.5rem;
      font-size: 0.9rem;
      font-weight: 500;
      border-radius: 2rem;
      cursor: pointer;
      transition: 0.2s;
      margin-top: 0.8rem;
      width: 100%;
    }

    .btn-reset:hover {
      background: #e2e8f0;
    }

    .button-group {
      display: flex;
      gap: 1rem;
      margin-top: 0.5rem;
    }

    hr {
      margin: 1.2rem 0;
      border: none;
      height: 1px;
      background: #e4edf5;
    }

    .info-note {
      background: #f0f6fe;
      padding: 0.8rem 1rem;
      border-radius: 1rem;
      font-size: 0.8rem;
      color: #2c5a7a;
      text-align: center;
      margin-top: 1.5rem;
      border-left: 4px solid #1e3a5f;
    }

    @media (max-width: 850px) {
      body {
        padding: 1rem;
      }
      .dashboard {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }
      .form-body {
        padding: 1.5rem;
      }
      .row-2cols {
        grid-template-columns: 1fr;
        gap: 1rem;
      }
      .card-header h1 {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>
<div class="dashboard">
  
  <!-- CARD 1: ADD COURSE FORM -->
  <div class="form-card">
    <div class="card-header course-header">
      <h1>Course Adder</h1>
      <p>Fill in course details — sends to <strong>add_course_process.php</strong></p>
    </div>
    <div class="form-body">
      <form action="add_course_process.php" method="POST">
        <div class="form-group">
          <label>Course name <span class="required-star">*</span></label>
          <input type="text" name="course_name" placeholder="e.g., Introduction to Web Development" required>
        </div>
        <div class="row-2cols">
          <div class="form-group">
            <label>Course code <span class="required-star">*</span></label>
            <input type="text" name="course_code" placeholder="e.g., CS50, WEB101" required>
          </div>
  
        <div class="button-group">
          <button type="submit" class="btn-submit">➕ Add Course</button>
          <button type="reset" class="btn-reset">⟳ Clear Form</button>
        </div>
      </form>
      <div class="info-note">
        💡 <strong>PHP ready:</strong> POST data will be sent to <code>add_course_process.php</code>. Create that file to handle insertion.
      </div>
    </div>
  </div>

      <div class="info-note">
        💡 <strong>Backend tip:</strong> Use <code>$_POST['section_name']</code>, <code>$_POST['section_code']</code> etc. in <code>add_section_process.php</code>.
      </div>
    </div>
  </div>

</div>
</body>
</html>