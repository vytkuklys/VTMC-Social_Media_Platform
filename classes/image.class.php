<?php

class Image{

    public function uploadImg($file){
    
        $fileName = $file['file']['name'];
        $fileTmpName = $file['file']['tmp_name'];
        $fileSize = $file['file']['size'];
        $fileError = $file['file']['error'];
        
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $fileActualName = $fileExt[0];
        $allowed = array('jpg', 'jpeg', 'png', 'gif');
        
        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 10000000){
                    $fileNameNew = uniqid('', true).$fileActualName.".".$fileActualExt;
                    $fileDestination = '../uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    // header("Location: upload.php?uploadsuccess");
                    return $fileNameNew;
                }else{
                    echo "Your file is too big!";
                }
            }else{
                echo "There was an error uploading your file!";
            }
        }else{
            echo "You cannot upload files of this type!";
        }
    }
}
