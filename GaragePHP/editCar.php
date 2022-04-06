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
    <title>Garage - Auto bewerken</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <header>
        <h1>Auto bewerken</h1>
    </header>
    <main class="form-container">
        <?php
        //Als post van autoId is gezet
        if (isset($_GET['carId'])) {
            //Haal auto data op
            $car = $db->selectCar($_GET['carId']);
            //Haal klanten op
            $customers = $db->selectCustomers();

            if ($car != null) {
                echo "<form method='POST' action='index.php' class='form-flex'>
                <div class='form-flex-row'>
                    <div class='form-inner-flex-row'>
                        <label>Auto ID:</label>
                        <p>$car[id]</p>
                    </div>
                </div>
                <div class='form-flex-row'>
                    <label for='brand'>Merk:</label>
                    <input type='text' name='brand' value='$car[brand]' />
                </div>
                <div class='form-flex-row'>
                    <label for='model'>Model:</label>
                    <input type='text' name='model' value='$car[model]'/>
                </div>
                <div class='form-flex-row'>
                    <label for='constructionyear'>Bouwjaar:</label>
                    <input type='text' name='constructionyear' value='$car[construction_year]'/>
                </div>
                <div class='form-flex-row'>
                    <label for='registration'>Kenteken:</label>
                    <input type='text' name='registration' value='$car[registration]'/>
                </div>
                <div class='form-flex-row'>
                    <label for='customerId'>Klant:</label>
                    <div class='form-inner-flex-row'>
                        <select id='customerId' name='customerId'>";
                //Als customers niet null is
                if ($customers != null) {
                    //zet $selectedCustomer gelijk aan eigenaar van huidige auto
                    $selectedCustomer = $car['customerid'];
                    //Loop de alle klanten heen
                    foreach ($customers as $customer) {
                        //Genereer voor elke klant een optie
                        echo "<option value='$customer[id]'";
                        //Als eigenaar van huidige auto overeenkomt met huidige customer id
                        if ($selectedCustomer == $customer['id']) {
                            //Zorg dat de optie geselecteerd wordt
                            echo " selected='true'";
                        }
                        //Zorg dat customer id, voornaam en achternaam zichtbaar zijn in de combobox
                        echo ">$customer[id] - $customer[firstname] $customer[lastname]</option>";
                    }
                }
                echo "</select>
              <p>OF</p>
               <a href='createCustomer.php?carId=$car[id]'>Nieuwe klant</a>
                </div>
            </div>
            <div class='form-flex-row'>
                <input type='hidden' name='carId' value='$car[id]'/>
                <input type='submit' name='editCar' value='Auto bewerken' />
            </div>
            </form>";
            }
        }
        else {
            //Link terug naar index pagina
            header("Location: index.php");
        }
        ?>
    </main>
</body>

</html>