    <?php
    header("Content-Type: image/png");

    // Create image
    $width = 400;
    $height = 400;
    $im = imagecreate($width, $height);
    $white = imagecolorallocate($im,255,255,255);

    imagefill($im,0,0, $white);
    
    // Output image
    imagepng($im);
    imagedestroy($im);

    ?>