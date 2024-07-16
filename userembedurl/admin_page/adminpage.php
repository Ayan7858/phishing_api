<?php
// Sample data for dropdown options
$options = [
    'http://localhost/phishing_product_2/httpdocs/create_db_page.php' => 'Page 1',
    'http://localhost/phishing_product/httpdocs/table_view/index.php' => 'Page 2',
    'http://localhost/phishing_product_2/httpdocs/table_view/index.php' => 'Page 3',
];

$selectedUrl = isset($_POST['url']) ? $_POST['url'] : array_key_first($options);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }
        iframe {
            width: 100%;
            height: 500px;
            border: none;
            margin-top: 20px;
        }
        .controls {
            margin: 20px 0;
        }
        .controls select {
            padding: 10px;
            font-size: 16px;
        }
        .controls button {
            padding: 10px 20px;
            font-size: 16px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Admin Page</h1>
    <form method="post" id="urlForm">
        <div class="controls">
            <select name="url" onchange="document.getElementById('urlForm').submit();">
                <?php foreach ($options as $url => $label): ?>
                    <option value="<?php echo htmlspecialchars($url); ?>" <?php if ($selectedUrl == $url) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($label); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="button" onclick="prevUrl()">Previous</button>
            <button type="button" onclick="nextUrl()">Next</button>
        </div>
    </form>
    <iframe id="iframe" src="<?php echo htmlspecialchars($selectedUrl); ?>"></iframe>
</div>

<script>
    let urls = <?php echo json_encode(array_keys($options)); ?>;
    let currentIndex = urls.indexOf('<?php echo $selectedUrl; ?>');

    function prevUrl() {
        if (currentIndex > 0) {
            currentIndex--;
            document.querySelector('select[name="url"]').value = urls[currentIndex];
            document.getElementById('urlForm').submit();
        }
    }

    function nextUrl() {
        if (currentIndex < urls.length - 1) {
            currentIndex++;
            document.querySelector('select[name="url"]').value = urls[currentIndex];
            document.getElementById('urlForm').submit();
        }
    }
</script>
</body>
</html>
