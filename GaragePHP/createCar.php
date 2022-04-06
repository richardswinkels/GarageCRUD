<!DOCTYPE html>
<?php
//Include klasse garageDB
include_once './classes/GarageDB.php';
//Maak nieuwe instance van klasse GarageDB
$db = new GarageDB();

//Haal klanten op
$customers = $db->selectCustomers();
?>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage - Auto toevoegen</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <header>
        <h1>Auto toevoegen</h1>
    </header>
    <main class="form-container">
        <form method="POST" action="index.php" class="form-flex">
            <div class="form-flex-row">
                <label for="brand">Merk:</label>
                <input type="text" name="brand" />
            </div>
            <div class="form-flex-row">
                <label for="model">Model:</label>
                <input type="text" name="model" />
            </div>
            <div class="form-flex-row">
                <label for="constructionyear">Bouwjaar:</label>
                <input type="text" name="constructionyear" />
            </div>
            <div class="form-flex-row">
                <label for="registration">Kenteken:</label>
                <input type="text" name="registration" />
            </div>
            <div class="form-flex-row">
                <label for="customerId">Klant:</label>
                <div class="form-inner-flex-row">
                    <select id="customerId" name="customerId">
                        <?php
                        //Als klanten niet null is
                        if ($customers != null) {
                            //Loop door de klanten
                            foreach ($customers as $customer) {
                                //Maak voor iedere klant een optie in de combobox aan
                                echo "<option value='$customer[id]'>$customer[id] - $customer[firstname] $customer[lastname]</option>";
                            }
                        }
                        ?>
                    </select>
                    <p>OF</p>
                    <a href="createCustomer.php">Nieuwe klant</a>
                </div>
            </div>
            <div class="form-flex-row">
                <input type="submit" name="createCar" value="Auto toevoegen" />
            </div>
        </form>
    </main>
</body>

</html>