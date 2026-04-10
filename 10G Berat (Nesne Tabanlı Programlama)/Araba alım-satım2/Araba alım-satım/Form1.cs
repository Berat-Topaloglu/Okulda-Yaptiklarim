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
        List<Araba> araba_olustur = new List<Araba>();
        Araba araba1 = new Araba();
        private void button1_Click(object sender, EventArgs e)
        {   
            araba1.marka = textBox1.Text;
            araba1.model = textBox2.Text;
            araba1.renk = textBox3.Text;
            araba1.vites_sayısı = textBox4.Text;
            araba1.vites_durumu = textBox5.Text;
            araba1.yakıt_türü = textBox6.Text;
            araba1.km = int.Parse(textBox7.Text);
            araba1.fiyat = int.Parse(textBox8.Text);
            araba_olustur.Add(araba1);
            MessageBox.Show("Araba oluşturuldu.");
        }

        private void button2_Click(object sender, EventArgs e)
        {
            dataGridView1.DataSource = araba_olustur;
        }

        private void button3_Click(object sender, EventArgs e)
        {
            int ilerleme = int.Parse(textBox8.Text);
            araba1.ileri_git(ilerleme);
        }

        private void button4_Click(object sender, EventArgs e)
        {
            int artan;
            if (radioButton1.Checked==true)
            {
                artan = 5;
                araba1.fiyat_arttır(artan);
            }
            else if (radioButton2.Checked == true)
            {
                artan = 10;
                araba1.fiyat_arttır(artan);
            }
            else if (radioButton3.Checked == true)
            {
                artan = 25;
                araba1.fiyat_arttır(artan);
            }
            else
            {
                artan = 50;
                araba1.fiyat_arttır(artan);
            }
        }

        private void button5_Click(object sender, EventArgs e)
        {
            araba1.satış();
        }
    }
}
