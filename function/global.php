<?php
/**
 * Created by PhpStorm.
 * User: Ali
 * Date: 20/11/2017
 * Time: 04:01 PM
 */
include "jdf/jdf.php";

function m_date($time, $format = false)
{
    if ($format) {
        $frm = $format;
    } else {
        $frm = 'Y/m/d';
    }
    return jdate($frm, strtotime($time));
}

function m_summary($text, $length = 200)
{
    if (strlen($text) > $length) {
        return substr($text, 0, $length) . '...';
    }
}


function upload($filename){


    $target_dir = "uploads/";


    $temp = explode(".", $_FILES["$filename"]["name"]);

    print_r($temp);exit;
    $uploadName=$temp[0].rand(999,99999).'.'.end($temp);

    $target_file = $target_dir .$uploadName;

    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$filename]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES[$filename]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$filename]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES[$filename]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }





}
