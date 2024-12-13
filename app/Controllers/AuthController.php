<?php

namespace App\Controllers;

use Cloudinary\Cloudinary;
use MongoDB\Client;
use CodeIgniter\Session\Session;
use PHPUnit\Framework\Attributes\ExcludeStaticPropertyFromBackup;

class AuthController extends BaseController
{

    private $redis;
    private $session;
    public function __construct()
    {
        $this->redis = new \Predis\Client([
            'scheme' => 'tcp',
            'host' => '127.0.0.1',
            'port' => 6379,
            'timeout' => 30,
            'read_timeout' => 30,
            'retry_interval' => 100
        ]);
        $this->session = \Config\Services::session();
    }
    public function index()
    {

        // $data = $redis->get('name');
        $alreadyExists = $this->redis->get('session:' . session_id());

        if ($alreadyExists) {
            // return view('home_page');
            return redirect()->to('/');
            // return redirect()->to('/login');

        } else {
            return view('authentication/login_page');
        }
    }

    public function register()
    {
        return view('authentication/register_page');
    }


    public function logOut()
    {
        // Clear Redis session
        // $this->session->set($sessionData);
        $id = $this->session->get('id');
        $logOutTime = [
            'id' => $id,
            "OutTime" => date("Y-m-d H:i:s")
        ];
        $url = "http://localhost:5000/home/updateLogData";

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode($logOutTime),
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        var_dump($response);
        var_dump($error);
        curl_close($ch);
        $this->redis->del('session:' . session_id());
        $this->session->destroy();
        return redirect()->to('/login');
    }


    // public function logOut()
    // {

    //     $redis = new \Predis\Client([
    //         'scheme' => 'tcp',
    //         'host' => '127.0.0.1',
    //         'port' => 6379,
    //         'timeout' => 30,           // Increased timeout
    //         'read_timeout' => 30,      // Read timeout
    //         'retry_interval' => 100    // Retry interval in milliseconds
    //     ]);
    //     $name = 'userData';
    //     $admin = 'adminData';
    //     $redis->del($name, $admin);
    //     return redirect()->to('/login');
    // }


    public function saveData()
    {
        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $time_created = getdate();

        $hashPassword =  password_hash($password, PASSWORD_DEFAULT);

        $data = [
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "time_created" => $time_created,
            "hashPassword" => $hashPassword
        ];


        $url = "http://localhost:5000/home/registerData";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return redirect()->to("/login");
    }


    public function authenticate()
    {
        $name = $this->request->getVar('name');
        $password = $this->request->getVar('password');


        if (empty($name) || empty($password)) {
            return redirect()->to('/login');
        }

        if ($name === 'admin' && $password === '1234') {
            $sessionData = [
                'name' => $name,
                'isAdmin' => true,
                'isLoggedIn' => true,
                'InTime' => date("Y-m-d H:i:s")
            ];

            $this->redis->setex('session:' . session_id(), 86400, json_encode($sessionData));
            $this->session->set($sessionData);
            return redirect()->to('/');
        }
        
        $this->authenticateWithAPI($name, $password);
        return redirect()->to('/login');
    }

    public function authenticateWithAPI($name, $password)
    {
        $name = $this->request->getVar('name');
        $password = $this->request->getVar('password');
        $url = "http://localhost:5000/home/authentication";
        $data = [
            "name" => $name,
            "password" => $password,
            "loginTime" =>  date("Y-m-d H:i:s"),
            "logOutTime" =>    ' '
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        //-- Saving/Creating InLog time-----------
        $url2 = "http://localhost:5000/home/addLogTime";

        $ch2 = curl_init();
        curl_setopt_array($ch2, [
            CURLOPT_URL => $url2,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $response2 = curl_exec($ch2);
        $mainData = json_decode($response2);
        $error = curl_error($ch2);

        $id = $mainData->_id;
        curl_close($ch2);

        // Checking if password is correct or not 
        if ($response === 'true' || $response === '1') {
            $sessionData = [
                'id' => $id,
                'name' => $name,
                'isAdmin' => false,
                'isLoggedIn' =>  date("Y-m-d H:i:s")
            ];

            $this->redis->setex('session:' . session_id(), 86400, json_encode($sessionData));
            $this->session->set($sessionData);
            return redirect()->to('/');
        } else {
            return redirect()->to('/login');
        }
    }

    public function viewLogs(){
        $client = service('curlrequest', [
            'baseURI' => "http://localhost:5000/home/getLogData/" ,
        ]);
        $response = $client->get("");
        $body = $response->getBody();
        $data = json_decode($body, true);

        return view('viewlogs_page',['mongoData'=> $data]);
    }
}
