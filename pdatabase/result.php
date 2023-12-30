<?php 
session_start();


include("connection.php");
include("functions.php");

$sql = "SELECT id,username, votes FROM userdata WHERE role = 'candidate'";
$result=mysqli_query($con,$sql);
$html='<table><tr><td>Id</td><td>Username</td><td>Votes
</td>';
while($row=mysqli_fetch_assoc($result))
{
    $html.='<tr><td>'.$row['id'].'</td><td>'.$row['username'].'</td><td>'.$row['votes'].'<td></td>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=result.xls');
echo $html;
?>
