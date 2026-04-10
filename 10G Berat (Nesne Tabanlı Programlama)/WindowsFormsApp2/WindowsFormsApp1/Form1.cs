using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WindowsFormsApp1
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }
        List<Kayıt> ogrenciler = new List<Kayıt>();
        private void button1_Click(object sender, EventArgs e)
        {
            dataGridView1.DataSource = ogrenciler;
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            Kayıt kayit1 = new Kayıt();
            kayit1.no = 1330;
            kayit1.isim = "Berat";
            kayit1.soy_isim = "Topaloğlu";
            kayit1.sınıf = "10/G";
            kayit1.cinsiyet = "Erkek";
            kayit1.kitap = 6;
            kayit1.mat_not = 92;
            kayit1.ntp_not = 100;
            ogrenciler.Add(kayit1);

            Kayıt kayit2 = new Kayıt();
            kayit2.no = 2330;
            kayit2.isim = "Hüseyin";
            kayit2.soy_isim = "Kartal";
            kayit2.sınıf = "11/E";
            kayit2.cinsiyet = "Erkek";
            kayit2.kitap = 3;
            kayit2.mat_not = 20;
            kayit2.ntp_not = 80;
            ogrenciler.Add(kayit2);

            Kayıt kayit3 = new Kayıt();
            kayit3.no = 3330;
            kayit3.isim = "Fatih";
            kayit3.soy_isim = "Kaya";
            kayit3.sınıf = "10/E";
            kayit3.cinsiyet = "Erkek";
            kayit3.kitap = 4;
            kayit3.mat_not = 80;
            kayit3.ntp_not = 55;
            ogrenciler.Add(kayit3);

            Kayıt kayit4 = new Kayıt();
            kayit4.no = 3130;
            kayit4.isim = "Selami";
            kayit4.soy_isim = "Yılmaz";
            kayit4.sınıf = "9/G";
            kayit4.cinsiyet = "Erkek";
            kayit4.kitap = 5;
            kayit4.mat_not = 100;
            kayit4.ntp_not = 15;
            ogrenciler.Add(kayit4);

            Kayıt kayit5 = new Kayıt();
            kayit5.no = 2279;
            kayit5.isim = "Berat";
            kayit5.soy_isim = "Koca";
            kayit5.sınıf = "10/G";
            kayit5.cinsiyet = "Erkek";
            kayit5.kitap = 9;
            kayit5.mat_not = 93;
            kayit5.ntp_not = 78;
            ogrenciler.Add(kayit5);
        }
    }
}
