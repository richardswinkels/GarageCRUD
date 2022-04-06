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
    <title>Garage - Klant bewerken</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <header>
        <h1>Klant bewerken</h1>
    </header>
    <main class="form-container">
        <?php
        //Als post van customerId is gezet
        if (isset($_POST['customerId'])) {
            //Haal customer data op
            $customer = $db->selectCustomer($_POST['customerId']);
            //Als customer niet null is
            if ($customer != null) {
                //Laat formulier zien en vul deze met data
                echo "<form method='POST' action='index.php' class='form-flex'>
        <div class='form-flex-row'>
            <div class='form-inner-flex-row'>
                <label>Klant ID:</label>
                <p>$customer[id]</p>
            </div>
        </div>
        <div class='form-flex-split'>
            <div>
                <label for='firstname'>Voornaam:</label>
                <input type='text' name='firstname' value='$customer[firstname]' />
            </div>
            <div>
                <label for='lastname'>Achternaam:</label>
                <input type='text' name='lastname' value='$customer[lastname]'/>
            </div>
        </div>
        <div class='form-flex-row'>
            <label for='address'>Adres:</label>
            <input type='text' name='address' value='$customer[address]'/>
        </div>
        <div class='form-flex-split'>
            <div>
                <label for='postalcode'>Postcode:</label>
                <input type='text' name='postalcode' value='$customer[postalcode]'/>
            </div>
            <div>
                <label for='city'>Woonplaats:</label>
                <input type='text' name='city' value='$customer[city]'/>
            </div>
        </div>
        <div class='form-flex-row'>
            <label for='email'>E-mailadres:</label>
            <input type='text' name='email' value='$customer[email]'/>
        </div>
        <div class='form-flex-row'>
            <label for='phone'>Telefoonnummer:</label>
            <input type='text' name='phone' value='$customer[phone]'/>
        </div>
        <div class='form-flex-row'>
            <input type='hidden' name='customerId' value='$customer[id]'/>
            <input type='submit' name='editCustomer' value='Klant bewerken' />
        </div>
    </form>";
            }
        } else {
            //Link terug naar index pagina
            header("Location: index.php");
        }
        ?>
    </main>
</body>

</html>