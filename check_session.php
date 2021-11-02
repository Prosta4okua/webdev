<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
if (isset($_SESSION["name"]) == true)
    echo $_SESSION["name"];
else
    echo "Session wasn't started";
?>
</body>
</html>