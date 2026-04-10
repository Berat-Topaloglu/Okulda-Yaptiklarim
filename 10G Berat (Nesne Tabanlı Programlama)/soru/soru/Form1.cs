using soru.context;
using soru.entity;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace soru
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
                dataGridView1.DataSource = context.e_okuls.ToList();
            }
        }
        private void button1_Click(object sender, EventArgs e)
        {
            using(var context=new Mycontext())
            {
                context.Database.Create();
                MessageBox.Show("İşlem başarı ile gerçekleştirildi....");
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox2.Text)&&(!string.IsNullOrEmpty(textBox3.Text)&&(!string.IsNullOrEmpty(textBox4.Text)&&(!string.IsNullOrEmpty(textBox5.Text)))))
            {
                var ogrenci = new okul_sistemi() { ogr_adi=textBox2.Text,ogr_soyadi=textBox3.Text,ogr_bolumu=textBox4.Text,ogr_yasi=int.Parse(textBox5.Text)};
                using(var context=new Mycontext())
                {
                    try
                    {
                        context.e_okuls.Add(ogrenci);
                        context.SaveChanges();
                        MessageBox.Show("Kayıt başarılı bir şekilde oluşturuldu...");
                    }
                    catch (Exception ex)
                    {
                        MessageBox.Show("Beklenmedik bir hata meydana geldi!!" + ex.ToString());
                    }
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

        private void button3_Click(object sender, EventArgs e)
        {

            if (!string.IsNullOrEmpty(textBox1.Text))
            {
                using (var context = new Mycontext())
                {
                    int ogr_id = int.Parse(textBox1.Text);
                    var sil = (from x in context.e_okuls
                               where x.ogr_no == ogr_id
                               select x).SingleOrDefault();
                    if (sil == null)
                    {
                        MessageBox.Show("Aranılan öğrenci kaydı bulunamadı!!");
                        return;
                    }
                    else
                    {
                        context.e_okuls.Remove(sil);
                        context.SaveChanges();
                        MessageBox.Show("Öğrenci silme işlemi başarılı bir şekilde gerçekleştirildi...");
                    }
                    textBox1.Clear();
                    textBox2.Clear();
                    textBox3.Clear();
                }
            }
            else
            {
                MessageBox.Show("Lütfen öğrenci numarasını giriniz!!");
            }
            listele();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox1.Text))
            {
                using (var context = new Mycontext())
                {
                    int ogr_id = int.Parse(textBox1.Text);
                    var ogr_güncelle = (from x in context.e_okuls
                                    where x.ogr_no == ogr_id
                                    select x).SingleOrDefault();
                    if (ogr_güncelle == null)
                    {
                        MessageBox.Show("Öğrenci kaydı bulunamadı!!");
                        return;
                    }
                    else
                    {
                        ogr_güncelle.ogr_adi = textBox2.Text;
                        ogr_güncelle.ogr_soyadi = textBox3.Text;
                        ogr_güncelle.ogr_bolumu = textBox4.Text;
                        ogr_güncelle.ogr_yasi = int.Parse(textBox5.Text);
                        context.SaveChanges();
                    }
                }
            }
            listele();
        }
    }
}
