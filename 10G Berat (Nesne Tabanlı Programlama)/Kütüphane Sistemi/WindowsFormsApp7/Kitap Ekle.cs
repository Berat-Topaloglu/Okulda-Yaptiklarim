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
    public partial class Kitap_Ekle : Form
    {
        public Kitap_Ekle()
        {
            InitializeComponent();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            textBox1.Clear();
            textBox2.Clear();
            comboBox3.Text = "";
            textBox4.Clear();
            textBox7.Clear();
            textBox8.Clear();
            comboBox1.Text = "";
            comboBox2.Text = "";
            dateTimePicker2.Text = "";
        }

        private void pictureBox2_Click(object sender, EventArgs e)
        {
            textBox1.Clear();
            textBox2.Clear();
            comboBox3.Text = "";
            textBox4.Clear();
            textBox7.Clear();
            textBox8.Clear();
            comboBox1.Text = "";
            comboBox2.Text = "";
            dateTimePicker2.Text = "";
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
            Kitap_Sorgulama KitapSorgu = new Kitap_Sorgulama();
            this.Close();
            KitapSorgu.Show();
        }

        private void pictureBox4_Click(object sender, EventArgs e)
        {
            Kitap_Sorgulama KitapSorgu = new Kitap_Sorgulama();
            this.Close();
            KitapSorgu.Show();
        }
    }
}
