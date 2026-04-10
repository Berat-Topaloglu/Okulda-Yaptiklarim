using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using WindowsFormsApp1.Context;
using WindowsFormsApp1.Entity;

namespace WindowsFormsApp1
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }
        public void listele()
        {
            using (var context = new MyContext())
            {
                dataGridView1.DataSource = context.Arabalar.ToList();
            }
        }
        private void button1_Click(object sender, EventArgs e)
        {
            using(var context = new MyContext())
            {
                context.Database.Create();
                MessageBox.Show("Kayıt Başarılı...");
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox2.Text) && !string.IsNullOrEmpty(textBox3.Text) && !string.IsNullOrEmpty(textBox4.Text))
            {
                var arac = new Araba() { PlakaNo = textBox2.Text, Marka = (textBox3.Text), Model = (textBox4.Text), Km = int.Parse(textBox5.Text), Fiyat = int.Parse(textBox6.Text), Renk = textBox7.Text, Vites = textBox8.Text, Yakıt = textBox9.Text };
                using (var context = new MyContext())
                {
                    try
                    {
                        context.Arabalar.Add(arac);
                        context.SaveChanges();
                        MessageBox.Show("Arç kayıdı başarılı bir şekilde eklendi...");
                    }
                    catch (Exception ex)
                    {

                        MessageBox.Show("Beklenmedik bir hata!!" + ex.ToString());
                    }
                }
                textBox1.Clear();
                textBox2.Clear();
                textBox3.Clear();
                textBox4.Clear();
                textBox5.Clear();
            }
            else
            {
                MessageBox.Show("Boş alan bırakamazsınız!!!");
            }
            listele();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox1.Text))
            {
                using (var context = new MyContext())
                {
                    int sid = int.Parse(textBox1.Text);
                    var sil = (from b in context.Arabalar
                               where b.KayitId.ToString() == sid.ToString()
                               select b).SingleOrDefault();
                    if (sil == null)
                    {
                        MessageBox.Show("Kayıt bulunamadı");
                        return;
                    }
                    else
                    {
                        context.Arabalar.Remove(sil);
                        context.SaveChanges();
                        MessageBox.Show("Kayıt silindi!!!");
                    }
                    textBox1.Clear();
                    textBox2.Clear();
                    textBox3.Clear();
                    textBox4.Clear();
                    textBox5.Clear();
                    textBox6.Clear();
                    textBox7.Clear();
                    textBox8.Clear();
                    textBox9.Clear();
                }
            }
            else
            {
                MessageBox.Show("Lütfen araba id'sini alanını doldurunuz");
            }
            listele();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox1.Text))
            {
                using (var context = new MyContext())
                {
                    int sid = int.Parse(textBox1.Text);
                    var guncelle = (from b in context.Arabalar
                                    where b.KayitId.ToString() == sid.ToString()
                                    select b).SingleOrDefault();
                    if (guncelle == null)
                    {
                        MessageBox.Show("Kayıt bulunamadı");
                        return;
                    }
                    else
                    {
                        guncelle.Marka = textBox2.Text;
                        guncelle.Model = (textBox3.Text);
                        guncelle.Km = int.Parse(textBox4.Text);
                        guncelle.Fiyat = int.Parse(textBox5.Text);
                        guncelle.Renk = textBox6.Text;
                        guncelle.Vites = textBox7.Text;
                        guncelle.Yakıt = textBox9.Text;
                        context.SaveChanges();
                        MessageBox.Show("Kayıt güncellendi!!!");
                    }
                    textBox1.Clear();
                    textBox2.Clear();
                    textBox3.Clear();
                    textBox4.Clear();
                    textBox5.Clear();
                    textBox6.Clear();
                    textBox7.Clear();
                    textBox8.Clear();
                    textBox9.Clear();
                }
            }
            else
            {
                MessageBox.Show("Lütfen Id alanını doldurunuz");
            }
            listele();
        }

        private void button5_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                var toplam_arac = (from b in context.Arabalar
                                   select b).Count();
                MessageBox.Show("Mevcut kayıt sayısı:" + toplam_arac);
            }
        }

        private void button6_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                var aranan_arac = (from b in context.Arabalar
                                   where b.Marka == comboBox1.Text
                                   select b).ToList();
                dataGridView1.DataSource = aranan_arac;
            }
        }

        private void button7_Click(object sender, EventArgs e)
        {
            string ekle = textBox3.Text;
            comboBox1.Items.Add(ekle);
        }
    }
}
