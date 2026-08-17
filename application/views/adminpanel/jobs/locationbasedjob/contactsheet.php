<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Grid</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .img-div {
            width: 500px;
            height: 710px;
            overflow: hidden;
            margin-top: 30px;
        }

        .img-div img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensure images maintain aspect ratio and cover the entire container */
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="container " style="width: 1000px;">
        <div class="row" style="width: 1000px;">
            <div class="col-md-6 img-div">
                <img src="pexels-photo-2990603.webp" class="img-fluid" alt="Image 1">
            </div>
            <div class="col-md-6 img-div">
                <img src="free-photo-of-ampel-demo-mit-traktoren-in-muchen.jpeg" class="img-fluid" alt="Image 2">
            </div>
            <div class="col-md-6 img-div">
                <img src="pexels-photo-2990603.webp" class="img-fluid" alt="Image 1">
            </div>
            <div class="col-md-6 img-div">
                <img src="free-photo-of-ampel-demo-mit-traktoren-in-muchen.jpeg" class="img-fluid" alt="Image 2">
            </div>

            <div class="page-break"></div>

            <div class="col-md-6 img-div">
                <img src="pexels-photo-2990603.webp" class="img-fluid" alt="Image 1">
            </div>
            <div class="col-md-6 img-div">
                <img src="free-photo-of-ampel-demo-mit-traktoren-in-muchen.jpeg" class="img-fluid" alt="Image 2">
            </div>
            <div class="col-md-6 img-div">
                <img src="pexels-photo-2990603.webp" class="img-fluid" alt="Image 1">
            </div>
            <div class="col-md-6 img-div">
                <img src="free-photo-of-ampel-demo-mit-traktoren-in-muchen.jpeg" class="img-fluid" alt="Image 2">
            </div>
        </div>
    </div>
</body>

</html>