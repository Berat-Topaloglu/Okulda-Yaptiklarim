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
    public partial class Form2 : Form
    {
        public Form2()
        {
            InitializeComponent();
        }
        int sayac, x, y, z;

        private void timer1_Tick(object sender, EventArgs e)
        {
            Random rnd = new Random();
            x = rnd.Next(255);
            y = rnd.Next(255);
            z = rnd.Next(255);
            this.BackColor = Color.FromArgb(x, y, z);
            sayac++;
            label1.Text = sayac.ToString();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            sayac = 0;
        }

        private void button1_Click(object sender, EventArgs e)
        {
            timer1.Start();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            timer1.Stop();
        }
    }
}
