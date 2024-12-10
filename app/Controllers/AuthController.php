<?php

namespace App\Controllers;

use Cloudinary\Cloudinary;
use MongoDB\Client;

class AuthController extends BaseController
{


    public function index(): string
    {
        return view('authentication/login_page');
    }

    public function register()
    {
        return view('authentication/register_page');
    }

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

    // public function authenticate()
    // {

    //     $name = $this->request->getVar('name');
    //     $password = $this->request->getVar('password');

    //     $data = [
    //         "name" => $name,
    //         "password" => $password,
    //     ];

    //     $url = "http://localhost:5000/home/registerData";
    //     $ch = curl_init();

    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     $response = curl_exec($ch);
    //     curl_close($ch);
    // }

    public function authenticate()
    {
        $name = $this->request->getVar('name');
        $password = $this->request->getVar('password');
    
        $data = [
            "name" => $name,
            "password" => $password,
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
    
        if ($response === 'true' || $response === '1') {
            return redirect()->to('/');
        } else {
            return redirect()->to('/login')->with('error', 'Invalid credentials');
        }
    }
}
