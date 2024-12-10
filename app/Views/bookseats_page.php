<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Selection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #1b1b1b;
            color: white;
        }

        .main-div {
            height: 100vh;
            width: 50%;
            border-right: 1px solid #555555;
            border-left: 1px solid #555555;
            align-items: center;
            justify-content: center;
            gap: 50px;
        }

        .seat-container {
            width: 50%;
        }

        .seat-checkbox:disabled+label {
            background-color: rgb(68, 68, 68);
            border: none;
            cursor: not-allowed;
        }

        .seat-checkbox:checked+label {
            background-color: #00ff00;
        }

        .seat-label {
            padding: 5px 10px;
            margin: 2px;
            /* background-color: #00ff00; */
            border: 1px solid rgb(30, 168, 60);
            cursor: pointer;
            display: inline-block;
            border-radius: 3px;
        }

        .available-div {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            /* background-color: rgb(68, 68, 68); */
            border: 1px solid rgb(30, 168, 60);
            /* border: 1px solid black; */
            height: 20px;
            width: 20px;
        }

        .selected-div {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            background-color: rgb(0, 255, 0);
            height: 20px;
            width: 20px;
        }

        .sold-div {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            background-color: rgb(68, 68, 68);
            height: 20px;
            width: 20px;
        }

        .display-info {
            gap: 100px;
            justify-content: center;
            margin-top: 25%;
            padding-top: 7%;
            border-top: 1px solid rgb(68, 68, 68);
            ;
        }
    </style>
</head>

<body>
    <div class="main-div container  d-flex justify-content-center  ">
        <form id="seatForm" class="container ">
            <div class="second-container mt-lg-5 d-flex justify-content-center align-items-center -center flex-column">
                <h3 class="mb-4">Select seats</h3>
                <div id="seatsContainer " class="d-flex justify-content-center  flex-column ">
                    <?php
                    $chairsArray = [
                        "A" => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                        "B" => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                        "C" => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                        "D" => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                    ];

                    foreach ($chairsArray as $key => $values) {
                        echo "<div class='row-container'>";
                        foreach ($values as $v) {
                            $seatId = $key . $v;
                            $isBooked = isset($bookedSeats) && in_array($seatId, $bookedSeats);
                            $price = 200;
                    ?>
                            <input type="checkbox"
                                id="<?= $seatId ?>"
                                name="seats[]"
                                value="<?= $seatId ?>"
                                data-price="<?= $price ?>"
                                class="seat-checkbox"
                                style="display: none;"
                                <?= $isBooked ? 'disabled' : '' ?>>
                            <label for="<?= $seatId ?>" class="seat-label">
                                <?= $seatId ?>
                            </label>
                    <?php
                        }
                        echo "<br>";
                        echo "</div>";
                    }
                    ?>
                </div>
                <button type="submit" id="continue-button" class="btn btn-primary mt-5">Select seats</button>
                <!-- <button type="submit" id="delete-button" class="btn btn-primary mt-3">Delete seats</button> -->
            </div>

            <div class="display-info d-flex text-capitalize ">
                <div class="available-div info">
                    <span class="available"></span>
                    <p>available</p>
                </div>
                <div class="selected-div info">
                    <span class="selected"></span>
                    <p>selected</p>
                </div>
                <div class="sold-div info">
                    <span class="sold"></span>
                    <p>sold</p>
                </div>
            </div>
        </form>
    </div>
    <script>
        // Seats selection
        document.getElementById('seatForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const selectedSeats = Array.from(document.querySelectorAll('input[name="seats[]"]:checked'))
                .map(checkbox => checkbox.value);
            console.log(selectedSeats);
            // const deleteButton = document.getElementById('delete-button')
            const id = window.location.pathname.split('/').pop();
            console.log(id);

            try {
                const response = await fetch('http://localhost:5000/home/setSeatData', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: id,
                        seats: selectedSeats
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // alert('Seats booked successfully!');
                    // Disable the booked seats
                    selectedSeats.forEach(seatId => {
                        const checkbox = document.getElementById(seatId);
                        checkbox.disabled = true;
                        checkbox.checked = false;
                    });
                } else {
                    console.log('Failed to book seats: ' + data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while booking seats');
            }
            // Delete Seats------------
            // deleteSeatData
            // if (deleteButton) {
            //     deleteButton.addEventListener('click', () => {
            //         const selectedSeats = Array.from(seatCheckboxes).filter(checkbox => checkbox.checked);
            //         const seatIds = selectedSeats.map(seat => seat.value);
            //         fetch(`http://localhost:5000/home/deleteSeatData`, {
            //             method: 'POST',
            //             headers: {
            //                 'Content-Type': 'application/json'
            //             },
            //             body: JSON.stringify({
            //                 id: id,
            //                 seats: seatIds
            //             }),
            //         });
            //     });
            // }
        });

        // Function to fetch and update seat status
        async function updateSeatStatus() {
            try {
                const id = window.location.pathname.split('/').pop();
                const response = await fetch(`http://localhost:5000/home/getSeatData/${id}`);
                const data = await response.json();

                if (data.bookedSeats) {
                    data.bookedSeats.forEach(seatId => {
                        const checkbox = document.getElementById(seatId);
                        if (checkbox) {
                            checkbox.disabled = true;
                            checkbox.checked = false;
                        }
                    });

                }
            } catch (error) {
                console.error('Error fetching seat status:', error);
            }
        }

        // update price 
        const continueButton = document.getElementById('continue-button');
        const seatCheckboxes = document.querySelectorAll('input[name="seats[]"]');
        const id = window.location.pathname.split('/').pop();
        let totalPrice;
        if (continueButton) {
            seatCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateTotalPrice);
            });

            function updateTotalPrice() {
                const selectedSeats = Array.from(seatCheckboxes).filter(checkbox => checkbox.checked);
                totalPrice = selectedSeats.reduce((acc, seat) => acc + parseInt(seat.dataset.price), 0);
                continueButton.textContent = `Pay ₹${totalPrice}`;
            }
            continueButton.addEventListener('click', () => {
                console.log(totalPrice);
                fetch(`http://localhost:5000/home/setPrice`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: id,
                        price: totalPrice
                    }),
                });
                window.location.href = `/displayTicket/${id}`;
            })
        } else {
            console.log("continue button not detected")
        }

        // Update seat status when page loads
        updateSeatStatus();
        // Update seat status every 30 seconds
        setInterval(updateSeatStatus, 3000);
    </script>
</body>

</html>