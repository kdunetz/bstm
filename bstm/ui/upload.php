 <?php $target = "upload/"; $target = $target . basename( $_FILES['uploaded']['name']) ; 

$ok=1; 

if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
{ 
   #echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded"; 
   echo "This feature has not been enabled yet.  Please check back in a few weeks"; 
} 
else 
{ 
   echo "Sorry, there was a problem uploading your file."; 
} 

?> 
