<?php

require_once __DIR__ . '/../models/Passenger.php';
require_once __DIR__ . '/../models/Counter.php';

class LoginController extends Controller
{
    private $passengerModel;
    private $counterModel;

    public function __construct()
    {
        $this->passengerModel = new Passenger();
        $this->counterModel = new Counter();
    }

    public function login()
    {
        if (isset($_SESSION['username']) || isset($_SESSION['passagiernummer'])) {
            header('Location: /');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest();
        } else {
            $this->handleGetRequest();
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
        exit();
    }

    private function handleGetRequest()
    {
        return $this->view('login', ['title' => 'Login']);
    }

    private function handlePostRequest()
    {
        $errorMessage = '';

        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        try {
            if ($role === 'passenger') {
                $passengerNumber = $this->passengerModel->authenticate($username, $password);
                if ($passengerNumber) {
                    $_SESSION['name'] = $username;
                    $_SESSION['passengerNumber'] = $passengerNumber;
                    $_SESSION['type'] = 'passenger';
                    header('Location: /');
                    exit();
                } else {
                    $errorMessage = 'Invalid username or password';
                }
            } elseif ($role === 'worker') {
                if ($this->counterModel->authenticate($username, $password)) {
                    $_SESSION['counternumber'] = $username;
                    $_SESSION['type'] = 'worker';
                    header('Location: /');
                    exit();
                } else {
                    $errorMessage = 'Invalid username or password';
                }
            } else {
                $errorMessage = 'Invalid role';
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
        }

        return $this->view('login', ['title' => 'Login', 'errorMessage' => $errorMessage]);
    }
}