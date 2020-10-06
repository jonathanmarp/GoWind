<?php

class Home extends Controller
{
	// If You Wont Using View You Can Change In Folder App/Views/Template/Header
	// If You Not Wont Using FrameWork Bootrap You Can Delete And Config In App/Views/Template/Header
	// You Can Give Parameter this example: $this->view("Template", $param);
	// In Template You Give Is $param -> $data
    // If You Not Change Anything Make This $data['title'] = "your title";
    public function index()
    {
        $data = [
            "title" => "Welcome In GoWind"
        ];

        $this->view("template/header", $data);
        $this->view("Home/index");
        $this->view("template/footer");
    }
}
