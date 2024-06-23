<?php

require_once __DIR__ . '/../models/Flight.php';
require_once __DIR__ . '/../models/Airline.php';
require_once __DIR__ . '/../models/Airport.php';
require_once __DIR__ . '/../models/Gate.php';

class FlightController extends Controller
{
    private $flightModel;
    private $airlineModel;
    private $airportModel;
    private $gateModel;

    public function __construct()
    {
        $this->flightModel = new Flight();
        $this->airlineModel = new Airline();
        $this->airportModel = new Airport();
        $this->gateModel = new Gate();
    }

    public function index()
    {
        $sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'vluchtnummer';
        $sortOrder = isset($_GET['order']) && $_GET['order'] === 'asc' ? 'asc' : 'desc';
        $toggleOrder = $sortOrder === 'asc' ? 'desc' : 'asc';

        try {
            $flights = $this->flightModel->getAllFlights($sortBy, $sortOrder);
        } catch (PDOException $e) {
            $flights = [];
            $error = "Error retrieving flight information: " . $e->getMessage();
        }

        return $this->view("flights", [
            'title' => 'Vluchtenoverzicht',
            'flights' => $flights,
            'sortOrder' => $sortOrder,
            'toggleOrder' => $toggleOrder,
            'error' => $error ?? null
        ]);
    }

    public function new()
    {
        $airlines = $this->airlineModel->getOptionList();
        $airports = $this->airportModel->getOptionList();
        $gates = $this->gateModel->getOptionList();

        return $this->view('flight-new', [
            'title' => 'Nieuwe vlucht',
            'airlines' => $airlines,
            'airports' => $airports,
            'gates' => $gates
        ]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->view('flight-new', [
                'title' => 'Nieuwe vlucht',
                'error' => 'Invalid request method'
            ]);
        }

        $destination = $_POST['bestemming'];
        $gateCode = $_POST['gatecode'];
        $maxPassengers = $_POST['max_aantal'];
        $maxWeightPerPassenger = $_POST['max_gewicht_pp'];
        $maxTotalWeight = $_POST['max_totaalgewicht'];
        $departureTime = $_POST['vertrektijd'];
        $airlineCode = $_POST['maatschappijcode'];

        $lastFlightNumber = $this->flightModel->getHighestFlightNumber();
        $flightNumber = $lastFlightNumber + 1;

        try {
            $this->flightModel->createFlight(
                $flightNumber,
                $destination,
                $gateCode,
                $maxPassengers,
                $maxWeightPerPassenger,
                $maxTotalWeight,
                $departureTime,
                $airlineCode
            );
            header('Location: /flights');
            exit();
        } catch (RuntimeException $e) {
            $airlines = $this->airlineModel->getOptionList();
            $airports = $this->airportModel->getOptionList();
            $gates = $this->gateModel->getOptionList();

            return $this->view('flight-new', [
                'title' => 'Nieuwe vlucht',
                'airlines' => $airlines,
                'airports' => $airports,
                'gates' => $gates,
                'error' => "Error creating flight: " . $e->getMessage()
            ]);
        }
    }

    public function personalFlights()
    {
        if (!isset($_SESSION['name'])) {
            header('Location: /login');
            exit();
        }

        $flights = $this->flightModel->getPersonalFlights($_SESSION['name']);

        return $this->view('personal-flights', [
            'title' => 'Mijn vluchtgegevens',
            'flights' => $flights
        ]);
    }

}
