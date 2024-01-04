<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Video Cards</title>
</head>

<body>

    <div id='form'>
        <form id="videoCardForm">
            <label for="brandSelect">Select Video Card Brand:</label>
            <select id="brandSelect">
                <option value="AMD">AMD</option>
                <option value="MSI">MSI</option>
                <option value="ASUS">ASUS</option>
            </select>
            <button type="submit">Get Video Cards</button>
        </form>
    </div>

    <div id="result"></div>

    <script src="script.js"></script>
</body>

</html>