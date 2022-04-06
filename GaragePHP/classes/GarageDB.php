<?php
class GarageDB
{
    //Database adres en login credentials
    const DSN = "mysql:host=localhost;dbname=garage";
    const USER = "root";
    const PASSWD = "";

    function createCar($brand, $model, $constructionyear, $registration, $customerId)
    {
        try {
            //Maak nieuwe PDO
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            //Maak nieuwe SQL query
            $statement = $pdo->prepare("INSERT INTO `car` (`id`, `brand`, `model`, `construction_year`, `registration`, `customerid`) VALUES (NULL, :brand, :model, :constructionYear, :registration, :customerId);");

            //Koppel de parameters aan de variabelen
            $statement->bindValue(":brand", $brand, PDO::PARAM_STR);
            $statement->bindValue(":model", $model, PDO::PARAM_STR);
            $statement->bindValue(":constructionYear", $constructionyear, PDO::PARAM_INT);
            $statement->bindValue(":registration", $registration, PDO::PARAM_STR);
            $statement->bindValue(":customerId", $customerId, PDO::PARAM_INT);

            //Voer SQL query uit
            $statement->execute();

            //Geef true terug
            return true;
        } catch (PDOException $e) {
            //Geef false terug
            return false;
        }
    }

    function createCustomer($firstname, $lastname, $address, $postalcode, $city, $email, $phone)
    {
        try {
            //Maak nieuwe PDO
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            //Maak nieuwe SQL query
            $statement = $pdo->prepare("INSERT INTO `customer` (`id`, `firstname`, `lastname`, `address`, `postalcode`, `city`, `email`, `phone`) VALUES (NULL, :firstname, :lastname, :address, :postalcode, :city, :email, :phone);");

            //Koppel de parameters aan de variabelen
            $statement->bindValue(":firstname", $firstname, PDO::PARAM_STR);
            $statement->bindValue(":lastname", $lastname, PDO::PARAM_STR);
            $statement->bindValue(":address", $address, PDO::PARAM_STR);
            $statement->bindValue(":postalcode", $postalcode, PDO::PARAM_STR);
            $statement->bindValue(":city", $city, PDO::PARAM_STR);
            $statement->bindValue(":email", $email, PDO::PARAM_STR);
            $statement->bindValue(":phone", $phone, PDO::PARAM_STR);

            //Voer SQL query uit
            $statement->execute();

            //Geef true terug
            return true;
        } catch (PDOException $e) {
            //Geef false terug
            return false;
        }
    }

    function selectCar($carId)
    {
        try {
            //Maak nieuwe PDO
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            //Maak nieuwe SQL query
            $statement = $pdo->prepare("SELECT * FROM car WHERE id = :carId;");

            //Koppel de parameter aan de variabele
            $statement->bindValue(':carId', $carId, PDO::PARAM_INT);

            //Voer SQL query uit
            $statement->execute();

            //Zorg dat data als associative array in $rows komt te staan
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            //Geef eerste entry van de array terug
            return $rows[0];
        } catch (PDOException $e) {
            //Geef false terug
            return false;
        }
    }

    function selectCars()
    {
        try {
            //Maak nieuwe PDO
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            //Maak nieuwe SQL query
            $statement = $pdo->prepare("SELECT * FROM car;");

            //Voer SQL query uit
            $statement->execute();

            //Zorg dat data als associative array in $rows komt te staan
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            //Geef rows terug
            return $rows;
        } catch (PDOException $e) {
            //Geef false terug
            return false;
        }
    }

    function selectCustomer($customerId)
    {
        try {
            //Maak nieuwe PDO
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            //Maak nieuwe SQL query
            $statement = $pdo->prepare("SELECT * FROM customer WHERE id = :customerId;");

            //Koppel de parameter aan de variabele
            $statement->bindValue(':customerId', $customerId, PDO::PARAM_INT);

            //Voer SQL query uit
            $statement->execute();

            //Zorg dat data als associative array in $rows komt te staan
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            //Geef eerste entry van de array terug
            return $rows[0];
        } catch (PDOException $e) {
            //Geef false terug
            return false;
        }
    }

    function selectCustomers()
    {
        try {
            //Maak nieuwe PDO
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            //Maak nieuwe SQL query
            $statement = $pdo->prepare("SELECT * FROM customer;");

            //Voer SQL query uit
            $statement->execute();

            //Zorg dat data als associative array in $rows komt te staan
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            //Geef rows terug
            return $rows;
        } catch (PDOException $e) {
            //Geef false terug
            return false;
        }
    }

