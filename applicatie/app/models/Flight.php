<?php

require_once '../core/Model.php';

class Flight extends Model
{
    protected $table = 'Vlucht';

    // Define allowed sort columns and orders
    protected $allowedSortColumns = ['vluchtnummer', 'vertrektijd', 'aankomsttijd'];
    protected $allowedSortOrders = ['asc', 'desc'];

    public function getAllFlights($sortBy = 'vluchtnummer', $sortOrder = 'desc')
    {
        // Validate sortBy and sortOrder
        if (!in_array($sortBy, $this->allowedSortColumns)) {
            $sortBy = 'vluchtnummer';
        }
        if (!in_array($sortOrder, $this->allowedSortOrders)) {
            $sortOrder = 'desc';
        }

        $date = date('Y-m-d H:i:s');

        $sql = "SELECT * FROM {$this->table} WHERE vertrektijd > :date ORDER BY $sortBy $sortOrder";
        $params = ['date' => $date];

        return $this->fetchAll($sql, $params);
    }

    public function getHighestFlightNumber()
    {
        $sql = "SELECT MAX(vluchtnummer) AS max_vluchtnummer FROM {$this->table}";
        $result = $this->fetch($sql);

        return $result['max_vluchtnummer'];
    }

    public function createFlight($flightNumber, $destination, $gateCode, $maxPassengers, $maxWeightPerPassenger, $maxTotalWeight, $departureTime, $airlineCode)
    {
        // Validate input parameters
        if (
            empty($flightNumber) ||
            empty($destination) ||
            empty($gateCode) ||
            empty($maxPassengers) ||
            empty($maxWeightPerPassenger) ||
            empty($maxTotalWeight) ||
            empty($departureTime) ||
            empty($airlineCode)
        ) {
            throw new RuntimeException('All flight details must be provided.');
        }

        try {
            // Set departure time to the correct format
            $departureTime = date('Y-m-d H:i:s', strtotime($departureTime));

            // Check if it is later than the current date
            if (strtotime($departureTime) < time()) {
                throw new RuntimeException('Departure time must be in the future.');
            }

            $maxPassengers = (int) $maxPassengers;
            $maxWeightPerPassenger = (float) $maxWeightPerPassenger;
            $maxTotalWeight = (float) $maxTotalWeight;

            // Prepare data for insertion
            $data = [
                'vluchtnummer' => $flightNumber,
                'bestemming' => $destination,
                'gatecode' => $gateCode,
                'max_aantal' => $maxPassengers,
                'max_gewicht_pp' => $maxWeightPerPassenger,
                'max_totaalgewicht' => $maxTotalWeight,
                'vertrektijd' => $departureTime,
                'maatschappijcode' => $airlineCode
            ];

            // Use the insert method from the Model class
            $insertId = $this->insert($data);

            // Check if the insert was successful
            if ($insertId === 0) {
                throw new RuntimeException('Failed to create flight. No rows affected.');
            }

            return $insertId;

        } catch (PDOException $e) {
            // Log the exception (optional)
            error_log('Database error: ' . $e->getMessage());

            // Rethrow as a more general exception
            throw new RuntimeException('An error occurred while creating the flight. Please try again later.');
        }
    }

    public function getFlightByPassengerNumber($passengerNumber)
    {
        // Validate input parameter
        if (empty($passengerNumber)) {
            throw new InvalidArgumentException('Passenger number must be provided.');
        }

        // First, select the flight numbers where passagiernummer = $passengerNumber
        $sql = "SELECT vluchtnummer FROM Passagier WHERE passagiernummer = :passengerNumber";
        $params = ['passengerNumber' => $passengerNumber];
        $flightNumbers = $this->fetchAll($sql, $params);

        if (empty($flightNumbers)) {
            return []; // No flights found for this passenger
        }

        // Extract flight numbers into a simple array
        $flightNumbersArray = array_column($flightNumbers, 'vluchtnummer');

        // Prepare the placeholder string for the IN clause
        $placeholders = implode(',', array_fill(0, count($flightNumbersArray), '?'));

        // Second, select all flight details where vluchtnummer is in the flight numbers array
        $flightsSql = "SELECT * FROM {$this->table} WHERE vluchtnummer IN ($placeholders)";

        // Execute the query with the flight numbers as parameters
        return $this->fetchAll($flightsSql, $flightNumbersArray);
    }
}
