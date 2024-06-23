<nav class="navbar">
    <a href="/" class="nav-logo">
        <img src="/assets/images/logo.png" alt="Logo van Gelre checkin">
        <span>Gelre checkin</span>
    </a>

    <?php 
        print_r($_SESSION);
    ?>

    <ul class="nav-links">
        <?php
        if (
            isset($_SESSION['counternumber']) &&
            isset($_SESSION['type']) &&
            $_SESSION['type'] == 'worker'
        ) {
            echo '<li><a href="/flights/new">Nieuwe vlucht</a></li>';
        }
        ?>
        <?php
        if (
            isset($_SESSION['name']) &&
            isset($_SESSION['type']) &&
            $_SESSION['type'] == 'passenger'
        ) {
            echo '<li><a href="/flights/personal">Mijn vluchten</a></li>';
        }
        ?>

        <li><a href="/flights">Vluchtenoverzicht</a></li>
        <li><a href="/privacy">Privacyverklaring</a></li>
        <?php if (
            (isset($_SESSION['name']) || isset($_SESSION['counternumber'])) &&
            isset($_SESSION['type']) &&
            ($_SESSION['type'] == 'passenger' || $_SESSION['type'] == 'worker')
        ) { ?>
            <li>
                <form action="/logout" method="post">
                    <button type="submit" class="logout-button">Uitloggen</button>
                </form>
            </li>
        <?php } else { ?>
            <li>
                <a href="/login">Login</a>
            </li>
        <?php } ?>
    </ul>
</nav>