<?php

if (isset($_POST['submit'])) {

    if (count($_FILES['upload']['name']) > 0){
        

        for ($i = 0; $i < count($_FILES['upload']['name']); $i++) {
            //Get the temp file path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
            $types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];

            if ($_FILES['upload']['size'][$i] > 1048576) {
                $errors['size'] = 'Le fichier trop volumineux';
            }
            elseif (!in_array($_FILES['upload']['type'][$i], $types)) {
                $errors['type'] = 'Ce n est pas le bon format de fichier';
            }
            else {
                $fileName = 'image' . uniqid() . '.' . pathinfo($_FILES['upload']['name'][$i], PATHINFO_EXTENSION);
                $moveResult [] = move_uploaded_file($_FILES['upload']['tmp_name'][$i], 'upload/' . $fileName);
            }
        }
    }
    $images = array_diff(scandir('upload'), array('.', '..'));
}
header('Location: index.php');


