<?php
require_once('connexion.php');
require_once('pretyDump.php');
    // requete de tous les clients
    $request =  $db->query('SELECT * FROM clients');
    $allClients = $request->fetchAll();

    // requete de tous les types de spectacles possibles
    $request = $db->query('SELECT * FROM showtypes');
    $allShowNames = $request->fetchAll();

    // requete des 20 premiers clients
    $request =  $db->query('SELECT * FROM clients LIMIT 20');
    $twentyFirstClients = $request->fetchAll();

    // requete des clients avec une carte de fidélité
    $request =  $db->query('SELECT * FROM clients WHERE cardNumber');
    $allClientsWithFidelityCard = $request->fetchAll();

    // requete des clients avec le nom commencant par M
    $request =  $db->query("SELECT * FROM clients WHERE lastName LIKE 'M%' ORDER BY lastName");
    $allClientsNameMLike = $request->fetchAll();

    // requete des spectacles par artistes et par date
    $queryString = "SELECT shows.title, shows.performer, shows.date, shows.startTime, showtypes.type 
                    FROM shows 
                    INNER JOIN showtypes ON shows.showTypesId = showtypes.id
                    ORDER BY shows.title";
    $request =  $db->query($queryString);
    $allShows = $request->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <section>
        <!-- affichage de tous les clients -->
        <h1 class="titre"> Clients </h1>

        <table>
            <tr>
                <th>Last Name</th>
                <th>First Name</th>

            </tr>
            <?php foreach ($allClients as $client) {
                echo "<tr>
              <td>" . $client["lastName"] . "</td>
              <td>" . $client["firstName"] . "</td>

            </tr>";
            } ?>
        </table>
    </section>

    <section>
        <!-- affichage de tous spéctacles -->
        <h1 class="titre"> Type de spectacle </h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Type de spectacle</th>

            </tr>
            <?php foreach ($allShowNames as $showNames) {
                echo "<tr>
              <td>" . $showNames["id"] . "</td>
              <td>" . $showNames["type"] . "</td>
            </tr>";
            } ?>
        </table>
    </section>

    <section>
        <!-- affichage des 20 premiers clients -->
        <h1 class="titre"> 20 Clients </h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>

            </tr>
            <?php foreach ($twentyFirstClients as $client) {
                echo "<tr>
              <td>" . $client["id"] . "</td>
              <td>" . $client["lastName"] . "</td>
              <td>" . $client["firstName"] . "</td>

            </tr>";
            } ?>
        </table>
    </section>

    <section>
        <!-- affichage des clients avec carte de fidélité-->
        <h1 class="titre"> Clients avec carte de fidélité </h1>

        <table>
            <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Card Number</th>
            </tr>
            <?php foreach ($allClientsWithFidelityCard as $client) {
                echo "<tr>
              <td>" . $client["lastName"] . "</td>
              <td>" . $client["firstName"] . "</td>
              <td>" . $client["cardNumber"] . "</td>
            </tr>";
            } ?>
        </table>
    </section>

    <section>
        <!-- affichage des clients avec un nom en M -->
        <h1 class="titre"> Clients avec un nom en M </h1>

        <table>
            <tr>
                <th>Last Name</th>
                <th>First Name</th>
            </tr>
            <?php foreach ($allClientsNameMLike as $client) {
                echo "<tr>
              <td>" . $client["lastName"] . "</td>
              <td>" . $client["firstName"] . "</td>
            </tr>";
            } ?>
        </table>
    </section>

    <section>
        <!-- affichage des show -->
        <h1 class="titre"> Liste des spectacles </h1>

        <table>
            <tr>
                <th>Nom du spectacle</th>
                <th>Artiste</th>
                <th>Type de spectacle</th>
                <th>Date du spectacle</th>
                <th>Heure du spectacle</th>

            </tr>
            <?php foreach ($allShows as $show) {
                echo "<tr>
              <td>" . $show["title"] . "</td>
              <td>" . $show["performer"] . "</td>
              <td>" . $show["type"] . "</td>
              <td>" . $show["date"] . "</td>
              <td>" . $show["startTime"] . "</td>
            </tr>";
            } ?>
        </table>
    </section>

    <section>
        <!-- affichage des clients avec détail-->
        <h1 class="titre"> Clients avec carte de fidélité </h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Birth Date</th>
                <th>Card</th>
                <th>Card Number</th>
            </tr>
            <?php foreach ($allClients as $client) {

                $haveACard = ($client["card"]) ? "Oui" : "Non";

                echo "<tr>
                <td>" . $client["id"] . "</td>
                <td>" . $client["lastName"] . "</td>
                <td>" . $client["firstName"] . "</td>
                <td>" . $client["birthDate"] . "</td>
                <td>" . $haveACard . "</td>
                <td>" . $client["cardNumber"] . "</td>
                </tr>";
            } ?>
        </table>
    </section>
    
</body>

</html>