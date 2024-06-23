<?php
$title = $data['title'];
$cssFiles = [
    "/assets/css/new-flight.css"
];
include '../components/head.php';
include '../components/navbar.php';
?>

<div id="new-flight-container">
    <h1><?= htmlspecialchars($data['title']) ?></h1>

    <?php if (!empty($data['error'])): ?>
        <p class="error"><?= htmlspecialchars($data['error']) ?></p>
    <?php endif; ?>

    <form action="/flights/create" method="post">
        <div class="form-group">
            <label for="bestemming">Destination:</label>
            <select id="bestemming" name="bestemming" required>
                <?php foreach ($data['airports'] as $code => $name): ?>
                    <option value="<?= htmlspecialchars($code) ?>"><?= htmlspecialchars($name) ?>
                        (<?= htmlspecialchars($code) ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="gatecode">Gate:</label>
            <select id="gatecode" name="gatecode" required>
                <?php foreach ($data['gates'] as $code): ?>
                    <option value="<?= htmlspecialchars($code) ?>"><?= htmlspecialchars($code) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="max_aantal">Max Passengers:</label>
            <input type="number" id="max_aantal" name="max_aantal" required>
        </div>

        <div class="form-group">
            <label for="max_gewicht_pp">Max Weight per Passenger (kg):</label>
            <input type="number" step="0.01" id="max_gewicht_pp" name="max_gewicht_pp" required>
        </div>

        <div class="form-group">
            <label for="max_totaalgewicht">Max Total Weight (kg):</label>
            <input type="number" step="1" max="9999" id="max_totaalgewicht" name="max_totaalgewicht" required>
        </div>

        <div class="form-group">
            <label for="maatschappijcode">Airline:</label>
            <select id="maatschappijcode" name="maatschappijcode" required>
                <?php foreach ($data['airlines'] as $code => $name): ?>
                    <option value="<?= htmlspecialchars($code) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="vertrektijd">Departure Time:</label>
            <input type="datetime-local" id="vertrektijd" name="vertrektijd" required>
        </div>

        <div class="form-group">
            <button type="submit">Create Flight</button>
        </div>
    </form>
</div>

<?php include '../components/footer.php'; ?>