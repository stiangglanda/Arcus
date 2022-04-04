<!DOCTYPE html>
<html lang="en">

<head>
    <title>Übung (Kapitel 7)</title>
</head>

<body>
    <h1>Bewerbung, Newsletter oder Infomaterial</h1>
    <p>Bitte nennen Sie uns Ihr Anliegen:</p>
    <form action="./Untitled-1.php" method="post">

        <?php
        $anrede = isset($_POST["anrede"]) ? $_POST["anrede"] : '';
        $firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : '';
        $lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : '';
        $email = isset($_POST["email"]) ? $_POST["email"] : '';
        ?>

        <p>Anrede
            <input type="radio" name="anrede" value="Herr" <?= $anrede == "Herr" ? 'checked' : '' ?>> Herr
            <input type="radio" name="anrede" value="Frau" <?= $anrede == "Frau" ? 'checked' : '' ?>> Frau
        </p>

        <p>Vorname: <input type="text" name="firstname" value=<?= $firstname ?>></p>
        <p>Nachname: <input type="text" name="lastname" value=<?= $lastname ?>></p>
        <p>Mailadresse: <input type="text" name="email" value=<?= $email ?>></p>

        <p>
            <input type="submit" name="bewerben" value="bei Ihnen bewerben">
            <input type="submit" name="abo" value="Newsletter abonnieren">
            <input type="submit" name="anfordern" value="Infomaterial anfordern">
        </p>
        <p style="font-style: italic;">
            <?php
            if (isset($_POST["bewerben"]) && $anrede != '' && $firstname != '' && $lastname != '' && $email != '') {
                echo "Herzlichen Dank, $anrede $lastname, für Ihre Bewerbungsanfrage. Unsere Personalabteilung wird per Mail - an Ihre Adresse $email - Kontakt zu Ihnen aufnehmen.";
            }
            if (isset($_POST["abo"]) && $anrede != '' && $firstname != '' && $lastname != '' && $email != '') {
                echo "Herzlichen Dank, $anrede $lastname, für Ihre Abonnementsanfrage. Unsere Personalabteilung wird per Mail - an Ihre Adresse $email - Kontakt zu Ihnen aufnehmen.";
            }
            if (isset($_POST["anfordern"]) && $anrede != '' && $firstname != '' && $lastname != '' && $email != '') {
                echo "Herzlichen Dank, $anrede $lastname, für Ihre Infomaterialanforderung. Unsere Personalabteilung wird per Mail - an Ihre Adresse $email - Kontakt zu Ihnen aufnehmen.";
            }
            ?>
        </p>
    </form>
</body>

</html>