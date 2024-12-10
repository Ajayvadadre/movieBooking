<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f2f2f2;
        }

        .ticket-container {
            max-width: 300px;
            margin: 40px auto;
            /* padding: 20px; */
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .ticket-header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            border-bottom: 1px solid #ddd;
        }

        .ticket-details {
            padding: 20px;
        }

        .ticket-details h5 {
            font-weight: bold;
        }

        .ticket-details ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .ticket-details li {
            margin-bottom: 10px;
            font-size: 14px;
            color: #464545;

        }

        .ticket-details li span {
            font-weight: 600;
            color: #464646;
        }

        .ticket-footer {
            background-color: rgb(255, 252, 220);
            color: #2c2b2b;
            border-top: 1px dashed #7a7a7a;
            padding: 10px 20px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .movie-image {
            height: 300px;
            border: 100%;
            width: 100%;
        }

        .movie-image img {
            object-fit: cover;
            /* object-position:end; */
            height: 100%;
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="ticket-container">
        <div class="ticket-header border-0  ">
            <h4 class="pt-1">Ticket Details</h4>
        </div>
        <div class="ticket-body d-flex justify-content-between flex-column">
            <div class="movie-image">
                <img src="<?php echo $data['image']; ?>" alt="">
            </div>
            <div class="ticket-details ">

                <h5>Movie Details- </h5>
                <div class="line mt-1 mb-2 " style="border:1px dashed #9e9d9d;height:1px"></div>

                <div class="movie-details mt-3 ">
                    <ul>
                        <li><span>Movie Name:</span> <?php echo $data['name']; ?></li>
                        <li><span>Director:</span> <?php echo $data['director']; ?></li>
                        <li><span>Genre:</span> <?php echo $data['genre']; ?></li>
                    </ul>
                </div>
                <div class="seat-details ">

                    <!-- <h5>Seat Details</h5> -->
                    <ul>
                        <li><span>Seat Numbers:</span> <?php echo implode(', ', $data['bookedSeatsByID']); ?></li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="ticket-footer d-flex justify-content-between ">
            <p class="" style="font-weight:400">Amount Payable
            </p>
            <p> Rs.<?php echo $data['price']; ?></p>
        </div>
    </div>

    <div class="pay d-flex justify-content-center   align-items-center">
        <button class="btn btn-danger" style="width:25%; " data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Pay ₹<?php echo $data['price']; ?></button>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</html>