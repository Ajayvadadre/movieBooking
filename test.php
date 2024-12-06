// Frontend View (seats_view.php)
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
            align-items: center;
            justify-content: center;
        }
        .seat-container {
            width: 50%;
        }
        .seat-checkbox:disabled + label {
            background-color: #ff0000;
            cursor: not-allowed;
        }
        .seat-checkbox:checked + label {
            background-color: #00ff00;
        }
        .seat-label {
            padding: 5px 10px;
            margin: 2px;
            background-color: #444;
            cursor: pointer;
            display: inline-block;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="main-div container border d-flex justify-content-center align-content-center">
        <form id="seatForm" class="container">
            <div class="second-container">
                <h3>Select seats</h3>
                <div id="seatsContainer">
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
                            ?>
                            <input type="checkbox" 
                                   id="<?= $seatId ?>" 
                                   name="seats[]" 
                                   value="<?= $seatId ?>" 
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
                <button type="submit" class="btn btn-primary mt-3">Continue</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('seatForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const selectedSeats = Array.from(document.querySelectorAll('input[name="seats[]"]:checked'))
                .map(checkbox => checkbox.value);

            try {
                const response = await fetch('/seats/book', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ seats: selectedSeats })
                });

                const data = await response.json();
                
                if (data.success) {
                    alert('Seats booked successfully!');
                    // Disable the booked seats
                    selectedSeats.forEach(seatId => {
                        const checkbox = document.getElementById(seatId);
                        checkbox.disabled = true;
                        checkbox.checked = false;
                    });
                } else {
                    alert('Failed to book seats: ' + data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while booking seats');
            }
        });

        // Function to fetch and update seat status
        async function updateSeatStatus() {
            try {
                const response = await fetch('/seats/status');
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

        // Update seat status when page loads
        updateSeatStatus();
        // Update seat status every 30 seconds
        setInterval(updateSeatStatus, 30000);
    </script>
</body>
</html>

// CodeIgniter Controller (app/Controllers/SeatController.php)
<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\SeatModel;

class SeatController extends ResourceController
{
    protected $seatModel;

    public function __construct()
    {
        $this->seatModel = new SeatModel();
    }

    public function index()
    {
        // Get booked seats from the model
        $bookedSeats = $this->seatModel->getBookedSeats();
        return view('seats_view', ['bookedSeats' => $bookedSeats]);
    }

    public function book()
    {
        $seats = $this->request->getJSON(true);

        if (empty($seats['seats'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No seats selected'
            ]);
        }

        try {
            $result = $this->seatModel->bookSeats($seats['seats']);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Seats booked successfully'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function status()
    {
        $bookedSeats = $this->seatModel->getBookedSeats();
        return $this->response->setJSON([
            'success' => true,
            'bookedSeats' => $bookedSeats
        ]);
    }
}

