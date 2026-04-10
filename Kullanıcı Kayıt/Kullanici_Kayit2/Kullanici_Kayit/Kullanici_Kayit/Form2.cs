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
    public partial class Form2 : Form
    {
        public Form2()
        {
            InitializeComponent();
        }
        public void listele()
        {
            using (var context = new MyContext())
            {
                dataGridView1.DataSource = context.Kullanici_Kayits.ToList();
            }
        }
        public void listele2()
        {
            using (var context = new HesapContext())
            {
                dataGridView2.DataSource = context.Hesap_Kayits.ToList();
            }
        }
        private void button1_Click_1(object sender, EventArgs e)
        {
            using (var context = new MyContext())
            {
                context.Database.Create();
                MessageBox.Show("İşlem başarı ile gerçekleştirildi....");
            }
        }

        private void button2_Click_1(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox1.Text) || (!string.IsNullOrEmpty(textBox2.Text) || (!string.IsNullOrEmpty(textBox3.Text) || (!string.IsNullOrEmpty(textBox4.Text)) || (!string.IsNullOrEmpty(textBox5.Text)))))
            {
                var kullanici = new kullanici_kayit() { TC_Kimlik_Numarsı = float.Parse(textBox1.Text), Isim = textBox2.Text, Soyisim = textBox3.Text, Dogum_Yılı = int.Parse(textBox4.Text), Oturdugu_Sehir = textBox5.Text };
                using (var context = new MyContext())
                {
                    try
                    {
                        context.Kullanici_Kayits.Add(kullanici);
                        context.SaveChanges();
                        MessageBox.Show("Kayıt başarılı bir şekilde oluşturuldu...");
                        listele();
                    }
                    catch (Exception ex)
                    {
                        MessageBox.Show("Beklenmedik bir hata meydana geldi!!" + ex.ToString());
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
                MessageBox.Show("Lütfen boş alan bırakmayınız!!");
            }
            listele();
        }

        private void button5_Click_1(object sender, EventArgs e)
        {
            listele();
            listele2();
        }

        private void button3_Click_1(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox6.Text))
            {
                using (var context = new MyContext())
                {
                    int kullanici_ID = int.Parse(textBox6.Text);
                    var sil = (from x in context.Kullanici_Kayits
                               where x.ID == kullanici_ID
                               select x).SingleOrDefault();
                    if (sil == null)
                    {
                        MessageBox.Show("Aranılan kullancı bulunamadı!!");
                        return;
                    }
                    else
                    {
                        context.Kullanici_Kayits.Remove(sil);
                        context.SaveChanges();
                        MessageBox.Show("Kullanıcı silme işlemi başarılı bir şekilde gerçekleştirildi...");
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
                MessageBox.Show("Lütfen kullanıcı id numarasını giriniz!!");
            }
            listele();
        }

        private void button4_Click_1(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox6.Text))
            {
                using (var context = new MyContext())
                {
                    int kullanici_ID = int.Parse(textBox6.Text);
                    var kullanici_güncelle = (from x in context.Kullanici_Kayits
                                              where x.ID == kullanici_ID
                                              select x).SingleOrDefault();
                    if (kullanici_güncelle == null)
                    {
                        MessageBox.Show("Kullanıcı kaydı bulunamadı!!");
                        return;
                    }
                    else
                    {
                        kullanici_güncelle.TC_Kimlik_Numarsı = float.Parse(textBox1.Text);
                        kullanici_güncelle.Isim = textBox2.Text;
                        kullanici_güncelle.Soyisim = textBox3.Text;
                        kullanici_güncelle.Dogum_Yılı = int.Parse(textBox4.Text);
                        kullanici_güncelle.Oturdugu_Sehir = textBox5.Text;
                        context.SaveChanges();
                    }
                }
            }
            listele();
        }
        
        private void button6_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox7.Text) || (!string.IsNullOrEmpty(textBox8.Text)))
            {
                var hesap = new hesap_kayit() { Kullanici_Adi = textBox7.Text,Sifre = textBox8.Text };
                using (var context = new HesapContext())
                {
                    try
                    {
                        context.Hesap_Kayits.Add(hesap);
                        context.SaveChanges();
                        MessageBox.Show("Hesap başarılı bir şekilde oluşturuldu...");
                        Form1 form1 = new Form1();
                        form1.ShowDialog();
                        this.Hide();
                    }
                    catch (Exception ex)
                    {
                        MessageBox.Show("Beklenmedik bir hata meydana geldi!!" + ex.ToString());
                    }
                    textBox7.Clear();
                    textBox8.Clear();
                }
            }
            else
            {
                MessageBox.Show("Lütfen boş alan bırakmayınız!!");
            }
        }

        private void button7_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox9.Text))
            {
                using (var context = new HesapContext())
                {
                    int kullanici_ID = int.Parse(textBox9.Text);
                    var sil = (from x in context.Hesap_Kayits
                               where x.ID == kullanici_ID
                               select x).SingleOrDefault();
                    if (sil == null)
                    {
                        MessageBox.Show("Aranılan kullancı bulunamadı!!");
                        return;
                    }
                    else
                    {
                        context.Hesap_Kayits.Remove(sil);
                        context.SaveChanges();
                        MessageBox.Show("Kullanıcı silme işlemi başarılı bir şekilde gerçekleştirildi...");
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
                MessageBox.Show("Lütfen kullanıcı id numarasını giriniz!!");
            }
            listele2();
        }

        private void button8_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox9.Text))
            {
                using (var context = new HesapContext())
                {
                    int kullanici_ID = int.Parse(textBox9.Text);
                    var kullanici_güncelle = (from x in context.Hesap_Kayits
                                              where x.ID == kullanici_ID
                                              select x).SingleOrDefault();
                    if (kullanici_güncelle == null)
                    {
                        MessageBox.Show("Kullanıcı kaydı bulunamadı!!");
                        return;
                    }
                    else
                    {
                        kullanici_güncelle.Kullanici_Adi = textBox7.Text;
                        kullanici_güncelle.Sifre = textBox8.Text;
                        context.SaveChanges();
                        listele2();
                        DialogResult cevap =  MessageBox.Show("Giriş Yapmak İster Misiniz?", "Evet",MessageBoxButtons.YesNo);
                        if (cevap==DialogResult.Yes)
                        {
                            Form1 form1 = new Form1();
                            form1.ShowDialog();
                            this.Hide();
                        }
                        else
                        {
                            MessageBox.Show("İşlem reddedildi... İyi günler :)");
                        }
                    }
                }
            }
            else
            {
                MessageBox.Show("Lütfen boş alan bırakmayınız!!");
            }
        }
    }
}
