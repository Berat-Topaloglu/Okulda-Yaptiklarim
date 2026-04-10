using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WindowsFormsApp2
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }
        
        private void Form1_Load(object sender, EventArgs e)
        {
            
        }
        List<Kayıt> ogrenciler = new List<Kayıt>();
        private void button1_Click(object sender, EventArgs e)
        {
            Kayıt kayit1 = new Kayıt();
            kayit1.no = int.Parse(textBox1.Text);
            kayit1.isim = textBox2.Text;
            kayit1.soy_isim = textBox3.Text;
            kayit1.sınıf = textBox4.Text;
            kayit1.cinsiyet = comboBox1.Text;
            kayit1.mat_not = int.Parse(textBox6.Text);
            kayit1.ntp_not = int.Parse(textBox7.Text);
            ogrenciler.Add(kayit1);
            textBox1.Clear();
            textBox2.Clear();
            textBox3.Clear();
            textBox4.Clear();
            textBox6.Clear();
            textBox7.Clear();
            textBox1.Focus();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            dataGridView1.DataSource = ogrenciler;
        }
    }
}
