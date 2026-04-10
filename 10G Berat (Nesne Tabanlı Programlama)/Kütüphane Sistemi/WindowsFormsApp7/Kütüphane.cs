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
    public partial class Kütüphane : Form
    {
        public Kütüphane()
        {
            InitializeComponent();
        }

        private void contextMenuStrip1_Opening(object sender, CancelEventArgs e)
        {

        }

        private void pictureBox1_Click(object sender, EventArgs e)
        {

        }

        private void pictureBox1_Click_1(object sender, EventArgs e)
        {
            Üye_Ekle ÜyeEkle = new Üye_Ekle();
            this.Close();
            ÜyeEkle.Show();
        }
        
        private void label8_Click(object sender, EventArgs e)
        {

        }
        
        private void Kütüphane_Load(object sender, EventArgs e)
        {
            
        }

        private void pictureBox2_Click(object sender, EventArgs e)
        {
            Kitap_Ekle KitapEkle = new Kitap_Ekle();
            this.Close();
            KitapEkle.Show();
        }

        private void pictureBox3_Click(object sender, EventArgs e)
        {
            Ödünç_Kitap_Verme Odunc = new Ödünç_Kitap_Verme();
            this.Close();
            Odunc.Show();
        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            label8.Text = "Tarih " + DateTime.Now.ToString();
        }

        private void pictureBox4_Click(object sender, EventArgs e)
        {
            Üye_Sorgulama UyeSorgu = new Üye_Sorgulama();
            this.Close();
            UyeSorgu.Show();
        }

        private void pictureBox6_Click(object sender, EventArgs e)
        {
            DialogResult dialogResult = MessageBox.Show("Çıkmak İstiyor Musunuz?", "Çıkış", MessageBoxButtons.YesNo);
            if (dialogResult == DialogResult.Yes)
            {
                this.Close();
            }
            else if (dialogResult == DialogResult.No)
            {

            }
        }

        private void pictureBox5_Click(object sender, EventArgs e)
        {
            Kitap_Sorgulama KitapSorgu = new Kitap_Sorgulama();
            this.Close();
            KitapSorgu.Show();
        }

        private void pictureBox7_Click(object sender, EventArgs e)
        {
            Ayarlar ayarlar = new Ayarlar();
            this.Close();
            ayarlar.Show();
        }
    }
}
