<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        return view('home_page');
    }

    public function movieDescriptionview()
    {
        return view('moviedescription_page');
    }

    public function movieDescription()
    {
        $requestdata = $this->request->getJSON();
        var_dump($requestdata);     
        $title = $requestdata->title;
        $imgUrl = $requestdata->imgUrl;
        $description = $requestdata->description;

        $data = array(
            'title' => $title,
            // 'imgUrl' => $imgUrl,
            'description' =>  $description
        );

        session()->set('movieData', $data);
        return redirect()->to('/movieDescriptionview');
    }
}
