<?php

namespace App\Controllers;

use Cloudinary\Cloudinary;
use MongoDB\Client;
use CodeIgniter\Session\Session;

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
    public function index(): string
    {
        $redis = new \Predis\Client([
            'scheme' => 'tcp',
            'host' => '127.0.0.1',
            'port' => 6379,
            'timeout' => 30,           // Increased timeout
            'read_timeout' => 30,      // Read timeout
            'retry_interval' => 100    // Retry interval in milliseconds
        ]);
        $data = $redis->get('name');
        if ($data) {
            return view('/');
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
        $this->redis->del('session:' . session_id());

        // Clear CodeIgniter session
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
        $hashPassword =  password_hash($password, PASSWORD_DEFAULT);

        $data = [
            "name" => $name,
            "email" => $email,
            "password" => $password,
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
            return redirect()->to('/');

            // return redirect()->to('/login')
            // ->with('error', 'Username and password are required');
        }

        if ($name === 'admin' && $password === '1234') {
            $sessionData = [
                'name' => $name,
                'isAdmin' => true,
                'isLoggedIn' => true
            ];

            $this->redis->setex('session:' . session_id(), 86400, json_encode($sessionData));
            $this->session->set($sessionData);
            return redirect()->to('/');
        }
        //
        $response = $this->authenticateWithAPI($name, $password);

        if ($response === 'true' || $response === '1') {
            $sessionData = [
                'name' => $name,
                'isAdmin' => false,
                'isLoggedIn' => true
            ];

            $this->redis->setex('session:' . session_id(), 86400, json_encode($sessionData));
            $this->session->set($sessionData);
            return redirect()->to('/');
        }
        return redirect()->to('/login');
    }

    public function authenticateWithAPI($name, $password)
    {
        $name = $this->request->getVar('name');
        $password = $this->request->getVar('password');

        $url = "http://localhost:5000/home/authentication";
        $data = [
            "name" => $name,
            "password" => $password
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



        return $response;
    }
}


//     public function authenticate()
//     {
//         $name = $this->request->getVar('name');
//         $password = $this->request->getVar('password');
//         $redis = new \Predis\Client([
//             'scheme' => 'tcp',
//             'host' => '127.0.0.1',
//             'port' => 6379,
//             'timeout' => 30,           // Increased timeout
//             'read_timeout' => 30,      // Read timeout
//             'retry_interval' => 100    // Retry interval in milliseconds
//         ]);
//         $data = [
//             "name" => $name,
//             "password" => $password,
//         ];

//         if ($name == 'admin' && $password == '1234') {
//             $redis->set('adminData', json_encode($data));
//             $redis->set('isAdmin', 'true');
//             return redirect()->to('/');
//         } else {
//         $url = "http://localhost:5000/home/authentication";
//         $ch = curl_init();

//         curl_setopt($ch, CURLOPT_URL, $url);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_POST, true);
//         curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//         $response = curl_exec($ch);
//         curl_close($ch);

//         if ($response === 'true' || $response === '1') {
//             $redis->set('userData', json_encode($data));
//             $redis->set('isAdmin', 'false'); 
//             return redirect()->to('/');
//         } else {
//             // return redirect()->to('/');
//             return redirect()->to('/login')->with('error', 'Invalid credentials');
//         }
//         }
//     }
// }
