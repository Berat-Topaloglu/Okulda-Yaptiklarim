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
    public partial class Bekleme : Form
    {
        public Bekleme()
        {
            InitializeComponent();
        }

        private void progressBar1_Click(object sender, EventArgs e)
        {

        }
        int süre = 0;
        private void timer1_Tick(object sender, EventArgs e)
        {
            if(progressBar1.Value<100)
            {
                progressBar1.Value += 2;
            }
            else if(progressBar1.Value>=100)
            {
                süre += 1;
                if(süre>=13)
                {
                Kütüphane kth = new Kütüphane();
                this.Hide();
                kth.Show();
                timer1.Enabled = false;
                }
               
            }
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }
    }
}
