<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #1b1b1b;
        }

        .movie-details {
            color: #e9e9e9;
            margin-top: 90px;
        }

        .movie-poster {
            width: 200px;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }

        .movie-description {
            margin-top: 20px;
        }

        .suggested-movies {
            margin-top: 40px;
        }

        .suggested-movies .card {
            margin-bottom: 20px;
        }

        .suggested-movies .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .book-tickets-btn {
            margin-top: 20px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row movie-details">
            <div class="col-md-4">
                <img src="https://picsum.photos/200/300" alt="Movie Poster" class="movie-poster">
            </div>
            <?php foreach($movieId as $data) { ?> <h2><?= $data['name'] ?></h2><?php } ?>
            <div class="col-md-8">
                <h2>Movie name </h2>
                <p class="movie-description"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, asperiores?</p>
                <button class="btn btn-primary book-tickets-btn">Book Tickets</button>
            </div>
        </div>

        <div class="suggested-movies">
            <h2>Suggested Movies</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://picsum.photos/200/301" alt="Movie Poster">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://picsum.photos/200/302" alt="Movie Poster">
                        <div class="card-body">
                            <h5 class="card-title">Movie Title</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://picsum.photos/200/303" alt="Movie Poster">
                        <div class="card-body">
                            <h5 class="card-title">Movie Title</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://picsum.photos/200/304" alt="Movie Poster">
                        <div class="card-body">
                            <h5 class="card-title">Movie Title</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>