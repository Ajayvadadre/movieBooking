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
        }

        /* .jumbotron {
            background-image: url('https://res.cloudinary.com/df0ifelxk/image/upload/v1733394153/peakpx_hqdzx6.jpg');
            background-size: cover;
            background-position: center;
            height: 25vh;
            color: #fff;
            text-align: center;
        } */

        .jumbotron h1 {
            font-size: 48px;
            font-weight: bold;
            /* margin-top: 10rem; */

        }

        /* .modal-content {
            background-color: #1b1b1b;
            color: white;
        } */

        .movie-card {
            /* height: 00px; */
            /* #1b1b1b  */
            width: fit-content;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.49);
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
            margin-top: 7rem;
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

        /* .Datainput{
            background-color: #868d9d;
            border-radius: 5px;
            color: #1b1b1b;
        } */
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

        <div class="carousel-inner main-head">
            <div class="header-top">
                <h4 class=" logo">book<span class="text-danger">that</span>show</h4>
                <div class="dropdown logout ml-3 ">
                    <button class=" border-0 text-light " style="height: 80px; background-color:transparent" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0,0,256,256">
                            <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                <g transform="scale(8.53333,8.53333)">
                                    <path d="M3,7c-0.36064,-0.0051 -0.69608,0.18438 -0.87789,0.49587c-0.18181,0.3115 -0.18181,0.69676 0,1.00825c0.18181,0.3115 0.51725,0.50097 0.87789,0.49587h24c0.36064,0.0051 0.69608,-0.18438 0.87789,-0.49587c0.18181,-0.3115 0.18181,-0.69676 0,-1.00825c-0.18181,-0.3115 -0.51725,-0.50097 -0.87789,-0.49587zM3,14c-0.36064,-0.0051 -0.69608,0.18438 -0.87789,0.49587c-0.18181,0.3115 -0.18181,0.69676 0,1.00825c0.18181,0.3115 0.51725,0.50097 0.87789,0.49587h24c0.36064,0.0051 0.69608,-0.18438 0.87789,-0.49587c0.18181,-0.3115 0.18181,-0.69676 0,-1.00825c-0.18181,-0.3115 -0.51725,-0.50097 -0.87789,-0.49587zM3,21c-0.36064,-0.0051 -0.69608,0.18438 -0.87789,0.49587c-0.18181,0.3115 -0.18181,0.69676 0,1.00825c0.18181,0.3115 0.51725,0.50097 0.87789,0.49587h24c0.36064,0.0051 0.69608,-0.18438 0.87789,-0.49587c0.18181,-0.3115 0.18181,-0.69676 0,-1.00825c-0.18181,-0.3115 -0.51725,-0.50097 -0.87789,-0.49587z"></path>
                                </g>
                            </g>
                        </svg>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="carousel-item active">
                <img src="https://res.cloudinary.com/df0ifelxk/image/upload/v1733394153/peakpx_hqdzx6.jpg" class="d-block w-100 " alt="...">
            </div>
            <div class="carousel-item ">
                <img src="https://res.cloudinary.com/df0ifelxk/image/upload/v1733394484/peakpx2_yg6hko.jpg" class="d-block w-100 " alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://res.cloudinary.com/df0ifelxk/image/upload/v1733394483/peakpx3_fe2oio.jpg" class="d-block w-100 " alt="...">
            </div>
            <div class="text col-md-4">
                <h1>Movie Hub</h1>
                <p>Watch the latest movies in theaters nearby</p>
                <a href="/" class="btn btn-primary ">Book movie</a>
                <?php if ($rData->isAdmin) { ?>
                    <button class="btn btn-primary ml-1" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Add movie</button>
                <?php } else { ?> <h2 class=""></h2> <?php } ?>
                <?php if ($rData->isAdmin) { ?>
                    <button class="btn btn-danger ml-1" data-bs-target="#exampleModalToggle" data-bs-toggle="modal2">View all movies</button>
                <?php } else { ?> <h2 class=""></h2> <?php } ?>
            </div>
        </div>
    </div>
    <div class="container trending-list " style="padding-left:50px;">
        <div class="heading">
            <h2>Trending now</h2>
        </div>
        <div class="row ">
            <?php foreach ($mongoData as $data) { ?>
                <div class="col-md-4 mt-4 ">
                    <form action="/movieDescription/deleteData/<?= $data['_id'] ?>" method="post">
                        <div class="movie-card ">
                            <img src="<?= $data['image'] ?>" alt="Movie Poster">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?= $data['name'] ?></h5>
                                <p class="card-text text-capitalize mb-1 "><?= $data['director'] ?></p>
                                <p class="card-text text-capitalize mb-4 "><?= $data['genre'] ?></p>
                                <a class="btn  bookNowBtn" href="/movieDescription/getData/<?= $data['_id'] ?>" type="submit">Book Now</a>

                                <?php if ($rData->isAdmin) { ?>
                                    <button class="btn  deleteBtn" type="submit">Delete</button>
                                <?php } else { ?> <h2 class=""></h2> <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>

            <?php } ?>
        </div>


    </div>

    <!-- add movie modal  -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Movie details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/addData" method="post" enctype="multipart/form-data">
                    <div class="modal-body d-flex flex-column gap-4">

                        <div class="div-name text-capitalize font-weight-bold d-flex flex-column">
                            <label for="image">Image:</label>
                            <input name="image" type="file">
                        </div>
                        <div class="div-name text-capitalize font-weight-bold d-flex flex-column">
                            <label for="name">movie name:</label>
                            <input class=" Datainput " name="name" type="text">
                        </div>
                        <div class="div-genre text-capitalize font-weight-bold d-flex flex-column">
                            <label for="genre">genre:</label>
                            <input class="Datainput" name="genre" type="text">
                        </div>
                        <div class="div-description text-capitalize font-weight-bold d-flex flex-column">
                            <label for="description">description:</label>
                            <textarea class="Datainput" name="description" id="description"></textarea>
                        </div>
                        <div class="div-director text-capitalize font-weight-bold d-flex flex-column">
                            <label for="director">director:</label>
                            <input class="Datainput" name="director" type="text">
                        </div>
                        <div class="div-date_created text-capitalize font-weight-bold d-flex flex-column">
                            <label for="date_created">date created:</label>
                            <input class="Datainput " name="date_created" type="date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
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