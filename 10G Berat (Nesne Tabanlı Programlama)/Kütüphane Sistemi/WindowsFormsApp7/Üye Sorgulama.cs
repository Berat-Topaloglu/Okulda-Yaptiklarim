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
    public partial class Üye_Sorgulama : Form
    {
        public Üye_Sorgulama()
        {
            InitializeComponent();
        }

        private void pictureBox2_Click(object sender, EventArgs e)
        {

        }

        private void button2_Click(object sender, EventArgs e)
        {

        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            label2.Text = "Tarih " + DateTime.Now.ToString();
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
    }
}
