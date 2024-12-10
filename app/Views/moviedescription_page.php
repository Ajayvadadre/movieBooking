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
            width: 250px;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }

        .movie-description {
            margin-top: 30px;
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

        .movie-description-p {
            font-size: 14px;
            padding: 0;
            margin: 0;

        }

        #movieName {
            color: white;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="container ">
        <?php if ($data) { ?>
            <div class="row movie-details  d-flex justify-content-center gap-5 ">
                <div class="col-md-3">
                    <img src="<?= $data['image'] ?>" alt="Movie Poster" class="movie-poster">
                </div>
                <div class="col-md-6 d-flex flex-column ">
                    <h2 id="movieName"><?= $data['name'] ?></h2>
                    <div class="description-top pl-1 d-flex flex-column gap-1 mt-1">
                        <p class="movie-description-p"><?= $data['genre'] ?></p>
                        <p class="movie-description-p"><?= $data['director'] ?></p>
                    </div>
                    <p id="desc" class="movie-description  pl-1"><?= $data['description'] ?></p>
                    <div class="description-button pl-1 ">
                        <a href="/bookSeats/<?= $data['_id'] ?>" class="btn btn-primary book-tickets-btn">Book Tickets</a>
                        <button type="button" class="btn btn-danger book-tickets-btn ml-2" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Edit movie</button>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <h2> No such movie Found</h2> <?php } ?>




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
                        <form action="/updateData/<?= $data['_id'] ?>" method="post" enctype="multipart/form-data">
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
                                <button type="submit" class="btn btn-primary">Update data</button>
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