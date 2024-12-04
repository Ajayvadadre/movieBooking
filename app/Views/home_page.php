<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bookthatshow</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #1b1b1b;
        }

        .jumbotron {
            background-image: url('https://w0.peakpx.com/wallpaper/127/1000/HD-wallpaper-avengers-poster-hero-endgame-marvel-film-poster-art.jpg');
            background-size: cover;
            background-position: center;
            height: 80vh;
            color: #fff;
            text-align: center;
        }

        .jumbotron h1 {
            font-size: 48px;
            font-weight: bold;
            /* margin-top: 10rem; */
            
        }

        .movie-card {
            /* height: 300px; */
            width: fit-content;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.49);
        }

        .movie-card img {
            width: 300px;
            height: 300px;
            object-fit:cover;
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

        .jumbotron .text{
            height:fit-content;
            margin-top: 25rem;
            margin-left:7.5rem;
            text-align: start;
            align-items: end;
        }
        .container1{
            padding:0px
        }
    </style>
</head>

<body>
    <div class="jumbotron d-flex align-content-end">
        <div class="text col-md-4">
            <h1>Movie Hub</h1>
            <p>Explore the latest movies and TV shows</p>
            <a href="#" class="btn btn-primary">Book tickets</a>
        </div>
    </div>
    <div class="container">
        <div class="heading">
            <h2>Trending now</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="movie-card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSm1-tPfKWNdNIOjdPqfxOgqHvRThcLZtcX3w&s" alt="Movie Poster">
                    <div class="card-body ">
                        <h5 class="card-title">Furiosa</h5>
                        <p class="card-text">Movie Description</p>
                        <a href="/movieDescription" onclick="sendData" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="movie-card">
                    <img id="movieImg" src="https://i.pinimg.com/736x/87/d9/da/87d9da9ea9fe3d630bf686c70e45feb0.jpg" alt="Movie Poster">
                    <div class="card-body">
                        <h5 id="movieTitle" class="card-title">Fall Guy</h5>
                        <p id="movieDescription" class="card-text">Movie Description</p>
                        <form action="/movieDescriptionview" method="get">
                            <button onclick="sendData()" type="submit" class="btn btn-primary"> Book now </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="movie-card">
                    <img src="https://i2.wp.com/www.shutterstock.com/blog/wp-content/uploads/sites/5/2024/03/Civil-War.jpg?ssl=1" alt="Movie Poster">
                    <div class="card-body">
                        <h5 class="card-title">Civil War</h5>
                        <p class="card-text">Movie Description</p>
                        <a href="/movieDescription" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="movie-card">
                    <img src="https://assets-in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:l-image,i-discovery-catalog@@icons@@like_202006280402.png,lx-24,ly-617,w-29,l-end:l-text,ie-MS45TSBMaWtlcw%3D%3D,fs-29,co-FFFFFF,ly-612,lx-70,pa-8_0_0_0,l-end/et00356724-cyrbaqmhav-portrait.jpg" alt="Movie Poster">
                    <div class="card-body">
                        <h5 class="card-title">Civil War</h5>
                        <p class="card-text">Movie Description</p>
                        <a href="/movieDescription" class="btn btn-primary">Book Now </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="movie-card">
                    <img src="https://assets-in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:l-image,i-discovery-catalog@@icons@@star-icon-202203010609.png,lx-24,ly-615,w-29,l-end:l-text,ie-Ni4yLzEwICAyMDUuNUsgVm90ZXM%3D,fs-29,co-FFFFFF,ly-612,lx-70,pa-8_0_0_0,l-end/et00353996-cpbypudxwl-portrait.jpg" alt="Movie Poster">
                    <div class="card-body">
                        <h5 class="card-title">Civil War</h5>
                        <p class="card-text">Movie Description</p>
                        <a href="/movieDescription" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="movie-card">
                    <img src="https://assets-in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:l-image,i-discovery-catalog@@icons@@star-icon-202203010609.png,lx-24,ly-615,w-29,l-end:l-text,ie-OC40LzEwICA1LjlLIFZvdGVz,fs-29,co-FFFFFF,ly-612,lx-70,pa-8_0_0_0,l-end/et00387901-zzezpljyvq-portrait.jpg" alt="Movie Poster">
                    <div class="card-body">
                        <h5 class="card-title">Civil War</h5>
                        <p class="card-text">Movie Description</p>
                        <a href="/movieDescription" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        // Get the value of the h5 tag
        //    h5Value =  document.getElementById('movieTitle').textContent;

        function sendData() {

            var title = document.getElementById('movieTitle').textContent;
            var img = document.getElementById('movieImg')
            var imgUrl = img.getAttribute('src');
            var description = document.getElementById('movieDescription').textContent;
            // console.log(h5Value)                
            // var url = '/movieDescription?title=' + encodeURIComponent(h5Value);
            // window.location.href = url;
            //     var h5Value = $('movieTitle').text();
            $.ajax({
                url: '/movieDescription',
                method: 'POST',
                data: {
                    title: title,
                    imgUrl: imgUrl,
                    description: description
                },
                success: function(data) {
                    console.log(data)
                    // console.log(typeof data)
                    // window.location.href = '/movieDescription';
                }
            });
        }
    </script>
</body>

</html>