<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF with Header and Footer</title>
    <style>
        @page {
            margin: 100px 25px;
        }
        
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
            line-height: 35px;
        }
        
        footer {
            position: fixed;
            bottom: -30px;
            left: 0px;
            right: 0px;
            height: 30px;
            text-align: center;
            line-height: 35px;
        }

        .container {
            width: 100%;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .page-number:before {
            content: counter(page);
        }
    </style>
</head>

<body>
    <header>
        <table>
            <tr>
                <th style="width: 33.33%;">Case Reference: <?php echo $reference; ?></th>
                <th style="width: 33.33%;">Insured Name: <?php echo $insured_name; ?></th>
                <th style="width: 33.33%;">Date of Death: <?php echo $datofdeath; ?></th>
            </tr>
        </table>
    </header>

    <footer>
        Page <span class="page-number"></span>
    </footer>

    <div class="container">
        <table style="width:100%; height:100%;">
            <?php 
            $index = 0;
            print_r($images);
            foreach ($images as $img) { 

                // Load image
                $imgPath = 'uploads/' . $aid . '/images/' . $img;
                $image = imagecreatefromstring(file_get_contents($imgPath));
                
                // Check if image loaded successfully
                if ($image) {
                    $width = imagesx($image);
                    $height = imagesy($image);

                    // Rotate image if in landscape mode
                    if ($width > $height) {
                        $image = imagerotate($image, 90, 0);
                    }

                    // Capture the image data
                    ob_start();
                    imagejpeg($image);
                    $imgData = ob_get_clean();
                    imagedestroy($image);

                    // Encode the image data for HTML display
                    $base64 = base64_encode($imgData);
                } else {
                    // Fallback if image failed to load
                    $base64 = base64_encode(file_get_contents($imgPath));
                }

                if ($index % 2 == 0) { // Open a new row every 2 images
                    echo '<tr>';
                }
                ?>
                <td style="padding:5px;width:50%;" >
                    <img src="data:image/jpeg;base64,<?php echo $base64; ?>" style="width:100%; height:45%;" alt="Image <?php echo $index + 1; ?>">
                </td>
                <?php 
                if ($index % 2 == 1) { // Close the row after every 2 images
                    echo '</tr>';
                }
                $index++;
            } 
            if ($index % 2 != 0) { // Close the last row if the number of images is odd
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</body>

</html>
