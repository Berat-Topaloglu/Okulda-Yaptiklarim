using Oda_Temizlik_ve_Kontrol_Takip_Sistemi.Context;
using Oda_Temizlik_ve_Kontrol_Takip_Sistemi.Entity;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Oda_Temizlik_ve_Kontrol_Takip_Sistemi
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
                dataGridView1.DataSource = context.oda_temizlik_ve_kontrol_takip_sistemis.ToList();
            }
        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            using (var context=new MyContext())
            {
                context.Database.Create();
                MessageBox.Show("İşlem başarı ile gerçekleştirildi....");
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrEmpty(textBox1.Text) && (!string.IsNullOrEmpty(textBox2.Text) && (!string.IsNullOrEmpty(textBox3.Text) && (!string.IsNullOrEmpty(textBox4.Text)))))
            {
                var kontrol = new oda_Temizlik_ve_Kontrol_Takip_Sistemi() { ogr_adi = textBox2.Text, ogr_soyadi = textBox3.Text, ogr_bolumu = textBox4.Text, ogr_yasi = int.Parse(textBox5.Text) };
                using (var context = new MyContext())
                {
                    try
                    {
                        context.oda_temizlik_ve_kontrol_takip_sistemis.Add(kontrol);
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
    }
}
