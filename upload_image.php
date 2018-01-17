<?php

// Include the editor SDK.
require '/lib/froala_editor.php';

// Store the image.
try {
    $response = FroalaEditor_Image::upload('/uploads/');
    echo stripslashes(json_encode($response));
} catch (Exception $e) {
    http_response_code(404);
}

?>