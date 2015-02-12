<?PHP
$user = $_POST['select_who'];
$type = $_POST['type'];

$q = "SELECT `id_num`, `name` FROM `$type` WHERE `name` = '$user'";
$res = mysqli_query($con,$q);
$row = mysqli_fetch_row($res);
$name = $row[1];
$id = $row[0];
//echo $q;

$q = "DELETE FROM `$type` WHERE `id_num` = '$id'";
mysqli_query($con,$q);
$q = "DELETE FROM `member` WHERE `id` = '$id'";
mysqli_query($con,$q);
if($type == 'staff'){
	$q = "DELETE FROM `group` WHERE `user_name` = '$name'";
	mysqli_query($con,$q);
}
unset($_POST['Submit']);
unset($_POST['Submit1']);

?>