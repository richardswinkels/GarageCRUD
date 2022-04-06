using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using System.Data;
using MySql.Data.MySqlClient;
using WpfGarage.Classes;

namespace WpfGarage
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        //Maak nieuwe instance van klasse GarageDB
        GarageDB _garageDB = new GarageDB();

        public MainWindow()
        {
            InitializeComponent();
            FillDataGrid();
        }

        private void FillDataGrid()
        {
            //Haal auto's op
            DataTable cars = _garageDB.SelectCars();
            //Als cars niet null is
            if (cars != null)
            {
                //Zorg dat de datagrid gevuld wordt met auto's
                dgCars.ItemsSource = cars.DefaultView;
            }
        }

        private void ResetCustomerData()
        {
            tbCustomerId.Visibility = Visibility.Hidden;
            tbFirstname.Visibility = Visibility.Hidden;
            tbLastname.Visibility = Visibility.Hidden;
            tbAdres.Visibility = Visibility.Hidden;
            tbPostalcode.Visibility = Visibility.Hidden;
            tbCity.Visibility = Visibility.Hidden;
            tbEmail.Visibility = Visibility.Hidden;
            tbPhone.Visibility = Visibility.Hidden;

            tbCustomerIdData.Text = "";
            tbFirstnameData.Text = "";
            tbLastnameData.Text = "";
            tbAdresData.Text = "";
            tbPostalcodeData.Text = "";
            tbCityData.Text = "";
            tbEmailData.Text = "";
            tbPhoneData.Text = "";
        }

        private void BtnDeleteCar_Click(object sender, RoutedEventArgs e)
        {
            //Haal geselecteerde rij op
            DataRowView selectedRow = dgCars.SelectedItem as DataRowView;
            //Haal alle auto's op van huidige klant
            DataTable customerCars = _garageDB.SelectCustomerCars(selectedRow["customerid"].ToString());

            //Als klant één auto heeft
            if (customerCars.Rows.Count == 1)
            {
                //Verwijder zowel de auto als klant
                _garageDB.DeleteCarCustomer(selectedRow["customerid"].ToString());
                ResetCustomerData();
                FillDataGrid();
            }
            else
            {
                //Verwijder huidige auto
                _garageDB.DeleteCar(selectedRow["id"].ToString());
                ResetCustomerData();
                FillDataGrid();
            }
        }

        private void DgCars_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            //Als geselecteerde item niet null is (auto geselecteerd)
            if (dgCars.SelectedItem != null)
            {
                //Haal geselecteerde rij op
                DataRowView selectedRow = dgCars.SelectedItem as DataRowView;
                //Haal de klantgegevens op van de eigenaar van de geselecteerde auto
                DataTable customerData = _garageDB.SelectCustomerData(selectedRow["customerid"].ToString());
                //Maak nieuwe DataRow met daarin de eerste rij van customerData
                DataRow customerDataRow = customerData.Rows[0];

                //Maak velden zichtbaar
                tbCustomerId.Visibility = Visibility.Visible;
                tbFirstname.Visibility = Visibility.Visible;
                tbLastname.Visibility = Visibility.Visible;
                tbAdres.Visibility = Visibility.Visible;
                tbPostalcode.Visibility = Visibility.Visible;
                tbCity.Visibility = Visibility.Visible;
                tbEmail.Visibility = Visibility.Visible;
                tbPhone.Visibility = Visibility.Visible;

                //Vul de velden
                tbCustomerIdData.Text = customerDataRow["id"].ToString();
                tbFirstnameData.Text = customerDataRow["firstname"].ToString();
                tbLastnameData.Text = customerDataRow["lastname"].ToString();
                tbAdresData.Text = customerDataRow["address"].ToString();
                tbPostalcodeData.Text = customerDataRow["postalcode"].ToString();
                tbCityData.Text = customerDataRow["city"].ToString();
                tbEmailData.Text = customerDataRow["email"].ToString();
                tbPhoneData.Text = customerDataRow["phone"].ToString();
            }
        }

        private void BtnDeleteCustomer_Click(object sender, RoutedEventArgs e)
        {
            //Haal huidige geselecteerde rij op
            DataRowView selectedRow = dgCars.SelectedItem as DataRowView;

            //Verwijder huidige klant en al zijn auto's
            _garageDB.DeleteCustomerCars(selectedRow["customerid"].ToString());
            ResetCustomerData();
            FillDataGrid();
        }

        private void BtnEditCustomer_Click(object sender, RoutedEventArgs e)
        {
            //Haal index van geselecteerde rij op
            int selectedRowIndex = dgCars.SelectedIndex;
            //Haal klantgegevens op van huidige klant
            DataTable customerData = _garageDB.SelectCustomerData(tbCustomerIdData.Text);

            try
            {
                //Maak nieuwe DataRow met daarin de eerste rij van customerData
                DataRow customerDataRow = customerData.Rows[0];

                //Maak nieuwe instance van klasse EditCustomer en stuur klantgegevens mee als parameter 
                EditCustomer editCustomer = new EditCustomer(customerDataRow);
                //Laat bewerk klant window zien
                editCustomer.ShowDialog();
            }
            catch (Exception)
            {
                MessageBox.Show("Geen klant om te bewerken!", "Foutmelding", MessageBoxButton.OK, MessageBoxImage.Error);
            }

            FillDataGrid();

            //Focus op de DataGrid
            dgCars.Focus();
            //Zorg dat na bewerken dezelfde rij weer geselecteerd wordt
            dgCars.SelectedIndex = selectedRowIndex;
        }

        private void BtnEditCar_Click(object sender, RoutedEventArgs e)
        {
            //Haal op welke rij geselecteerd is
            int selectedRowIndex = dgCars.SelectedIndex;
            //Haal geselecteerde rij op
            DataRowView selectedRow = dgCars.SelectedItem as DataRowView;

            //Maak nieuwe instance van klasse EditCar en stuur klantgegevens mee als parameter 
            EditCar editCar = new EditCar(selectedRow);
            //Laat bewerk auto window zien
            editCar.ShowDialog();

            FillDataGrid();

            //Focus op de DataGrid
            dgCars.Focus();
            //Zorg dat na bewerken dezelfde rij weer geselecteerd wordt
            dgCars.SelectedIndex = selectedRowIndex;
        }

        private void BtnAddCar_Click(object sender, RoutedEventArgs e)
        {
            //Maak nieuwe instance van klasse CreateCar
            CreateCar createCar = new CreateCar();
            //Laat auto toevoegen window zien
            createCar.ShowDialog();
            FillDataGrid();
        }
    }
}
