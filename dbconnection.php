<?php
$con=mysqli_connect("localhost", "root", "", "prison");
if(mysqli_connect_errno())
{
echo "Connection Fail".mysqli_connect_error();
}
?>