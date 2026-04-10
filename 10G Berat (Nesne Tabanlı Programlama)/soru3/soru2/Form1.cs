using soru2.Context;
using soru2.Entity;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Runtime.Remoting.Contexts;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace soru2
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
                dataGridView1.DataSource = context.aracs.ToList();
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            using (var Context = new MyContext())
            {
                Context.Database.Create();
                MessageBox.Show("Başarılı");
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox2.Text) && !string.IsNullOrEmpty(textBox3.Text))
            {
                var urun = new Araclar() { marka = textBox2.Text, model = (textBox3.Text), model_yili = int.Parse(textBox4.Text), fiyat = int.Parse(textBox5.Text), km = int.Parse(textBox6.Text) };
                using (var context = new MyContext())
                {
                    try
                    {
                        context.aracs.Add(urun);
                        context.SaveChanges();
                        MessageBox.Show("Urun kayıdı başarılı bri şekilde eklendi...");
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
                    var sil = (from b in context.aracs
                               where b.plakaId == sid.ToString()
                               select b).SingleOrDefault();
                    if (sil == null)
                    {
                        MessageBox.Show("Kayıt bulunamadı");
                        return;
                    }
                    else
                    {
                        context.aracs.Remove(sil);
                        context.SaveChanges();
                        MessageBox.Show("Kayıt silindi!!!");
                    }
                    textBox1.Clear();
                    textBox2.Clear();
                    textBox3.Clear();
                    textBox4.Clear();
                    textBox5.Clear();
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
                    var guncelle = (from b in context.aracs
                                    where b.plakaId == sid.ToString()
                                    select b).SingleOrDefault();
                    if (guncelle == null)
                    {
                        MessageBox.Show("Kayıt bulunamadı");
                        return;
                    }
                    else
                    {
                        guncelle.model = textBox2.Text;
                        guncelle.marka = (textBox3.Text);
                        guncelle.fiyat = int.Parse(textBox4.Text);
                        guncelle.km = int.Parse(textBox5.Text);
                        context.SaveChanges();
                        MessageBox.Show("Kayıt güncellendi!!!");
                    }
                    textBox1.Clear();
                    textBox2.Clear();
                    textBox3.Clear();
                    textBox4.Clear();
                    textBox5.Clear();
                    textBox6.Clear();
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
                var toplam_arac = (from b in context.aracs
                                   select b).Count();
                MessageBox.Show("Mevcut kayıt sayısı:" + toplam_arac);
            }
        }

        private void button6_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                var sorgula = (from b in context.aracs
                               where b.fiyat > 100
                               select b).ToList();
                dataGridView1.DataSource = sorgula;
            }
        }

        private void button7_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                var ikili_arama = (from b in context.aracs
                                   where b.fiyat >= 100 && b.marka == "Opel"
                                   select b).ToList();
                dataGridView1.DataSource = ikili_arama;
            }
        }

        private void button8_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                var sirala = (from b in context.aracs
                              orderby b.fiyat descending
                              select b).ToList();
                dataGridView1.DataSource = sirala;
            }
        }

        private void button9_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                var sirala = (from b in context.aracs
                              orderby b.km descending
                              select b).ToList();
                dataGridView1.DataSource = sirala;
            }
        }

        private void button10_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                var sirala = (from b in context.aracs
                              orderby b.marka descending
                              select b).ToList();
                dataGridView1.DataSource = sirala;
            }
        }

        private void button11_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                var enbüyük = (from b in context.aracs
                               select b).Max(a => a.fiyat);
                MessageBox.Show("Id'si en büyük olan:" + enbüyük);
            }
        }

        private void button12_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                var enbüyük = (from b in context.aracs
                               select b).Min(a => a.km);
                MessageBox.Show("Id'si en büyük olan:" + enbüyük);
            }
        }

        private void button13_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                var aranan = (from b in context.aracs
                              where b.marka.Contains(textBox2.Text)
                              select b).ToList();
                dataGridView1.DataSource = aranan;
            }
        }

        private void button14_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                var enbüyük = (from b in context.aracs
                               select b.fiyat).Sum();
                MessageBox.Show("Toplam Fiyatı:" + enbüyük);
            }
        }

        private void button15_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                var enbüyük = (from b in context.aracs
                               select b).Take(5);
                dataGridView1.DataSource = enbüyük;
            }
        }
    }
}