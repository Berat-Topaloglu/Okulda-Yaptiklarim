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
    public partial class Ayarlar : Form
    {
        public Ayarlar()
        {
            InitializeComponent();
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
