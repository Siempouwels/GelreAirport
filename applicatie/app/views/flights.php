<?php
$title = $data['title'];
$cssFiles = [
    "/assets/css/flights.css"
];
include '../components/head.php';
include '../components/navbar.php';
?>

<h1>Overzicht van Vluchten</h1>

<?php if (!empty($data['error'])): ?>
    <p><?= htmlspecialchars($data['error']) ?></p>
<?php endif; ?>

<?php if (!empty($data['flights'])): ?>
    <div class="table-wrapper">
        <table>
            <tr>
                <th><a href="?sort=vluchtnummer&order=<?= $data['toggleOrder'] ?>">Vluchtnummer</a></th>
                <th><a href="?sort=bestemming&order=<?= $data['toggleOrder'] ?>">Bestemming</a></th>
                <th><a href="?sort=vertrektijd&order=<?= $data['toggleOrder'] ?>">Vertrektijd</a></th>
                <th>Gate</th>
                <th>Maximaal Aantal Passagiers</th>
                <th>Maximaal Gewicht per Passagier</th>
                <th>Maximaal Totaalgewicht</th>
                <th>Maatschappij</th>
            </tr>
            <?php foreach ($data['flights'] as $flight): ?>
                <tr>
                    <td><a href="vlucht.php?vluchtnummer=<?= htmlspecialchars($flight['vluchtnummer']) ?>"><?= htmlspecialchars($flight['vluchtnummer']) ?></a></td>
                    <td><?= htmlspecialchars($flight['bestemming']) ?></td>
                    <td><?= htmlspecialchars($flight['vertrektijd']) ?></td>
                    <td><?= htmlspecialchars($flight['gatecode']) ?></td>
                    <td><?= htmlspecialchars($flight['max_aantal']) ?></td>
                    <td><?= htmlspecialchars($flight['max_gewicht_pp']) ?></td>
                    <td><?= htmlspecialchars($flight['max_totaalgewicht']) ?></td>
                    <td><?= htmlspecialchars($flight['maatschappijcode']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php else: ?>
    <p>Geen vluchten gevonden.</p>
<?php endif; ?>

<?php include '../components/footer.php'; ?>
