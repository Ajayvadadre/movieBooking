<?php

namespace App\Controllers;

use Cloudinary\Cloudinary;
use MongoDB\Client;
use Cloudinary\Api\Upload\UploadApi;
use MongoDB\Model\BSONArray;
use MongoDB\Model\BSONDocument;
use MongoDB\Model\BSONIterator;
use MongoDB\BSON\ObjectId;
use MongoDB\MongoId;
use CodeIgniter\RESTful\ResourceController;
use App\Models\SeatModel;

class HomeController extends BaseController
{
    public $collection;
    protected $seatModel;

    public function __construct()
    {
        $this->seatModel = new SeatModel();
        $mongodb = new Client("mongodb+srv://ajayvadadre:ajayvadadre1234@nodemongocluster.1y5lp.mongodb.net/");
        $db = $mongodb->selectDatabase("test");
        $this->collection = $db->selectCollection("moviebookings");
    }
    public function index(): string
    {
        return view('home_page');
    }

    public function movieDescription()
    {
        return view('moviedescription_page');
    }

    public function getData()
    {
        $query = $this->collection->find();
        $mongoData = [];
        foreach ($query as $data) {
            $mongoData[] = $data;
        }
        return view('home_page', ['mongoData' => $mongoData]);
    }

    public function addData()
    {

        $name = $this->request->getVar('name');
        $genre = $this->request->getVar('genre');
        $director = $this->request->getVar('director');
        $date_created = $this->request->getVar('date_created');
        $image = $this->request->getFile('image');

        $apiSecret = env('CLOUDINARY_API_SECRET');
        $apiKey = env('CLOUDINARY_API_KEY');

        $cloudinary = new Cloudinary([
            'cloud_name' => 'df0ifelxk',
            'api_key' => 544285332337555,
            'api_secret' => 'EeDgS7vHuGYUTfOSbCQvoisNJ9M',
            'secure' => false,
            'verify' => false
        ]);

        $upload = $cloudinary->uploadApi()->upload($image->getPathname(), [
            'resource_type' => 'auto',
            'verify' => false
        ]);
        $imageUrl['url'] = $upload['url'];
        $mongoImageUrl = $upload['url'];
        // var_dump($imageUrl);

        $data = [
            "name" => $name,
            "genre" => $genre,
            "date_created" => $date_created,
            "director" => $director,
            "image" => $mongoImageUrl ?? null
        ];
        $url = "http://localhost:5000/home/createData";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        session()->setFlashData("z", "Movie added Sucessfully");
        return redirect()->to(base_url("/"));
    }

    public function getDataById($id)
    {
        $client = service('curlrequest', [
            'baseURI' => "http://localhost:5000/home/getDataById/" . $id,
        ]);
        $response = $client->get("");
        $body = $response->getBody();
        $data = json_decode($body, true);

        return view('moviedescription_page', ['data' => $data]);
    }

    public function updateMovieData($id)
    {
        $name = $this->request->getVar('name');
        $genre = $this->request->getVar('genre');
        $director = $this->request->getVar('director');
        $date_created = $this->request->getVar('date_created');
        $image = $this->request->getFile('image');


        $cloudinary = new Cloudinary([
            'cloud_name' => 'df0ifelxk',
            'api_key' => 544285332337555,
            'api_secret' => 'EeDgS7vHuGYUTfOSbCQvoisNJ9M',
            'secure' => false,
            'verify' => false
        ]);

        $upload = $cloudinary->uploadApi()->upload($image->getPathname(), [
            'resource_type' => 'auto',
            'verify' => false
        ]);
        $mongoImageUrl = $upload['url'];

        $updateData = [
            "name" => $name,
            "genre" => $genre,
            "date_created" => $date_created,
            "director" => $director,
            "image" => $mongoImageUrl ?? null
        ];

        $url = "http://localhost:5000/home/update/$id";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($updateData));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        // $body = $response->getBody();
        return redirect()->to(base_url("/movieDescription/getData/$id"));
            // var_dump($data);
        ;
    }

    public function deletMovieData($id)
    {

        $client = service('curlrequest', [
            'baseURI' => "http://localhost:5000/home/delete/" . $id,
        ]);
        $response = $client->delete("");
        $body = $response->getBody();
        $data = json_decode($body, true);
        return redirect()->to(base_url("/"));
    }


    public function bookTickets($id)
    {

        // $client = service('curlrequest', [
        //     'baseURI' => "http://localhost:5000/home/getDataById/" . $id,
        // ]);
        // $response = $client->get("");
        // $body = $response->getBody();
        // $data = json_decode($body, true);
        // return view('booktickets_page', ['data' => $data]);

        // Get booked seats from the model
        $bookedSeats = $this->seatModel->getBookedSeats();
        return view('booktickets_page', ['bookedSeats' => $bookedSeats]);
    }

    public function storeSeats() {}

    public function displayTicket($id)
    {
        $client = service('curlrequest', [
            'baseURI' => "http://localhost:5000/home/getDataById/" . $id,
        ]);
        $response = $client->get("");
        $body = $response->getBody();
        $data = json_decode($body, true);
        return view('displayticket_page', ['data' => $data]);
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
            // return view("displayticket_page",['result'=>$result]);
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
