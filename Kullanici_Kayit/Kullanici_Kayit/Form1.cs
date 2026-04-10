using Kullanici_Kayit.Context;
using Kullanici_Kayit.Entity;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using static System.Windows.Forms.VisualStyles.VisualStyleElement;

namespace Kullanici_Kayit
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }
        Form2 form2 = new Form2();
        Random rnd = new Random();
        int sayac;
        private void button1_Click_1(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox1.Text) && (!string.IsNullOrEmpty(textBox2.Text)))
            {
                using (var context = new HesapContext())
                {
                    string kullanici = (textBox1.Text);
                    string kullanici_sifre = (textBox2.Text);
                    var kullanici_bul = (from x in context.Hesap_Kayits
                                         where x.Kullanici_Adi == kullanici &&  x.Sifre == kullanici_sifre
                                         select x).SingleOrDefault();
                    if (kullanici_bul == null)
                    {
                        MessageBox.Show("Kullanıcı kaydı bulunamadı!!");
                        sayac++;
                        return;
                    }
                    else
                    {
                        form2.ShowDialog();
                        this.Hide();
                    }
                }
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            for (int i = 0; i < sayac; i++)
            {
                MessageBox.Show(rnd.Next(0, 10000).ToString());
                textBox3.Visible = true;
                label4.Visible = true;
                button3.Visible = true;
            }
        }

        private void button3_Click(object sender, EventArgs e)
        {
            if (textBox3.Text == rnd.Next().ToString())
            {
                MessageBox.Show("Girilen kod başarılı...");
                form2.ShowDialog();
                this.Hide();
            }
            else
            {
                MessageBox.Show("Girilen kod hatalıdır tekrar deneyin...");
                MessageBox.Show(rnd.Next(0, 10000).ToString());
            }
        }
    }
}
