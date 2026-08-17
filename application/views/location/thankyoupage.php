<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thank You!</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-+d5e0q2F/iL6Ki2vhFfW2K5BIvZYbTjm4p1VtENODgrPdF/Q+76Ocu06Kr8a9VkR" crossorigin="anonymous">
<style>
        /* Add your custom CSS styles here */
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .thank-you-message {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .fa-thumbs-up {
            color: green;
            font-size: 50px;
            margin-right: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .thankyou{
            margin-top: 50px;
            width: 1100px;
            height: 450px;
            padding: 20px 50px 80px 50px;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 0 1px 0px grey;
            text-align: center;
        }
        .p{
            text-align: center;
        }
        .info{
            margin: 0;
            justify-content: center;
            align-items: center;
            margin-top: 150px;

        }

        @media only screen and (max-width: 767px) {
            .thankyou{
                width: 250px;
/*                height: 315px;*/
                box-shadow: none;
                margin-top: 0px;
                padding: 0;
            }
            .info{
                margin-top: 95px;
            }
            body {
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        }
    </style>
</head>

<body>
  <div class="container">
    <div class="thankyou">
        <div class="col-md-12 text-center info">
            <i class="fas fa-thumbs-up"></i>
            <h2 class="thank-you-message">Thank you for Sending Your Location!</h2>
            <p class="p">We appreciate your submission.</p>
        </div>
    </div>
</div>

</body>

</html>