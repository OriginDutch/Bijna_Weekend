<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylingglobal.css">
    <?php include '../functions.php'; ?>
    <?php include 'adminfunctions.php'; ?>

</head>
<body> 

    <!-- Sidebar -->
    <?php include 'adminsidebar.php';?>
    <div class="content">
        <?php loadClassMembers(); ?>
        <button onclick="history.go(-1);">Back </button>
    </div>
</body>
</html>