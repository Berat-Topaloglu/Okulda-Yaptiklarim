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
        int sayac, kod;
        public void listele2()
        {
            using (var context = new HesapContext())
            {
                 dataGridView1.DataSource = context.Hesap_Kayits.ToList();
            }
        }
        private void button1_Click_1(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox1.Text) && (!string.IsNullOrEmpty(textBox2.Text)))
            {
                using (var context = new HesapContext())
                {
                    string kullanici = (textBox1.Text);
                    string kullanici_sifre = (textBox2.Text);
                    var kullanici_bul = (from x in context.Hesap_Kayits
                                         where x.Kullanici_Adi == kullanici && x.Sifre == kullanici_sifre
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
            kod = rnd.Next(0, 10000);
            for (int i = 0; i < sayac; i++)
            {
                MessageBox.Show(kod.ToString());
                textBox3.Visible = true;
                label4.Visible = true;
                button3.Visible = true;
            }
        }

        private void button3_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox3.Text))
            {
                if (textBox3.Text == kod.ToString())
                {
                    MessageBox.Show("Girilen kod başarılı...");
                    label5.Text = "Yeni Şifre";
                    label4.Text = "Kullanıcı ID:";
                    textBox5.Visible = true;
                    dataGridView1.Visible = true;
                    listele2();
                    textBox3.Clear();
                }
                else if (textBox3.Text == null)
                {
                    MessageBox.Show("Lütfen tekrar deneyin...");
                    MessageBox.Show(rnd.Next(0, 10000).ToString());
                }
                else
                {
                    using (var context = new HesapContext())
                    {
                        int kullanici_ID = int.Parse(textBox3.Text);
                        var kullanici_bul = (from x in context.Hesap_Kayits
                                             where x.ID == kullanici_ID
                                             select x).SingleOrDefault();
                        if (kullanici_bul == null)
                        {
                            MessageBox.Show("Kullanıcı kaydı bulunamadı!!");
                            return;
                        }
                        else
                        {
                            kullanici_bul.Sifre = textBox5.Text;
                            context.SaveChanges();
                            MessageBox.Show("Şifre Başarıyla Güncellendi... Lütfen tekrar giriş yapın :))");
                            button3.Visible = false;
                            label5.Visible = false;
                            label4.Visible = false;
                            textBox3.Visible = false;
                            textBox5.Visible = false;
                            dataGridView1.Visible = false;
                        }
                    }
                }
            }
            else
            {
                MessageBox.Show("Lütfen boş alan bırakmayınınz!!");
            }
        }
    }
}
