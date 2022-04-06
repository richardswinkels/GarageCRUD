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
    <title>Garage</title>
    <link rel="stylesheet" href="css/styles.css" />
    </script>
</head>

<body>
    <main id="overview">
        <div id="cars">
            <header>
                <h1>Auto's</h1>
            </header>
            <?php
            if(isset($_POST['createCar']) && isset($_POST['customerId'])) {
                $db->createCar($_POST['brand'], $_POST['model'], $_POST['constructionyear'], $_POST['registration'], $_POST['customerId']);
            }

            if(isset($_POST['editCar'])) {
                $db->updateCar($_POST['carId'], $_POST['brand'], $_POST['model'], $_POST['constructionyear'], $_POST['registration'], $_POST['customerId']);
            }

            if(isset($_POST['editCustomer'])) {
                $db->updateCustomer($_POST['customerId'], $_POST['firstname'], $_POST['lastname'], $_POST['address'], $_POST['postalcode'], $_POST['city'], $_POST['email'], $_POST['phone']);
            }

            if(isset($_POST['deleteCar'])) {
                $customerCars = $db->selectCarCustomer($_POST['customerId']);

                if(count($customerCars) == 1) {
                    $db->deleteCustomerCars($_POST['customerId']);
                } else {
                    $db->deleteCar($_POST['carId']);
                }
            }

            if(isset($_POST['deleteCustomer'])) {
                $db->deleteCustomerCars($_POST['customerId']);
            }
            ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Merk</th>
                    <th>Model</th>
                    <th>Bouwjaar</th>
                    <th>Kenteken</th>
                    <th colspan="2"></th>
                </tr>
                <?php
                $cars = $db->selectCars();

                if ($cars != null) {
                    foreach ($cars as $car) {
                        echo "<tr>
                                <td>$car[id]</td>
                                <td>$car[brand]</td>
                                <td>$car[model]</td>
                                <td>$car[construction_year]</td>
                                <td>$car[registration]</td>
                                <td class='inlineButtons'>
                                    <form method='GET' action='editCar.php'>
                                        <input type='hidden' name='carId' value='$car[id]'/>
                                        <input type='submit' value='Bewerken'/> 
                                    </form>                  
                                    <form method='POST' action=''>
                                        <input type='hidden' name='carId' value='$car[id]'/>
                                        <input type='hidden' name='customerId' value='$car[customerid]'/>
                                        <input type='submit' name='deleteCar' value='Verwijderen'/> 
                                    </form> 
                                    <form method='POST' action=''>
                                        <input type='hidden' name='customerId' value='$car[customerid]'/>
                                        <input type='submit' name='readCustomerData' value='Klantgegevens inzien'/> 
                                    </form>
                                </td>
                            </tr>";
                    }
                }
                ?>
            </table>
            <form method='POST' action='createCar.php'>
                <input type='submit' value='Voeg nieuwe auto toe' />
            </form>
        </div>
        <div id="customerData">
            <header>
                <h1>Klantgegevens</h1>
            </header>
            <?php
            if(isset($_POST['readCustomerData']) || isset($_POST['editCustomer'])) {

            $customer = $db->selectCustomer($_POST['customerId']);

            echo "<div class='customerdata-flex'>
            <div class='customerdata-flex-row'>
                <div class='customerdata-inner-flex-row'>
                    <label>Klant ID:</label>
                    <p>$customer[id]</p>
                </div>
            </div>
            <div class='customerdata-flex-split'>
                <div>
                    <label>Voornaam:</label>
                    <p>$customer[firstname]</p>
                </div>
                <div>
                    <label>Achternaam:</label>
                    <p>$customer[lastname]</p>
                </div>
            </div>
            <div class='customerdata-flex-row'>
                <label>Adres:</label>
                <p>$customer[address]</p>
            </div>
            <div class='customerdata-flex-split'>
                <div>
                    <label>Postcode:</label>
                    <p>$customer[postalcode]</p>
                </div>
                <div>
                    <label for='city'>Woonplaats:</label>
                    <p>$customer[city]</p>
                </div>
            </div>
            <div class='customerdata-flex-row'>
                <label>E-mailadres:</label>
                <p>$customer[email]</p>
            </div>
            <div class='customerdata-flex-row'>
                <label>Telefoonnummer:</label>
                <p>$customer[phone]</p>
            </div>
            <div class='customerdata-flex-split'>
                <form method='POST' action='editCustomer.php'>
                    <input type='hidden' name='customerId' value='$customer[id]' />
                    <input type='submit' value='Klant bewerken' />
                </form>
                <form method='POST' action=''>
                    <input type='hidden' name='customerId' value='$car[customerid]'/>
                    <input type='submit' name='deleteCustomer' value='Klant verwijderen' />
                </form>
            </div>
        </div>";
        }
        ?>
        </div>
    </main>
</body>

</html>