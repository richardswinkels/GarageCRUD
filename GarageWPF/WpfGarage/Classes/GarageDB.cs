using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data;
using MySql.Data.MySqlClient;

namespace WpfGarage.Classes
{
    class GarageDB
    {
        //Maak nieuwe connectie
        MySqlConnection _connection = new MySqlConnection("Server = localhost;Database=garage;Uid=root;Pwd=;");

        public void CreateCar(string brand, string model, string constructionYear, string registration, string customerId)
        {
            try
            {
                //Open connectie
                _connection.Open();
                //Maak nieuwe command
                MySqlCommand command = _connection.CreateCommand();
                //Vul command met query
                command.CommandText = "INSERT INTO `car` (`id`, `brand`, `model`, `construction_year`, `registration`, `customerid`) VALUES (NULL, @brand, @model, @constructionYear, @registration, @customerId);";
                //Koppel parameters in de query aan de variabelen
                command.Parameters.AddWithValue("@brand", brand);
                command.Parameters.AddWithValue("@model", model);
                command.Parameters.AddWithValue("@constructionYear", constructionYear);
                command.Parameters.AddWithValue("@registration", registration);
                command.Parameters.AddWithValue("@customerId", customerId);
                //Voer command uit
                command.ExecuteNonQuery();
            }
            catch (Exception)
            {

            }
            finally
            {
                //Sluit connectie
                _connection.Close();
            }
        }

        public void CreateCustomer(string firstname, string lastname, string address, string postalcode, string city, string email, string phone)
        {
            try
            {
                //Open connectie
                _connection.Open();
                //Maak nieuwe command
                MySqlCommand command = _connection.CreateCommand();
                //Vul command met query
                command.CommandText = "INSERT INTO `customer` (`id`, `firstname`, `lastname`, `address`, `postalcode`, `city`, `email`, `phone`) VALUES (NULL, @firstname, @lastname, @address, @postalcode, @city, @email, @phone);";
                //Koppel parameters in de query aan de variabelen
                command.Parameters.AddWithValue("@firstname", firstname);
                command.Parameters.AddWithValue("@lastname", lastname);
                command.Parameters.AddWithValue("@address", address);
                command.Parameters.AddWithValue("@postalcode", postalcode);
                command.Parameters.AddWithValue("@city", city);
                command.Parameters.AddWithValue("@email", email);
                command.Parameters.AddWithValue("@phone", phone);
                //Voer command uit
                command.ExecuteNonQuery();
            }
            catch (Exception)
            {

            }
            finally
            {
                //Sluit connectie
                _connection.Close();
            }
        }

        public DataTable SelectCars()
        {
            DataTable table = new DataTable();
            try
            {
                //Open connectie
                _connection.Open();
                //Maak nieuwe command
                MySqlCommand command = _connection.CreateCommand();
                //Vul command met query
                command.CommandText = "SELECT * FROM car";
                MySqlDataReader reader = command.ExecuteReader();
                table.Load(reader);
            }
            catch (Exception)
            {

            }
            finally
            {
                //Open connectie
                _connection.Close();
            }
            return table;
        }

        public DataTable SelectCustomerCars(string customerId)
        {
            DataTable table = new DataTable();
            try
            {
                //Open connectie
                _connection.Open();
                //Maak nieuwe command
                MySqlCommand command = _connection.CreateCommand();
                //Vul command met query
                command.CommandText = "SELECT * FROM car WHERE customerid = @customerId";
                //Koppel parameters in de query aan de variabelen
                command.Parameters.AddWithValue("@customerId", customerId);
                MySqlDataReader reader = command.ExecuteReader();
                table.Load(reader);
            }
            catch (Exception)
            {

            }
            finally
            {
                //Sluit connectie
                _connection.Close();
            }
            return table;
        }

        public DataTable SelectCustomerData(string customerId)
        {
            DataTable table = new DataTable();
            try
            {
                //Open connectie
                _connection.Open();
                //Maak nieuwe command
                MySqlCommand command = _connection.CreateCommand();
                //Vul command met query
                command.CommandText = "SELECT * FROM customer WHERE id = @customerId;";
                //Koppel parameters in de query aan de variabelen
                command.Parameters.AddWithValue("@customerId", customerId);
                MySqlDataReader reader = command.ExecuteReader();
                table.Load(reader);
            }
            catch (Exception)
            {

            }
            finally
            {
                //Sluit connectie
                _connection.Close();
            }
            return table;
        }

