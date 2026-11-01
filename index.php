<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laboratory Exercise 9 - Working with Forms</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Working with Forms</h2>
        <?php
        $errors = [];
        $success = false;
        $results = [];

        // Check if the form has been submitted via POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $words = [
                "Word 1" => trim($_POST['Word1'] ?? ''),
                "Word 2" => trim($_POST['Word2'] ?? ''),
                "Word 3" => trim($_POST['Word3'] ?? ''),
                "Word 4" => trim($_POST['Word4'] ?? '')
            ];

            // Validate each input field according to task requirements
            foreach ($words as $key => $value) {
                if (empty($value)) {
                    $errors[$key] = "Error for \"$key\": This field is required";
                } elseif (!ctype_alpha($value)) {
                    $errors[$key] = "Error for \"$key\": Must contain only letters";
                } elseif (strlen($value) < 4 || strlen($value) > 7) {
                    $errors[$key] = "Error for \"$key\": Must be between 4 and 7 characters long";
                }
            }

            // If no errors, process the words using strtoupper() and str_shuffle()
            if (empty($errors)) {
                $success = true;
                foreach ($words as $key => $value) {
                    $results[$key] = strtoupper(str_shuffle($value));
                }
            }
        }
        ?>

        <?php if (!empty($errors)): ?>
            <!-- Error Message Display View -->
            <div class="error-box">
                <?php foreach ($errors as $err): ?>
                    <p><?php echo $err; ?></p>
                <?php endforeach; ?>
                <p>Please use the "Back" button to re-enter the data[cite: 14].</p>
                <br>
                <a href="index.php" class="back-btn">&lt;&lt; Back</a>
            </div>
        <?php elseif ($success): ?>
            <!-- Successful Output View -->
            <div class="output-box">
                <h3>The Output:</h3>
                <?php foreach ($results as $key => $jumbled): ?>
                    <p><strong><?php echo $key; ?>:</strong> <?php echo $jumbled; ?></p>
                <?php endforeach; ?>
                <br>
                <a href="index.php" class="back-btn">&lt;&lt; Back to Form</a>
            </div>
        <?php else: ?>
            <!-- Input Form View -->
            <form method="POST" action="">
                <div class="form-group">
                    <label>Word 1:</label>
                    <input type="text" name="Word1">
                </div>
                <div class="form-group">
                    <label>Word 2:</label>
                    <input type="text" name="Word2">
                </div>
                <div class="form-group">
                    <label>Word 3:</label>
                    <input type="text" name="Word3">
                </div>
                <div class="form-group">
                    <label>Word 4:</label>
                    <input type="text" name="Word4">
                </div>
                <div class="btn-group">
                    <input type="reset" value="Clear Form">
                    <input type="submit" value="Send Form">
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>