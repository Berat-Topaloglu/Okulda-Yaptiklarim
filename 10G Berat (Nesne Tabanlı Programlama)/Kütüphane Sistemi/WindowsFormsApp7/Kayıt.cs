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
    
    public partial class Kayıt : Form
    {
        public Kayıt()
        {
            InitializeComponent();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            Main Main = new Main();
            this.Hide();
            Main.Show();
        }

        private void textBox2_TextChanged(object sender, EventArgs e)
        {
           
            
        }

        private void textBox2_Enter(object sender, EventArgs e)
        {
            textBox2.Clear();
            checkBox1.Enabled = true;
            
        }

        private void textBox1_Enter(object sender, EventArgs e)
        {
            textBox1.Clear();
        }
       private void checkBox1_CheckedChanged(object sender, EventArgs e)
        {
            
        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            if (checkBox1.Checked == true && textBox2.Text != "Şifre")
            {
                checkBox1.Text = "Şifreyi Gizle";
                textBox2.UseSystemPasswordChar = false;
            }
            else if(checkBox1.Checked == false && textBox2.Text != "Şifre")
            {
                textBox2.UseSystemPasswordChar = true;
                checkBox1.Text = "Şifreyi Göster";
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {

        }

        private void textBox1_TextChanged(object sender, EventArgs e)
        {

        }

        private void pictureBox2_Click(object sender, EventArgs e)
        {

        }

        private void pictureBox3_Click(object sender, EventArgs e)
        {

        }

        private void pictureBox1_Click(object sender, EventArgs e)
        {

        }
    }
}
