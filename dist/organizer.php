<?php
    require 'includes/class-calendary.inc.php';

    $dateComponents = getdate();
    $curentMonth = $dateComponents['mon'];
    $currentYear = $dateComponents['year'];
    $calendar = new Calendary($curentMonth, $currentYear);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Filip Kwiatkowski">
    <title>Organizer</title>
    <link rel="stylesheet" href="css/app.css">
    <script src="https://kit.fontawesome.com/2cc1dc57cc.js" crossorigin="anonymous"></script>
</head>
<body>
    <header class="header">
        <div class="header__title--wrapper">
            <h2 class="header__title">MÓJ ORGANIZER</h2>
        </div>
        <div class="header__form--wrapper">
            <form action="" method="POST" class="header__form">
                <label for="add_event">Wpis wydarzenia: </label>
                <input type="text" name="add_event" id="add_event">
                <input type="submit" name="add_event__submit" value="Zapisz">
            </form>
        </div>
        <div class="header__logo--wrapper">
            <div class="header__logo--circle">
                <i class="far fa-calendar-alt header__logo"></i>
            </div>
        </div>
    </header>
    <section class="main-section calendary">
        <?php
            $calendar->build_calendar();
        ?>
    </section>
    <footer class="footer">
        <h1 class="footer__calendar-time">
        <?php
            echo("miesiąc: ". $calendar->getMonthName());
            echo(", rok: ". $calendar->getYear());              
        ?>
        </h1>
        <p class="footer__tax-number">Stronę wykonał: 01231405090</p>
    </footer>
    <script src="js/app.js"></script>
</body>
</html>