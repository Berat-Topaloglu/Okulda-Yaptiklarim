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
    }
}
