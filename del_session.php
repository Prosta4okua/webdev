<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv = "refresh" content = "3; url = login.php" />
</head>
<body>
Redirecting to login page...
<?php
// remove all session variables
session_unset();
// destroy the session
session_destroy();
?>
</body>
</html>
