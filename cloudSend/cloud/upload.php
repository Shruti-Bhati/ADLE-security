<?php
require_once('banner.php');
error_reporting(0);
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
{
echo "<script language=javascript>alert('Please Login first')</script>";
require_once('login.php');
exit(0);
}

?>
<body>
<div ="logout" align="right">
<a href = "logout.php">Logout User</a>
</div>

<form action="uploader.php" method="post" enctype="multipart/form-data">
   <p>
      <label style="font-size:20;">Select a file:</label> <input type="file" name="userfile" id="userfile"> <br />
      <button>Upload File</button>
   <p>
</form>
</body>