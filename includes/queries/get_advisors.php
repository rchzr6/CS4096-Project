<?php
//gets all faculty members
$q = "SELECT COUNT(name) AS count FROM `faculty`";//getting number of advisors for the loop
$res = mysqli_query($con,$q);
$resar = $row = $res->fetch_assoc();;
$count = $resar['count']; //converting result to variable
$q = "SELECT `name` FROM `faculty` ORDER BY `name`";//getting all faculty members
$res = mysqli_query($con,$q);
//prints options
if($modadv==TRUE){
	echo '<select form="editbaseinfo" name="advisor" required>';//starting select option
	echo '<option value="'.$cadv.'">'.$cadv.'*</option>';
}
else
	echo '<select form="createwotwo" name="advisor" required>';//starting select option
while($count > 0){
$row = mysqli_fetch_row($res);//get next faculty member
 echo '<option value="'.$row[0].'">'.$row[0].'</option>';//print option
 --$count;
}
	echo '<option value="Cottrell, Mitch">Cottrell, Mitch</option>';
	echo '<option value="Schmid, Ken">Schmid, Ken</option>';
	echo '</select><br>';

?>