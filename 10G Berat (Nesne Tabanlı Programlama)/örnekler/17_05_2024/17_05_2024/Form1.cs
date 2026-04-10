using _17_05_2024.context;
using _17_05_2024.entity;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace _17_05_2024
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }
        public void listele()
        {
            using (var content = new mycontext())
            {
                dataGridView1.DataSource = content.arabalar.ToList();
            }
        }
        private void button1_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                context.Database.Create();
                MessageBox.Show("başarılı");
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
            listele();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox2.Text) && !string.IsNullOrEmpty(textBox3.Text) && !string.IsNullOrEmpty(textBox4.Text) && !string.IsNullOrEmpty(textBox5.Text))
            {
                var a = new araba() { plakano = textBox2.Text, marka = textBox3.Text, model = textBox4.Text, km = int.Parse(textBox5.Text), fiyat = int.Parse(textBox6.Text), renk = textBox7.Text, vites = textBox8.Text, yakit = textBox9.Text };
                using (var context = new mycontext())
                {
                    try
                    {
                        context.arabalar.Add(a);
                        context.SaveChanges();
                        MessageBox.Show("kayıt başarılı...");
                    }
                    catch (Exception ex)
                    {
                        MessageBox.Show("beklenmedik hata oluştu!!" + ex.ToString());
                        throw;
                    }
                }
            }
            else
            {
                MessageBox.Show("lütfen boş alan bırakmayınız!!");
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
            listele();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox1.Text))
            {
                using (var context = new mycontext())
                {
                    int bid = int.Parse(textBox1.Text);
                    var sil = (from b in context.arabalar
                               where b.kayitId == bid
                               select b).SingleOrDefault();
                    if (sil == null)
                    {
                        MessageBox.Show("kayıt bulunamadı");
                        return;
                    }
                    else
                    {
                        context.arabalar.Remove(sil);
                        context.SaveChanges();
                        MessageBox.Show("kayıt silindi");
                    }
                }
            }
            else
            {
                MessageBox.Show("lütfen id kısmını doldurun");
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
            listele();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox1.Text))
            {
                using (var context = new mycontext())
                {
                    int bid = int.Parse(textBox1.Text);
                    var guncelle = (from b in context.arabalar
                                    where b.kayitId == bid
                                    select b).SingleOrDefault();
                    if (guncelle == null)
                    {
                        MessageBox.Show("kayıt bulunamadı");
                        return;
                    }
                    else
                    {
                        guncelle.plakano = textBox2.Text;
                        guncelle.marka = textBox3.Text;
                        guncelle.model = textBox4.Text;
                        guncelle.km = int.Parse(textBox5.Text);
                        guncelle.fiyat = int.Parse(textBox6.Text);
                        guncelle.renk = textBox7.Text;
                        guncelle.vites = textBox8.Text;
                        guncelle.yakit = textBox9.Text;
                        context.SaveChanges();
                        MessageBox.Show("kayıt güncellendi");
                    }
                }
            }
            else
            {
                MessageBox.Show("lütfen id kısmını doldurun");
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
            listele();
        }

        private void button5_Click(object sender, EventArgs e)
        {
            using (var content = new mycontext())
            {
                dataGridView1.DataSource = content.arabalar.ToList();
            }
        }
        private void button6_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                var kayıtsayısı = (from b in context.arabalar
                                   select b).Count();
                MessageBox.Show("toplam araç sayısı: " + kayıtsayısı);
            }
        }
        private void button7_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                var sorgula = (from b in context.arabalar
                               where b.marka == "bmw"
                               select b).ToList();
                MessageBox.Show("bmw ye ait araç sayısı :");
            }
        }

        private void button8_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                var enbuyuk = (from b in context.arabalar
                               select b).Min(a => a.km);
                MessageBox.Show("en küçük: " + enbuyuk);
            }
        }

        private void button9_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                var enbuyuk = (from b in context.arabalar
                               select b).Max(a => a.fiyat);
                MessageBox.Show("en büyük: " + enbuyuk);
            }
        }

        private void button10_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                var sırala = (from b in context.arabalar
                              orderby b.marka descending
                              select b).ToList();
                dataGridView1.DataSource = sırala;
            }
        }

        private void button11_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                var sırala = (from b in context.arabalar
                              orderby b.fiyat
                              select b).ToList();
                dataGridView1.DataSource = sırala;
            }
        }

        private void button12_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                var sorgula = (from b in context.arabalar
                               where b.marka == "bmw" && b.marka == "mercedes"
                               select b).ToList();
                MessageBox.Show("bmw ye ait araç sayısı :");
            }
        }

        private void button13_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                var sorgula = (from b in context.arabalar
                               select b).Take(3);
                dataGridView1.DataSource = sorgula;
            }
        }

        private void button14_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                var sorgula = (from b in context.arabalar
                               where b.fiyat > 1
                               select b).Take(3);
                MessageBox.Show("100 den fazla " + sorgula);
            }
        }

        private void button15_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                var sorgula = (from b in context.arabalar
                               where b.yakit == "benzin"
                               select b).Count();
                MessageBox.Show("benzinli araç sayısı :"+sorgula);
            }
        }

        private void button16_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                var enbuyuk = (from b in context.arabalar
                               where b.vites == "otomatik"
                               select b.fiyat).Sum();
                MessageBox.Show("otomatik toplam fiyat: " + enbuyuk);
            }
        }

        private void button17_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                var sorgula = (from b in context.arabalar
                               where b.marka == "bmw" && b.model == "m5"
                               select b).ToList();
                MessageBox.Show("bmw ve m5 modeline ait araçlar :");
            }
        }

        private void button18_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                var enbuyuk = (from b in context.arabalar
                               where b.vites == "otomatik"
                               select b.fiyat).Average();
                MessageBox.Show("ortalama fiyat: " + enbuyuk);
            }
        }

        private void button19_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                var sorgula = (from b in context.arabalar
                               where b.vites == "otomatik"
                               select b).Count();

                var sorgulaa = (from b in context.arabalar
                               where b.vites == "manual"
                               select b).Count();
                MessageBox.Show("otomatik araç sayısı:" + sorgula + "manual araç sayısı:" + sorgulaa);
            }
        }

        private void button20_Click(object sender, EventArgs e)
        {
            using (var context = new mycontext())
            {
                var sorgula = (from b in context.arabalar
                               where b.yakit == "benzin"
                               select b).Count();

                var sorgulaa = (from b in context.arabalar
                                where b.yakit == "dizel"
                                select b).Count();
                MessageBox.Show("benzinli araç sayısı:" + sorgula + "dizel araç sayısı:" + sorgulaa);
            }
        }
    }
}
