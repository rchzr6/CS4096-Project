<?php

		if(isset($_POST['submit'])){
if(!empty($_POST['file'])){
echo $_POST['file'];
	//include '../includes/handlefiles.php';// define the posted file into variables 
$fname = $_FILES['file']['name']; 
$tmp_name = $_FILES['file']['tmp_name']; 
$type = $_FILES['file']['type']; 
$size = $_FILES['file']['size']; 

// if your server has magic quotes turned off, add slashes manually 
if(!get_magic_quotes_gpc()){ 
$fname = addslashes($fname); 
} 

// open up the file and extract the data/content from it 
$extract = fopen($tmp_name, 'r'); 
$content = fread($extract, $size); 
$content = addslashes($content); 
fclose($extract);  

// the query that will add this to the database 

     if(!empty($_FILES)) 
    { 
        $target = "../files/"; 
        $target = $target . basename( $_FILES['file']['name']) ; 
        $ok=1; 
        $file_size = $_FILES['file']['size']; 
        $file_type=$_FILES['file']['type']; 
        //This is our size condition 
        if ($file_size > 50000000) 
           { 
           echo "Your file is too large.<br>"; 
           $ok=0; 
           } 

        //This is our limit file type condition 
        if ($file_type =="text/php") 
        { 
            echo "No PHP files<br>"; 
            $ok=0; 
        } 

        //Here we check that $ok was not set to 0 by an error 
        if ($ok==0) 
        { 
            Echo "Sorry your file was not uploaded"; 
        } 

        //If everything is ok we try to upload it 
        else 
        { 
            if(move_uploaded_file($_FILES['file']['tmp_name'], $target)) 
            { 
                echo "The file ". basename( $_FILES['file']['name']). " has been uploaded <br/>"; 
            } 
                        else 
                        { 
                            echo "Sorry, there was a problem uploading your file."; 
                        } 
         } 
mysqli_close();  

echo "Successfully uploaded your file!";       
}
else{
die("No uploaded file present"); 
}
}
		//GETS THE FILE NAME AND DESCRIPTIONS
		$fname = $_FILES['file']['name']; 
		if(!empty($fname))
			$file = $fname;
		else
			$file = 'NO_FILES.php';
		//UPDATES THE WORK ORDER TO REFLECT THE DESCRIPTIONS, FILE, AND ADVISOR
		$q = "UPDATE `work_orders` SET `wo_file_list` = '$file' WHERE `wo_num` = $newnum";
		//echo $q;
		mysqli_query($con,$q);
		//GETS LATEST TRANSACTION NUMBER AND INCREMENTS BY 1
		$q = "SELECT `transaction_num` FROM `transaction` ORDER BY `transaction_num` DESC";
		$res = mysqli_query($q);
		$resa = mysqli_fetch_array($res);
		$tnum = $resa[0];
		$tnum++;
		//CREATES NEW TRANSACTION
		$com = 'Cbild Work Order Submitted - Parent = '.$pnum;
		$q = "INSERT INTO transaction(transaction_num,wo_num,wo_status,transaction_by,comments,hours_logged) VALUES ($tnum,$newnum,'New','$name','$com','0')";
		mysqli_query($con,$q);
	}
	
?>