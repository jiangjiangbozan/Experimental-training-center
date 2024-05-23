<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<body>
    <form action="{:url('login')}" method="post">
        <label for="name">name:</label><input type="text" name="name" id="name" />
        <label for="passwords">passwords:</label><input type="passwords" name="passwords" id="passwords" />
        <button type="submit">submit</button>
    </form>
</body>
</html>