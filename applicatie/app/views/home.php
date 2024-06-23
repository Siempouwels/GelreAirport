<?php
$title = "Home";
$cssFiles = [
    "/assets/css/home.css"
];
include '../components/head.php';
include '../components/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>
</head>

<body>

<section class="header">
    <h1>Welkom bij Gelre Checkin!</h1>
    <p>Ontdek de moeiteloze manier om in te checken bij Gelre Checkin en geniet van een naadloze reiservaring.</p>
</section>

<section class="practical-info">
    <h2>Praktische informatie</h2>
    <div class="info-cards">
        <article class="article-card">
            <a href="/"><h3>Voor bezoekers</h3></a>
            <p>
                Welkom bij Gelre Checkin! Als bezoeker bieden wij u een naadloze en efficiënte ervaring tijdens uw verblijf op Gelre Airport. Geniet van het gemak van probleemloos inchecken, verkrijg belangrijke reisinformatie en maak gebruik van onze faciliteiten en diensten. Of u nu hier bent voor zaken of plezier, wij streven ernaar om uw verblijf zo comfortabel mogelijk te maken. Ontdek onze gastvrijheid en ervaar een vlotte en aangename reiservaring bij Gelre Checkin!
            </p>
        </article>

        <article class="article-card">
            <h3>Voor personeel</h3>
            <p>
                Welkom bij Gelre Checkin! Als personeelslid bieden wij u een gestroomlijnde en efficiënte werkomgeving op Gelre Airport. Profiteer van ons gebruiksvriendelijke systeem waarmee u passagiers kunt helpen bij het boeken, inchecken en wijzigen van vluchten. Daarnaast heeft u snel toegang tot gedetailleerde vluchtinformatie en kunt u eenvoudig alle benodigde gegevens raadplegen. Bij Gelre Checkin streven we ernaar om uw werk zo soepel mogelijk te laten verlopen. Ontdek de voordelen van ons overzichtelijke systeem en ervaar een geoptimaliseerde werkdag bij Gelre Checkin!
            </p>
        </article>
    </div>
</section>

<?php include '../components/footer.php'; ?>

</body>
</html>
