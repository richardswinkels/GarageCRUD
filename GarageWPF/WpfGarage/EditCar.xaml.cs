using System;
using System.Collections.Generic;
using System.Data;
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
using System.Windows.Shapes;
using WpfGarage.Classes;

namespace WpfGarage
{
    /// <summary>
    /// Interaction logic for EditCar.xaml
    /// </summary>
    public partial class EditCar : Window
    {
        //Maak nieuwe instance van klasse GarageDB
        GarageDB _garageDB = new GarageDB();

        public EditCar(DataRowView car)
        {
            InitializeComponent();

            //Vul velden met autogegevens
            tbCarId.Text = car["id"].ToString();
            txbBrand.Text = car["brand"].ToString();
            txbModel.Text = car["model"].ToString();
            txbConstructionYear.Text = car["construction_year"].ToString();
            txbRegistration.Text = car["registration"].ToString();
            cmbCustomers.SelectedValue = car["customerid"].ToString();

            //Vul combobox met gegevens
            PopulateCombobox();
        }

        private void BtnEditCar_Click(object sender, RoutedEventArgs e)
        {
            //Bewerk auto
            _garageDB.EditCar(tbCarId.Text, txbBrand.Text, txbModel.Text, txbConstructionYear.Text, txbRegistration.Text, cmbCustomers.SelectedValue.ToString());
            //Sluit huidige window
            this.Close();
        }

        private void BtnAddCustomer_Click(object sender, RoutedEventArgs e)
        {
            //Maak nieuwe instance van klasse CreateCustomer
            CreateCustomer _createCustomer = new CreateCustomer();
            //Laat nieuwe klant window zien
            _createCustomer.ShowDialog();
            //Vul combobox met gegevens
            PopulateCombobox();
        }

        private void PopulateCombobox()
        {
            //Haal alle klanten op
            DataTable customers = _garageDB.SelectCustomers();
            //Vul de combobox met klanten
            cmbCustomers.ItemsSource = customers.DefaultView;
        }
    }
}
