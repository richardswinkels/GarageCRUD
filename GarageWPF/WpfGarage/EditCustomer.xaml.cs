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
    /// Interaction logic for EditCustomer.xaml
    /// </summary>
    public partial class EditCustomer : Window
    {
        //Maak nieuwe instance van klasse GarageDB
        GarageDB _garageDB = new GarageDB();

        public EditCustomer(DataRow customer)
        {
            InitializeComponent();

            //Vul velden met klantgegevens
            tbCustomerIdData.Text = customer["id"].ToString();
            txbFirstname.Text = customer["firstname"].ToString();
            txbLastname.Text = customer["lastname"].ToString();
            txbAddress.Text = customer["address"].ToString();
            txbPostalcode.Text = customer["postalcode"].ToString();
            txbCity.Text = customer["city"].ToString();
            txbEmail.Text = customer["email"].ToString();
            txbPhone.Text = customer["phone"].ToString();
        }

        private void BtnEditCustomer_Click(object sender, RoutedEventArgs e)
        {
            //Bewerk klant 
            _garageDB.EditCustomer(tbCustomerIdData.Text, txbFirstname.Text, txbLastname.Text, txbAddress.Text, txbPostalcode.Text, txbCity.Text, txbEmail.Text, txbPhone.Text);
            //Sluit huidige window
            this.Close();
        }
    }
}
