<?php 

namespace App\Models;

use CodeIgniter\Model;
use MongoDB\Client;

class SeatModel extends Model
{
    protected $mongoClient;
    protected $collection;

    public function __construct()
    {
        parent::__construct();
        
        // Initialize MongoDB connection
        $this->mongoClient = new Client("mongodb+srv://ajayvadadre:ajayvadadre1234@nodemongocluster.1y5lp.mongodb.net/");
        $this->collection = $this->mongoClient->test->seats;
    }

    public function bookSeats($seats)
    {
        // Check if seats are already booked
        $bookedSeats = $this->collection->find(['seatId' => ['$in' => $seats]]);
        
        if ($bookedSeats->toArray()) {
            throw new \Exception('Some seats are already booked');
        }

        // Book the seats
        foreach ($seats as $seatId) {
            $this->collection->insertOne([
                'seatId' => $seatId,
                // 'bookedAt' => new \MongoDB\BSON\UTCDateTime(),
                'status' => 'booked'
            ]);
        }

        return true;
    }

    public function getBookedSeats()
    {
        $bookedSeats = $this->collection->find(['status' => 'booked']);
        return array_map(function($seat) {
            return $seat->seatId;
        }, $bookedSeats->toArray());
    }
}

