<?PHP

//this is where 
$target_dir = "../files/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$filename = $_FILES["fileToUpload"]["tmp_name"];

// Check if file already exists, if so create a unique id and try against

//$fileName = uniqid() . '.'.$imageFileType;
$fileName = 'WorkOrder_'.$newnum.'_Files.'.$imageFileType;
$target_file = ($target_dir . $fileName);

// Check file size
if ($_FILES["fileToUpload"]["size"] > 3500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
//Allow certain file formats
if($imageFileType != "PDF" &&
$imageFileType != "JPG" &&
$imageFileType != "GIF" &&
$imageFileType != "PNG" &&
$imageFileType != "STL" &&
$imageFileType != "Prt" &&
$imageFileType != "SLPRT" &&
$imageFileType != "X_T" &&
$imageFileType != "X_B" &&
$imageFileType != "IGS" &&
$imageFileType != "STP" &&
$imageFileType != "STEP" &&
$imageFileType != "Eprt" &&
$imageFileType != "Crg" &&
$imageFileType != "Dxf" &&
$imageFileType != "Dwg" &&
$imageFileType != "Psd" &&
$imageFileType != "Ai" &&
$imageFileType != "Vi" &&
$imageFileType != "Drw" &&
$imageFileType != "SLDRW" &&
$imageFileType != "tif" &&
$imageFileType != "zip"
) {
    echo "Sorry, you uploaded an unacceptable file type. Please upload your files using one of the following types:<br> PDF, JPG, GIF, PNG, STL, Prt, SLPRT, X_T, X_B, IGS, STP, STEP, Eprt, Crg, Dxf, Dwg, Psd, Ai, Vi, Drw, SLDRW, tif, or zip<br>";
    $uploadOk = 0;
	$_SESSION['go'] = TRUE;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($filename, $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>