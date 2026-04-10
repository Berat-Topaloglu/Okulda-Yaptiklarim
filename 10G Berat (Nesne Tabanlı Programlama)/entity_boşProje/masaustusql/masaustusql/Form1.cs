
using masaustusql.Context;
using masaustusql.Entity;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace masaustusql
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

    

        private void Form1_Load(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            using(var context=new MyContext())
            {
                context.Database.Create();
                MessageBox.Show("Başarılı");
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox2.Text)&&!string.IsNullOrEmpty(textBox3.Text))
            {
                var urun=new Stok() { urun_adi=textBox2.Text,urun_sayisi=int.Parse(textBox3.Text),urun_fiyati=int.Parse(textBox4.Text),urun_marka=textBox5.Text};
                using(var context=new MyContext())
                {
                    try
                    {
                        context.urunler.Add(urun);
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
                using(var context=new MyContext())
                {
                    int sid=int.Parse(textBox1.Text);
                    var sil=(from b in context.urunler
                             where b.urunİd == sid
                             select b).SingleOrDefault();
                    if (sil==null)
                    {
                        MessageBox.Show("Kayıt bulunamadı");
                        return;
                    }
                    else 
                    {
                        context.urunler.Remove(sil);
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
                MessageBox.Show("Lütfen ürün id alanını doldurunuz");
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
                    var guncelle = (from b in context.urunler
                               where b.urunİd == sid
                               select b).SingleOrDefault();
                    if (guncelle == null)
                    {
                        MessageBox.Show("Kayıt bulunamadı");
                        return;
                    }
                    else
                    {
                        guncelle.urun_adi = textBox2.Text;
                        guncelle.urun_sayisi =int.Parse(textBox3.Text);
                        guncelle.urun_fiyati = int.Parse(textBox4.Text);
                        guncelle.urun_marka = textBox5.Text;
                        context.SaveChanges();
                        MessageBox.Show("Kayıt güncellendi!!!");
                    }
                    textBox1.Clear();
                    textBox2.Clear();
                    textBox3.Clear();
                }
            }
            else
            {
                MessageBox.Show("Lütfen Id alanını doldurunuz");
            }
            listele();
        }

        private void textBox1_TextChanged(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox1.Text))
            {
                using (var context = new MyContext())
                {
                    int sid = int.Parse(textBox1.Text);
                    var secim = (from b in context.urunler
                                    where b.urunİd == sid
                                    select b).SingleOrDefault();
                    if (secim == null)
                    {
                        textBox2.Text = "";
                        textBox3.Text = "";
                    }
                    else
                    {
                        textBox2.Text = secim.urun_adi;;
                        textBox3.Text = secim.urun_sayisi.ToString();
                        textBox4.Text = secim.urun_fiyati.ToString();
                        textBox5.Text = secim.urun_marka;
                    }
                   
                }
            }
           
        }
        public void listele()
        {
            using (var context = new MyContext())
            {
                dataGridView1.DataSource = context.urunler.ToList();
            }
        }
        private void button5_Click(object sender, EventArgs e)
        {
            using(var context = new MyContext()) 
            {
            dataGridView1.DataSource= context.urunler.ToList();
            }
        }

        private void button6_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                            var sorgula = (from b in context.urunler
                                           where b.urunİd>3
                                           select b).ToList();
                dataGridView1.DataSource = sorgula;
            }
        }

        private void button7_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                              var aranan = (from b in context.urunler
                                            where b.urun_adi.Contains(textBox2.Text)
                                            select b).ToList();
                dataGridView1.DataSource = aranan;
            }
        }

        private void button8_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                              var sirala = (from b in context.urunler
                                            orderby b.urun_adi descending
                                            select b).ToList();
                dataGridView1.DataSource = sirala;
            }
        }

        private void button9_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                var kayitsayisi = (from b in context.urunler
                              select b).Count();
                MessageBox.Show("Mevcut kayıt sayısı:" + kayitsayisi);
            }
        }

        private void button10_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                var ikili_arama = (from b in context.urunler
                              where b.urunİd >= 2 && b.urun_adi=="Ortopedi"
                              select b).ToList();
                dataGridView1.DataSource = ikili_arama;
            }
        }

        private void button11_Click(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                var enbüyük = (from b in context.urunler
                               select b).Max(a => a.urunİd);
                MessageBox.Show("Id'si en büyük olan:" + enbüyük);
            }
        }
    }
}
