using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Sınav
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            switch(comboBox1.Text)
            {
                case "Giriş Birimi":
                    listBox1.Items.Add("Klavye " + "Mouse " + " Mikrofon");
                    break;
                case "Çıkış Birimi":
                    listBox1.Items.Add("Monitör "+" Hoparlör");
                    break;
                case "Hem giriş,hem çıkış birimi":
                    listBox1.Items.Add("USB bellek "+" Hardisk");
                    break;
                default:
                    MessageBox.Show("Lütfen seçim yapınız!!");
                    break;
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            double sayi1=double.Parse(textBox1.Text);
            double sayi2=double.Parse(textBox2.Text);
            double perf=double.Parse(textBox3.Text);
            double ort;
            ort = (sayi1 + sayi2 + perf) / 3;
            if (ort <50)
            {
                label5.Text=("Ne yazık ki KALDINIZ!!");
                label5.ForeColor = Color.Red;
            }
            else
            {
                label5.Text = ("Tebrikler Geçtiniz.");
                label5.ForeColor = Color.Green;
            }

        }

        private void button3_Click(object sender, EventArgs e)
        {
            int hava_kalitesi=int.Parse(textBox4.Text);
            if (hava_kalitesi<=50)
            {
                MessageBox.Show("İyi");
            }
            else if (hava_kalitesi<=100)
            {
                MessageBox.Show("Orta");
            }
            else if (hava_kalitesi <= 150)
            {
                MessageBox.Show("Hassas");
            }
            else if (hava_kalitesi <= 200)
            {
                MessageBox.Show("Sağlıksız");
            }
            else if (hava_kalitesi <= 300)
            {
                MessageBox.Show("Kötü");
            }
            else
            {
                MessageBox.Show("Tehlikeli!!");
            }
        }

        private void button4_Click(object sender, EventArgs e)
        {
            string ad_soyad = textBox5.Text;
            for (int i = 1; i <=10; i++)
            {
                listBox2.Items.Add("Hoş geldin" + ad_soyad);
            }
        }
    }
}
