<?php

namespace App\Controllers;

use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use MongoDB\Client;

class HomeController extends BaseController
{
    public $collection;
    public function __construct(){
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
            'api_key' => $apiKey,
            'api_secret' => $apiSecret,
            'secure' => false,
            'verify' => false
        ]);

        $upload = $cloudinary->uploadApi()->upload($image->getPathname(), [
            'resource_type' => 'auto',
            'verify' => false
        ]);
        $imageUrl['url'] = $upload['url'];
        $mongoImageUrl = $upload['url'];
        var_dump($imageUrl);

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

        // echo view('home_page',$imageUrl);
        return redirect()->to(base_url("/"));
    }

    public function getDataById($id){
       $movieId[] = $this->collection->findOne(['_id'=>$id]);
      return  view('moviedescription_page', ['movieId' => $movieId] );
    }
}   
