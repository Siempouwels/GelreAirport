<?php
$title = $data['title'];
$cssFiles = [
    "/assets/css/personal-flights.css",
    "/assets/css/styles.css"
];
include '../components/head.php';
include '../components/navbar.php';
?>

<div id="personal-flights-container">
    <h1><?= htmlspecialchars($title) ?></h1>

    <?php if (isset($data['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($data['error']) ?></div>
    <?php else: ?>
        <section class="passenger-info">
            <h2>Passenger Information</h2>
            <p>Name: <?= htmlspecialchars($data['passenger']['naam'] ?? 'N/A') ?></p>
            <p>Passenger Number: <?= htmlspecialchars($data['passenger']['passagiernummer'] ?? 'N/A') ?></p>
            <p>Gender: <?= htmlspecialchars($data['passenger']['geslacht'] ?? 'N/A') ?></p>
            <p>Check-in Counter: <?= htmlspecialchars($data['passenger']['balienummer'] ?? 'N/A') ?></p>
            <p>Seat: <?= htmlspecialchars($data['passenger']['stoel'] ?? 'N/A') ?></p>
            <p>Check-in Time: <?= htmlspecialchars($data['passenger']['inchecktijdstip'] ?? 'N/A') ?></p>
        </section>

        <section class="flight-info">
            <h2>Flights</h2>
            <?php if (empty($data['flights'])): ?>
                <p>No flights found for this passenger.</p>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Flight Number</th>
                            <th>Destination</th>
                            <th>Gate Code</th>
                            <th>Max Passengers</th>
                            <th>Max Weight Per Passenger</th>
                            <th>Max Total Weight</th>
                            <th>Departure Time</th>
                            <th>Airline Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['flights'] as $flight): ?>
                            <tr>
                                <td><?= htmlspecialchars($flight['vluchtnummer'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($flight['bestemming'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($flight['gatecode'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($flight['max_aantal'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($flight['max_gewicht_pp'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($flight['max_totaalgewicht'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($flight['vertrektijd'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($flight['maatschappijcode'] ?? 'N/A') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    <?php endif; ?>
</div>

<?php include '../components/footer.php'; ?>