        public DataTable SelectCustomers()
        {
            DataTable table = new DataTable();

            try
            {
                //Open connectie
                _connection.Open();
                //Maak nieuwe command
                MySqlCommand command = _connection.CreateCommand();
                //Vul command met query
                command.CommandText = "SELECT * FROM customer;";
                MySqlDataReader reader = command.ExecuteReader();
                table.Load(reader);
            }
            catch (Exception)
            {

            }
            finally
            {
                //Sluit connectie
                _connection.Close();
            }
            return table;
        }
        
        public void EditCar(string carId, string brand, string model, string constructionYear, string registration, string customerId)
        {
            try
            {
                //Open connectie
                _connection.Open();
                //Maak nieuwe command
                MySqlCommand command = _connection.CreateCommand();
                //Vul command met query
                command.CommandText = "UPDATE `car` SET `brand` = @brand, `model` = @model, `construction_year` = @constructionYear, `registration` = @registration, `customerid` = @customerId WHERE `car`.`id` = @carId";
                //Koppel parameters in de query aan de variabelen
                command.Parameters.AddWithValue("@carId", carId);
                command.Parameters.AddWithValue("@brand", brand);
                command.Parameters.AddWithValue("@model", model);
                command.Parameters.AddWithValue("@constructionYear", constructionYear);
                command.Parameters.AddWithValue("@registration", registration);
                command.Parameters.AddWithValue("@customerid", customerId);
                //Voer command uit
                command.ExecuteNonQuery();
            }
            catch
            {

            }
            finally
            {
                //Sluit connectie
                _connection.Close();
            }
        }

        public void EditCustomer(string customerId, string firstname, string lastname, string address, string postalcode, string city, string email, string phone)
        {
            try
            {
                //Open connectie
                _connection.Open();
                //Maak nieuwe command
                MySqlCommand command = _connection.CreateCommand();
                //Vul command met query
                command.CommandText = "UPDATE `customer` SET `firstname` = @firstname, `lastname` = @lastname, `address` = @address, `postalcode` = @postalcode, `city` = @city, `email` = @email, `phone` = @phone WHERE `customer`.`id` = @customerId";
                //Koppel parameters in de query aan de variabelen
                command.Parameters.AddWithValue("@customerId", customerId);
                command.Parameters.AddWithValue("@firstname", firstname);
                command.Parameters.AddWithValue("@lastname", lastname);
                command.Parameters.AddWithValue("@address", address);
                command.Parameters.AddWithValue("@postalcode", postalcode);
                command.Parameters.AddWithValue("@city", city);
                command.Parameters.AddWithValue("@email", email);
                command.Parameters.AddWithValue("@phone", phone);
                //Voer command uit
                command.ExecuteNonQuery();
            }
            catch (Exception)
            {

            }
            finally
            {
                //Sluit connectie
                _connection.Close();
            }
        }

        public void DeleteCarCustomer(string customerId)
        {
            try
            {
                //Open connectie
                _connection.Open();
                //Maak nieuwe command
                MySqlCommand command = _connection.CreateCommand();
                //Vul command met query
                command.CommandText = "DELETE FROM car WHERE car . customerid = @customerId; DELETE FROM customer WHERE customer . id = @customerId;";
                //Koppel parameters in de query aan de variabelen
                command.Parameters.AddWithValue("@customerId", customerId);
                //Voer command uit
                command.ExecuteNonQuery();
            }
            catch (Exception)
            {

            }
            finally
            {
                //Sluit connectie
                _connection.Close();
            }
        }

        public void DeleteCar(string carId)
        {
            try
            {
                //Open connectie
                _connection.Open();
                //Maak nieuwe command
                MySqlCommand command = _connection.CreateCommand();
                //Vul command met query
                command.CommandText = "DELETE FROM car WHERE car . id = @carId;";
                //Koppel parameters in de query aan de variabelen
                command.Parameters.AddWithValue("@carId", carId);
                //Voer command uit
                command.ExecuteNonQuery();
            }
            catch (Exception)
            {

            }
            finally
            {
                //Sluit connectie
                _connection.Close();
            }
        }

        public void DeleteCustomerCars(string customerId)
        {
            try
            {
                //Open connectie
                _connection.Open();
                //Maak nieuwe command
                MySqlCommand command = _connection.CreateCommand();
                //Vul command met query
                command.CommandText = "DELETE FROM car WHERE car . customerid = @customerId; DELETE FROM customer WHERE customer . id = @customerId;";
                //Koppel parameters in de query aan de variabelen
                command.Parameters.AddWithValue("@customerId", customerId);
                //Voer command uit
                command.ExecuteNonQuery();
            }
            catch (Exception)
            {

            }
            finally
            {
                //Sluit connectie
                _connection.Close();
            }
        }
    }
}

