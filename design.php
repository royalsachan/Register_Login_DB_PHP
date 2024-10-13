<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design Visiting Card</title>
    <link rel="stylesheet" href="../230101021_lab_12_styles.css">
</head>
<body>
    <h2>Design Your Visiting Card</h2>
    <form id="designForm" action="?page=design" method="post" enctype="multipart/form-data">
        <input type="text" id="name" name="name" required placeholder="Name">
        <input type="text" id="designation" name="designation" required placeholder="Designation">
        <input type="email" id="email" name="email" required placeholder="Email">
        <input type="text" id="mobile" name="mobile" required placeholder="Mobile">
        <input type="text" id="organization" name="organization" required placeholder="Organization">
        <input type="file" id="logo" name="logo" accept="image/*" required>
        <select id="format" name="format">
            <option value="1">Format 1</option>
            <option value="2">Format 2</option>
            <option value="3">Format 3</option>
            <option value="4">Format 4</option>
        </select>
        <input type="color" id="primary_color" name="primary_color">
        <input type="color" id="secondary_color" name="secondary_color">
        <input type="color" id="text_color" name="text_color">
        <button type="submit">Create Card</button>
    </form>
    <div id="cardPreview" class="card"></div>
    <script src="../230101021_lab_12_script.js"></script>
</body>
</html>
