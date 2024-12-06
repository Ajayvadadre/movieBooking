<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <div class="container ">
        <?php if ($data) { ?>
            <div class="row movie-details">
                <div class="col-md-4">
                    <img src="<?= $data['image'] ?>" alt="Movie Poster" class="movie-poster">
                </div>
                <div class="col-md-8">
                    <h2><?= $data['name'] ?></h2>
                    <p class="movie-description"><?= $data['genre'] ?></p>
                    <p class="movie-description"><?= $data['director'] ?></p>
                    <a href="/bookTickets/<?= $data['_id'] ?>" class="btn btn-primary book-tickets-btn">Book Tickets</a>
                    <button type="button" class="btn btn-danger book-tickets-btn ml-2" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Edit movie</button>
                </div>
            </div>
        <?php } else { ?>
            <h2> No such movie Found</h2> <?php } ?>

        <!-- <div class="suggested-movies">
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
        </div> -->

        
        
        <!-- Button trigger modal -->
        
        <!-- Edit Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Movie</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/updateData/<?= $data['_id']?>" method="post"  enctype="multipart/form-data" >
                            <div class="mb-3 div-name text-capitalize d-flex flex-column">
                                <label class="col-form-label" for="image">Image:</label>
                                <input name="image" type="file">
                            </div>
                            <div class="mb-3 div-name text-capitalize d-flex flex-column">
                                <label for="name">movie name:</label>
                                <input name="name" type="text">
                            </div>
                            <div class="mb-3 div-genre text-capitalize d-flex flex-column">
                                <label for="genre">genre:</label>
                                <input name="genre" type="text">
                            </div>
                            <div class="mb-3 div-director text-capitalize d-flex flex-column">
                                <label for="director">director:</label>
                                <input name="director" type="text">
                            </div>
                            <div class="mb-3 div-date_created text-capitalize d-flex flex-column">
                                <label for="date_created">date created:</label>
                                <input name="date_created" type="date">
                            </div>
                            <!-- <div class="mb-3">
                                <label for="message-text" class="col-form-label">Description:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div> -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit"  class="btn btn-primary">Update data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>