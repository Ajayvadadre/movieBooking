<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #1b1b1b;
            color: white;
        }

        .main-div {
            height: 100vh;
            width: 50%;
            align-items: center;
            justify-content: center;
        }

        .seat-container {
            width: 50%;
            font-size: 14px;
        }

        .ticket-div {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 50px;
        }

        .ticket-div .second-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: max-content;
            border: 2px solid grey;
            background-color: #f2f2f2;
            padding: 80px;
        }

        .ticket-div .second-container h5 {
            width: max-content;
            display: flex;
            font-size: 14px;
            justify-self: center;
            color: black;

        }

        .ticket-div .second-container .circles1 {
            display: inline-block;
            position: absolute;
            top: 50%;
            z-index: 1;
            width: 22px;
            height: 22px;
            background: #f2f2f2;
            border-radius: 50%;
            /* left: 10px; */
            margin-left: 11.5%;
            box-shadow: inset -1px 0 0 #dfe3e7;
        }

        .ticket-div .second-container .circles2 {
            display: inline-block;
            position: absolute;
            top: 50%;
            z-index: 1;
            width: 22px;
            height: 22px;
            background: #f2f2f2;
            border-radius: 50%;
            left: 40%;
            /* margin-right: 11%; */
            box-shadow: inset -1px 0 0 #dfe3e7;
        }
    </style>
</head>

<body>
    <div class="main-div container border d-flex justify-content-center align-content-center">
        <div class="btn-group-toggle container ticket-div " data-toggle="buttons">
            <div class="second-container   d-inline text-light">
                <h5 class=" ">
                    <?php if ($data) {
                        echo ($data['name']);
                    } ?>
                </h5>
                <h5 class=" ">
                    <?php if ($data) {
                        print_r($data);
                    } ?>
                </h5>



                <h5>
                    <?php if ($data) {
                        echo ($data['genre']);
                    } ?>
                </h5>
                <h5>
                    <?php if ($data) {
                        echo ($data['director']);
                    } ?>
                </h5>
                <h5>
                    <?php if ($data) {
                        print_r($data['seats'][0]);
                    } ?>
                </h5>
                <span class="circles1"></span>
                <span class="circles2"></span>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script>

</script>

</html>