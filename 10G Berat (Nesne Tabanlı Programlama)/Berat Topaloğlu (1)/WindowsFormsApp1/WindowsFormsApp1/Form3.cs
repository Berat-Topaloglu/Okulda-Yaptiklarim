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
    public partial class Form3 : Form
    {
        public Form3()
        {
            InitializeComponent();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            Form1 form = new Form1();
            form.Show();
            this.Hide();
        }
        Çalışan hesaplama = new Çalışan();
        private void button1_Click(object sender, EventArgs e)
        {
            textBox4.Enabled = false;
            hesaplama.yasi = textBox1.Text;
            hesaplama.calısma_saati = int.Parse(textBox2.Text);
            hesaplama.fazla_mesai=int.Parse(textBox3.Text);
            int ucret=hesaplama.hesapla(yasi,calısma_saati,fazla_mesai);
        }

        private void button2_Click(object sender, EventArgs e)
        {
            textBox1.Clear();
            textBox2.Clear();
            textBox3.Clear();
            textBox4.Clear();
            textBox1.Focus();
        }

        private void Form3_Load(object sender, EventArgs e)
        {
            
        }
    }
}