    function selectCarCustomer($customerId)
    {
        try {
            //Maak nieuwe PDO
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            //Maak nieuwe SQL query
            $statement = $pdo->prepare("SELECT * FROM car WHERE customerid = :customerId;");

            //Koppel parameters aan variabelen
            $statement->bindValue(':customerId', $customerId, PDO::PARAM_INT);

            //Voer SQL query uit
            $statement->execute();

            //Zorg dat data als associative array in $rows komt te staan
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            //Geef rows terug
            return $rows;
        } catch (PDOException $e) {
            //Geef false terug
            return false;
        }
    }

    function updateCar($carId, $brand, $model, $constructionyear, $registration, $customerId)
    {
        try {
            //Maak nieuwe PDO
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            //Maak nieuwe SQL query
            $statement = $pdo->prepare("UPDATE `car` SET `brand` = :brand, `model` = :model, `construction_year` = :constructionYear, `registration` = :registration, `customerid` = :customerId WHERE `car`.`id` = :carId;");

            //Koppel parameters aan variabelen
            $statement->bindValue(":carId", $carId, PDO::PARAM_INT);
            $statement->bindValue(":brand", $brand, PDO::PARAM_STR);
            $statement->bindValue(":model", $model, PDO::PARAM_STR);
            $statement->bindValue(":constructionYear", $constructionyear, PDO::PARAM_INT);
            $statement->bindValue(":registration", $registration, PDO::PARAM_STR);
            $statement->bindValue(":customerId", $customerId, PDO::PARAM_INT);

            //Voer SQL statement uit
            $statement->execute();

            //Geef true terug
            return true;
        } catch (PDOException $e) {
            //Geef false terug
            return false;
        }
    }

    function updateCustomer($customerId, $firstname, $lastname, $address, $postalcode, $city, $email, $phone)
    {
        try {
            //maak nieuwe PDO
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            //Maak nieuwe SQL query
            $statement = $pdo->prepare("UPDATE `customer` SET `firstname` = :firstname, `lastname` = :lastname, `address` = :address, `postalcode` = :postalcode, `city` = :city, `email` = :email, `phone` = :phone WHERE `customer`.`id` = :customerId;");

            //Koppel parameters aan variabelen
            $statement->bindValue(":customerId", $customerId, PDO::PARAM_INT);
            $statement->bindValue(":firstname", $firstname, PDO::PARAM_STR);
            $statement->bindValue(":lastname", $lastname, PDO::PARAM_STR);
            $statement->bindValue(":address", $address, PDO::PARAM_STR);
            $statement->bindValue(":postalcode", $postalcode, PDO::PARAM_STR);
            $statement->bindValue(":city", $city, PDO::PARAM_STR);
            $statement->bindValue(":email", $email, PDO::PARAM_STR);
            $statement->bindValue(":phone", $phone, PDO::PARAM_STR);

            //Voer SQL query uit
            $statement->execute();

            //Geef true terug
            return true;
        } catch (PDOException $e) {
            //Geef false terug
            return false;
        }
    }

    function deleteCar($carId)
    {
        try {
            //maak nieuwe PDO
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            //Maak nieuwe SQL query
            $statement = $pdo->prepare("DELETE FROM `car` WHERE `car`.`id` = :carId;");

            //Koppel parameter aan variabele
            $statement->bindValue(":carId", $carId, PDO::PARAM_INT);

            //Voer SQL statement uit
            $statement->execute();

            //Geef true terug
            return true;
        } catch (PDOException $e) {
            //Geef false terug
            return false;
        }
    }

    function deleteCustomerCars($customerId)
    {
        try {
            //Maak nieuwe PDO
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            //Maak nieuwe SQL query
            $statement = $pdo->prepare("DELETE FROM car WHERE car . customerid = :customerId; DELETE FROM customer WHERE customer . id = :customerId;");

            //Koppel parameter aan variabele
            $statement->bindValue(":customerId", $customerId, PDO::PARAM_INT);

            //Voer SQL query uit
            $statement->execute();

            //Geef true terug
            return true;
        } catch (PDOException $e) {
            //Geef false terug
            return false;
        }
    }
}
