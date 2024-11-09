<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data Entry</title>
    <link rel="stylesheet" type="text/css" href="new.css"> <!-- Link to your CSS file -->
    <link rel="manifest" href="/PWA-JSON/manifest.json">

</head>
<body>
    <!-- Inline CSS to center the welcome message at the top -->
    <h2 style="text-align: center; position: absolute; top: 20px; left: 50%; transform: translateX(-50%); color: #006400;">
        Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
    </h2>

    <!-- Student Form with inline CSS for background image -->
    <div id="studentFormContainer" style="border: solid gray 1px; width: 25%; border-radius: 2px; margin: 120px auto; background: url('images/bg.jpg') no-repeat center center/cover; padding: 50px; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1); text-align: center;">
        <form id="studentForm">
            <div class="form-group">
                <label for="sr_no">Sr_Number:</label>
                <input type="number" id="sr_no" name="sr_no" required>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="class">Class:</label>
                <input type="text" id="class" name="class" required>
            </div>

            <div class="form-group">
                <label for="grade">Grade:</label>
                <input type="text" id="grade" name="grade" required>
            </div>

            <button type="button" onclick="submitStudentData()">Submit</button>
        </form>
        <div id="studentResponse"></div>
    </div>

    <script>
        function submitStudentData() {
            const data = {
                sr_no: document.getElementById('sr_no').value,
                name: document.getElementById('name').value,
                class: document.getElementById('class').value,
                grade: document.getElementById('grade').value
            };

            fetch('process_student_data_json.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                document.getElementById('studentResponse').innerText = result.message;
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
    <script>
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('/project-JSON/service-worker.js')
      .then(reg => console.log('Service Worker registered!', reg))
      .catch(err => console.log('Service Worker registration failed!', err));
    });
  }
</script>

</body>
</html>
