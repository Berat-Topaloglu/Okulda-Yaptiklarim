using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WindowsFormsApp7
{
    public partial class Ödünç_Kitap_Verme : Form
    {
        public Ödünç_Kitap_Verme()
        {
            InitializeComponent();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            comboBox2.Text = "";
            comboBox4.Text = "";
            comboBox5.Text = "";
            dateTimePicker1.Text = "";
            textBox1.Clear();
            textBox2.Clear();
            textBox3.Clear();
            textBox4.Clear();
        }

        private void pictureBox2_Click(object sender, EventArgs e)
        {
            comboBox2.Text = "";
            comboBox4.Text = "";
            comboBox5.Text = "";
            dateTimePicker1.Text = "";
            textBox1.Clear();
            textBox2.Clear();
            textBox3.Clear();
            textBox4.Clear();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            Kütüphane ktpn = new Kütüphane();
            this.Close();
            ktpn.Show();
        }

        private void pictureBox3_Click(object sender, EventArgs e)
        {
            Kütüphane ktpn = new Kütüphane();
            this.Close();
            ktpn.Show();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            Ödünçler Oduncler = new Ödünçler();
            this.Close();
            Oduncler.Show();
        }

        private void pictureBox4_Click(object sender, EventArgs e)
        {
            Ödünçler Oduncler = new Ödünçler();
            this.Close();
            Oduncler.Show();
        }
    }
}
