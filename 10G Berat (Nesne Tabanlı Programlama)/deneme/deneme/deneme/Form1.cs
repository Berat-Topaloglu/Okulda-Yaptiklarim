using deneme.Context;
using deneme.Entity;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace deneme
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }
        public void listele()
        {
            using(var context=new Mycontext())
            {
                dataGridView1.DataSource = context.bolumler.ToList();
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            using(var context=new Mycontext())
            {
                context.Database.Create();
                MessageBox.Show("İşlem başarılı...");
            }
            listele();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox2.Text)&&(!string.IsNullOrEmpty(textBox3.Text)))
            {
                var bolum = new Bolum() { adi = textBox2.Text, acıklama = textBox3.Text };
                using (var context = new Mycontext())
                try
                {
                        context.bolumler.Add(bolum);
                        context.SaveChanges();
                        MessageBox.Show("Kayıt başarılı bir şekilde oluşturuldu...");
                }
                catch (Exception ex)
                {
                        MessageBox.Show("Beklenmedik bir hata meydana geldi!!" + ex.ToString());
                }
                textBox2.Clear();
                textBox3.Clear();
            }
            else
            {
                MessageBox.Show("Lütfen boş alan bırakmayınız!!");
            }
            listele();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox1.Text))
            {
                using(var context=new Mycontext())
                {
                    int bid = int.Parse(textBox1.Text);
                    var sil = (from x in context.bolumler
                               where x.Bolumıd == bid
                               select x).SingleOrDefault();
                    if (sil == null)
                    {
                        MessageBox.Show("Aranılan id bulunamadı!!");
                        return;
                    }
                    else
                    {
                        context.bolumler.Remove(sil);
                        context.SaveChanges();
                        MessageBox.Show("Silme işlemi başarılıbir şekilde gerçekleştirildi...");
                    }
                    textBox1.Clear();
                    textBox2.Clear();
                    textBox3.Clear();
                }
            }
            else
            {
                MessageBox.Show("Lütfen id alanını boş bırakmayınız!!");
            }
            listele();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox1.Text))
            {
                using (var context = new Mycontext())
                {
                    int bid = int.Parse(textBox1.Text);
                    var güncelle = (from x in context.bolumler
                               where x.Bolumıd == bid
                               select x).SingleOrDefault();
                    if (güncelle == null)
                    {
                        MessageBox.Show("Kayıt bulunamadı!!");
                        return;
                    }
                    else
                    {
                        güncelle.adi = textBox2.Text;
                        güncelle.acıklama = textBox3.Text;
                        context.SaveChanges();
                    }
                }
            }
            listele();
        }

        private void textBox1_TextChanged(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox1.Text))
            {
                using (var context = new Mycontext())
                {
                    int bid = int.Parse(textBox1.Text);
                    var secim = (from x in context.bolumler
                                    where x.Bolumıd == bid
                                    select x).SingleOrDefault();
                    if (secim == null)
                    {
                        textBox2.Clear();
                        textBox3.Clear();
                    }
                    else
                    {
                        textBox2.Text = secim.adi;
                        textBox3.Text = secim.acıklama;
                    }
                }
            }
        }
    }
}
