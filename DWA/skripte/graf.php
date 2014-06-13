<?php
    $graf=$_POST['graf'];

    if ($graf=='omjer') {
        
        header('Content-type: image/png');
         $handle = imagecreate(100, 100);
         $background = imagecolorallocate($handle, 255, 255, 255);
         $red = imagecolorallocate($handle, 255, 0, 0);
         $green = imagecolorallocate($handle, 0, 255, 0);
         $blue = imagecolorallocate($handle, 0, 0, 255);
         imagefilledarc($handle, 50, 50, 100, 50, 0, 90, $red, IMG_ARC_PIE);
         imagefilledarc($handle, 50, 50, 100, 50, 90, 225 , $blue, IMG_ARC_PIE);
         imagefilledarc($handle, 50, 50, 100, 50, 225, 360 , $green, IMG_ARC_PIE);
         imagepng($handle);

    }elseif ($graf=='stupac') {

        include 'veza.php';

        $maleUpit = mysql_query("SELECT COUNT(idUneseniPacijenti) FROM $tbl_name WHERE spol='M'");
        $male = mysql_fetch_array($maleUpit);
        $femaleUpit = mysql_query("SELECT COUNT(idUneseniPacijenti) FROM $tbl_name WHERE spol='Ž'");
        $female = mysql_fetch_array($femaleUpit);

        // This array of values is just here for the example.

            $values = array("$male[0]","$female[0]");

        // Get the total number of columns we are going to plot

            $columns  = count($values);

        // Get the height and width of the final image

            $width = 300;
            $height = 200;

        // Set the amount of space between each column

            $padding = 5;

        // Get the width of 1 column

            $column_width = $width / $columns ;

        // Generate the image variables

            $im        = imagecreate($width,$height);
            $gray      = imagecolorallocate ($im,0xcc,0xcc,0xcc);
            $gray_lite = imagecolorallocate ($im,0xee,0xee,0xee);
            $gray_dark = imagecolorallocate ($im,0x7f,0x7f,0x7f);
            $white     = imagecolorallocate ($im,0xff,0xff,0xff);
            
        // Fill in the background of the image

            imagefilledrectangle($im,0,0,$width,$height,$white);
            
            $maxv = 0;

        // Calculate the maximum value we are going to plot

            for($i=0;$i<$columns;$i++)$maxv = max($values[$i],$maxv);

        // Now plot each column
                
                $column_height = ($height / 100) * (( $values[0] / $maxv) *100);

                $x1 = 0*$column_width;
                $y1 = $height-$column_height;
                $x2 = ((1)*$column_width)-$padding;
                $y2 = $height;

                imagefilledrectangle($im,$x1,$y1,$x2,$y2,$gray);
                imagestring($im, 5, $x2-15, $y2-15, $male[0], $white);

        // This part is just for 3D effect

                imageline($im,$x1,$y1,$x1,$y2,$gray_lite);
                imageline($im,$x1,$y2,$x2,$y2,$gray_lite);
                imageline($im,$x2,$y1,$x2,$y2,$gray_dark);



                $column_height = ($height / 100) * (( $values[1] / $maxv) *100);

                $x1 = 1*$column_width;
                $y1 = $height-$column_height;
                $x2 = ((2)*$column_width)-$padding;
                $y2 = $height;

                imagefilledrectangle($im,$x1,$y1,$x2,$y2,$gray);
                imagestring($im, 5, $x2-15, $y2-15, $female[0], $white);

        // This part is just for 3D effect

                imageline($im,$x1,$y1,$x1,$y2,$gray_lite);
                imageline($im,$x1,$y2,$x2,$y2,$gray_lite);
                imageline($im,$x2,$y1,$x2,$y2,$gray_dark);

        // Send the PNG header information. Replace for JPEG or GIF or whatever

            header ("Content-type: image/png");
            imagepng($im);
    }

?>
