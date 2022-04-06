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
using System.Windows.Shapes;
using WpfGarage.Classes;

namespace WpfGarage
{
    /// <summary>
    /// Interaction logic for CreateCustomer.xaml
    /// </summary>
    public partial class CreateCustomer : Window
    {
        //Maak nieuwe instance van klasse GarageDB
        GarageDB _garageDB = new GarageDB();

        public CreateCustomer()
        {
            InitializeComponent();
        }

        private void BtnCreateCustomer_Click(object sender, RoutedEventArgs e)
        {
            //Maak nieuwe klant
            _garageDB.CreateCustomer(txbFirstname.Text, txbLastname.Text, txbAddress.Text, txbPostalcode.Text, txbCity.Text, txbEmail.Text, txbPhone.Text);
            //Sluit huidige window
            this.Close();
        }
    }
}
