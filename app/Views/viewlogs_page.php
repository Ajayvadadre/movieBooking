<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bookthatshow</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #1b1b1b;
            color: #faf7f7;
        }



        .jumbotron h1 {
            font-size: 48px;
            font-weight: bold;
            /* margin-top: 10rem; */

        }


        .movie-card {

            width: 100%;
            margin-bottom: 20px;
            /* border-radius: 10px; */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.49);
            border-top: 1px solid rgb(104, 103, 103);

        }

        .movie-card img {
            width: 300px;
            /* height: 300px; */

            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .movie-card .card-body {
            padding: 20px;
            border-bottom: 1px solid rgb(104, 103, 103);

        }

        .movie-card .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #dad8d8;

        }

        .movie-card .card-text {
            font-size: 14px;
            color: #666;
        }

        .heading {
            margin-bottom: 50px;
            margin-top: 3rem;
        }

        .heading h2 {
            color: white;
            margin-bottom: 20px;
        }

        .main-head .text {
            height: fit-content;
            margin-top: 30rem;
            margin-left: 5.5rem;
            text-align: start;
            align-items: end;
        }

        .container1 {
            padding: 0px
        }

        .addMovieModal {
            background-color: #1b1b1b;
        }

        .main-head {
            height: 80vh;
            color: white;
        }

        .logo {
            /* position: absolute; */
            z-index: 10;
            margin-left: 6rem;
            margin-top: 2.7rem;
        }

        .bookNowBtn {
            background-color: white;
        }

        .bookNowBtn:hover {
            background-color: #1b1b1b;
            color: white;
            border: 1px solid #666;
        }

        .deleteBtn {
            /* background-color: #666; */
            color: white;
            border: 1px solid #666;
        }

        .deleteBtn:hover {
            border: 1px solid #666;
            background-color: #faf7f7;
            color: #161616;
        }

        .logout {
            width: max-content;
            display: flex;
            justify-content: center;
            align-items: end;

        }

        .header-top {
            position: absolute;
            z-index: 10;
            display: flex;
            width: 100%;
            justify-content: space-between;
            padding-right: 50px;
        }

        .tables-heading {
            padding: 20px 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.49);
            border-bottom: 0;
            
            background-color: #111111;
        }
    </style>

</head>

<body>
    <?php
    $redis = new \Predis\Client([
        'scheme' => 'tcp',
        'host' => '127.0.0.1',
        'port' => 6379,
        'timeout' => 30,
        'read_timeout' => 30,
        'retry_interval' => 100
    ]);
    $redisSession = $redis->get('session:' . session_id());
    $rData = json_decode($redisSession);
    ?>
    <div id="carouselExampleSlidesOnly " class="carousel slide " data-bs-transition="fade" data-bs-ride="carousel" data-bs-duration="2000" data-bs-interval="3000">


    </div>
    <div class="container trending-list " style="padding-left:50px;">
        <div class="heading">
            <h2><span class="mr-4 text-decoration-none"><a class="text-decoration-none text-light" href="/">&#8592;</a></span>Log Data </h2>
        </div>
        <div class="row ">
            <div class="container">
                <div class="tables-heading d-flex justify-content-between">
                    <h5>Username</h5>
                    <h5 style="margin-right: 8rem;">Login time</h>
                        <h5 style="margin-right: 4rem;">Logout time</h5>
                </div>
                <div class="movie-card ">
                    <?php foreach ($mongoData as $data) { ?>
                        <div class="card-body d-flex justify-content-between">
                            <h5 class="card-title text-capitalize"><?= $data['name'] ?></h5>
                            <h5 class="card-title text-capitalize"><?= $data['loginTime'] ?></h5>
                            <h5 class="card-title text-capitalize "><?= $data['logOutTime'] ?></h5>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script>
        </script>
</body>

</html>