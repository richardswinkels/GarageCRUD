<!DOCTYPE html>
<?php
//Include klasse garageDB
include_once './classes/GarageDB.php';
//Maak nieuwe instance van klasse GarageDB
$db = new GarageDB();
?>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage - Klant toevoegen</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <header>
        <h1>Klant toevoegen</h1>
    </header>
    <main class="form-container">
        <?php
        //Als post createCustomer gezet is
        if (isset($_POST['createCustomer'])) {
            //Maak nieuwe klant aan
            $db->createCustomer($_POST['firstname'], $_POST['lastname'], $_POST['address'], $_POST['postalcode'], $_POST['city'], $_POST['email'], $_POST['phone']);

            //Als carId gezet is
            if (isset($_GET['carId'])) {
                //Link terug naar autobewerk pagina met GET waarde in de url
                header("Location: editCar.php?carId=$_GET[carId]");
            } else {
                //Link terug naar de pagina om nieuwe auto te maken
                header("Location: createCar.php");
            }
        }
        ?>
        <form method="POST" action="" class="form-flex">
            <div class="form-flex-split">
                <div>
                    <label for="firstname">Voornaam:</label>
                    <input type="text" name="firstname" />
                </div>
                <div>
                    <label for="lastname">Achternaam:</label>
                    <input type="text" name="lastname" />
                </div>
            </div>
            <div class="form-flex-row">
                <label for="address">Adres:</label>
                <input type="text" name="address" />
            </div>
            <div class="form-flex-split">
                <div>
                    <label for="postalcode">Postcode:</label>
                    <input type="text" name="postalcode" />
                </div>
                <div>
                    <label for="city">Woonplaats:</label>
                    <input type="text" name="city" />
                </div>
            </div>
            <div class="form-flex-row">
                <label for="email">E-mailadres:</label>
                <input type="text" name="email" />
            </div>
            <div class="form-flex-row">
                <label for="phone">Telefoonnummer:</label>
                <input type="text" name="phone" />
            </div>
            <div class="form-flex-row">
                <input type="submit" name="createCustomer" value="Klant toevoegen" />
            </div>
        </form>
    </main>
</body>

</html>