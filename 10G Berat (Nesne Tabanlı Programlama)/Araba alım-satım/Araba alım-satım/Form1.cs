using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Araba_alım_satım
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void comboBox1_SelectedIndexChanged(object sender, EventArgs e)
        {
            comboBox2.Items.Clear();
            int seçim = comboBox1.SelectedIndex;
            if (seçim==0)
            {
                comboBox2.Items.Add("A1");
                comboBox2.Items.Add("A2");
                comboBox2.Items.Add("A3");
            }
            else if (seçim == 1)
            {
                comboBox2.Items.Add("320i");
                comboBox2.Items.Add("520i");
                comboBox2.Items.Add("x3");
                comboBox2.Items.Add("x5");
            }
            else if (seçim == 2)
            {
                comboBox2.Items.Add("Tiggo 7 Pro");
                comboBox2.Items.Add("Tiggo 8 Pro");
                comboBox2.Items.Add("Tiggo 8 Pro Max");
                comboBox2.Items.Add("Exeed RX");
            }
            else if (seçim == 3)
            {
                comboBox2.Items.Add("Sandero 3 Stepway Texas");
                comboBox2.Items.Add("Sandero 4");
                comboBox2.Items.Add("Sandero Stepway");
            }
            else if (seçim == 4)
            {
                comboBox2.Items.Add("Doblo");
                comboBox2.Items.Add("Fiorino");
                comboBox2.Items.Add("Egea");
            }
            else
            {
                comboBox2.Items.Add("G-Class");
                comboBox2.Items.Add("Benz");
                comboBox2.Items.Add("Amg Gtr-4");
            }
        }
        Araba A1;
        private void button1_Click(object sender, EventArgs e)
        {
            string marka, model, renk, vites_sayısı, vites_durumu, yakıt_türü;
            int km, fiyat;
            marka = comboBox1.Text;
            model = comboBox2.Text;
            renk = comboBox3.Text;
            vites_sayısı = comboBox4.Text;
            vites_durumu = comboBox5.Text;
            yakıt_türü = comboBox6.Text;
            km = int.Parse(textBox1.Text);
            fiyat = int.Parse(textBox2.Text);
            A1 = new Araba(marka, model, renk, vites_sayısı, vites_durumu, yakıt_türü, km, fiyat);
            MessageBox.Show("Araba oluşturuldu.");
        }

        private void button2_Click(object sender, EventArgs e)
        {
            A1.bilgileri_göster();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            int ilerleme = int.Parse(textBox3.Text);
            A1.ileri_git(ilerleme);
        }

        private void button4_Click(object sender, EventArgs e)
        {
            int artan;
            if (radioButton1.Checked==true)
            {
                artan = 5;
                A1.fiyat_arttır(artan);
            }
            else if (radioButton2.Checked == true)
            {
                artan = 10;
                A1.fiyat_arttır(artan);
            }
            else if (radioButton3.Checked == true)
            {
                artan = 25;
                A1.fiyat_arttır(artan);
            }
            else
            {
                artan = 50;
                A1.fiyat_arttır(artan);
            }
        }

        private void button5_Click(object sender, EventArgs e)
        {
            A1.satış();
        }
    }
}
