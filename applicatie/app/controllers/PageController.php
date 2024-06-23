<?php

class PageController extends Controller
{
    public function index()
    {
        return $this->view("home", [
            'title' => 'Home'
        ]);
    }
    public function privacy()
    {
        return $this->view("privacy", [
            'title' => 'Privacy verklaring'
        ]);
    }

    public function notFound()
    {
        $this->view('404', [
            'title' => 'Page not found',
            'askedPage' => $_SERVER['REQUEST_URI'],
        ]);
    }
}
