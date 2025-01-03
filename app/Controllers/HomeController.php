<?php

namespace App\Controllers;

use Cloudinary\Cloudinary;
use MongoDB\Client;
use App\Models\SeatModel;
use CodeIgniter\Session\Session;

class HomeController extends BaseController
{
    public $collection;
    protected $seatModel;
    private $session;
    private $redis;

    public function __construct()
    {
        $this->seatModel = new SeatModel($this->collection);
        $mongodb = new Client("mongodb+srv://ajayvadadre:ajayvadadre1234@nodemongocluster.1y5lp.mongodb.net/");
        $db = $mongodb->selectDatabase("test");
        $this->collection = $db->selectCollection("moviebookings");

        $this->redis = new \Predis\Client([
            'scheme' => 'tcp',
            'host' => '127.0.0.1',
            'port' => 6379,
            'timeout' => 30,
            'read_timeout' => 30,
            'retry_interval' => 100
        ]);

        // Initialize session
        $this->session = \Config\Services::session();
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
        try {
            if (!$this->session->get('isLoggedIn')) {
                return redirect()->to('/login');
            }

            $redisSession = $this->redis->get('session:' . session_id());
            if (!$redisSession) {
                $this->session->destroy();
                return redirect()->to('/login');
            }

            $query = $this->collection->find();
            $mongoData = [];
            foreach ($query as $data) {
                $mongoData[] = $data;
            }

            return view('home_page', ['mongoData' => $mongoData]);
        } catch (\Exception $e) {
            log_message('error', 'getData error: ' . $e->getMessage());
            // return redirect()->to('/login')
            return view('home_page', ['mongoData' => $mongoData]);
        }
    }
    public function getDataAllMovies(){
        $query = $this->collection->find();
        $mongoData = [];
        foreach($query as $data){
            $mongoData[] = $data;
        };
        return view('viewallmovies_page',['mongoData' => $mongoData]);
    }


    public function viewAllMovies() {
        return view('viewallmovies_page');
    }

    // public function getData()
    // {
    //     $query = $this->collection->find();
    //     $mongoData = [];
    //     foreach ($query as $data) {
    //         $mongoData[] = $data;
    //     }

    //     $redis = new \Predis\Client([
    //         'scheme' => 'tcp',
    //         'host' => '127.0.0.1',
    //         'port' => 6379,
    //         'timeout' => 30,         
    //         'read_timeout' => 30,    
    //         'retry_interval' => 100    
    //     ]);

    //     $redisData = $redis->get('userData');
    //     $rData = json_decode($redisData);

    //     if ($rData==null) {
    //         return redirect()->to('/login');
    //     } else {
    //         return view('home_page', ['mongoData' => $mongoData]);
    //         // var_dump("error data : ". $data);
    //     }
    // }

    public function addData()
    {

        $name = $this->request->getVar('name');
        $genre = $this->request->getVar('genre');
        $director = $this->request->getVar('director');
        $date_created = $this->request->getVar('date_created');
        $image = $this->request->getFile('image');
        $description = $this->request->getVar('description');

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
        $data = [
            "name" => $name,
            "genre" => $genre,
            "date_created" => $date_created,
            "director" => $director,
            "description" => $description,
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

    public function bookSeats($id)
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
        return view('bookseats_page', ['bookedSeats' => $bookedSeats]);
    }

    public function displayTicket($id)
    {
        $client1 = service('curlrequest', [
            'baseURI' => "http://localhost:5000/home/",
        ]);
        $response1 = $client1->get("getDataById/" . $id);
        $body1 = $response1->getBody();
        $data1 = json_decode($body1, true);
        // print_r($data1);
        $client2 = service('curlrequest', [
            'baseURI' => "http://localhost:5000/home/"
        ]);
        $response2 = $client2->get("getSeatDataById/" . $id);
        $body2 = $response2->getBody();
        $data2 = json_decode($body2, true);
        // print_r($data2);

        $combinedData = array_merge($data1, $data2);
        // print_r($combinedData);
        // 
        return view('displayticket_page', ['data' => $combinedData]);
    }

    public function book()
    {
        $seats = $this->request->getJSON(true);
        // var_dump($seats);

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
