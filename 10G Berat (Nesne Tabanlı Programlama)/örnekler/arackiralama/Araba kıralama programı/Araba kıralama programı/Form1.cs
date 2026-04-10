using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Data.OleDb; 

namespace Araba_kıralama_programı
{
    public partial class Form1 : Form
    {
        OleDbConnection baglanti = new OleDbConnection("Provider=Microsoft.ACE.OLEDB.12.0;Data Source=arac_kiralama.accdb");
        OleDbCommand komut = new OleDbCommand();
        OleDbDataAdapter adtr = new OleDbDataAdapter();
        DataSet ds = new DataSet();
        public Form1()
        {
            InitializeComponent();
        }



        void listele()
        {
            baglanti.Open();
            OleDbDataAdapter adtr = new OleDbDataAdapter("Select * from araba", baglanti);
            adtr.Fill(ds, "araba");
            dataGridView1.DataSource = ds.Tables["araba"];
            adtr.Dispose();
            baglanti.Close();
        }
        private void Form1_Load(object sender, EventArgs e)
        {
            listele();
        }
        
        private void button2_Click(object sender, EventArgs e)
        {
            aresmi.Text = pictureBox1.ImageLocation;
            if (sira.Text != "" && marka.Text != "" && model.Text != "" && plaka.Text != "" && kasatipi.Text != "" && uretimyili.Text != "" && yakitturu.Text != "" && km.Text != "" && kiraucreti.Text != "" && renk.Text != "" && aresmi.Text != "" && durum.Text != "")
            {
                komut.Connection = baglanti;
                komut.CommandText = "Insert Into araba(s_no,marka,model,plaka,kasa_tipi,u_yili,y_turu,km,kira_u,renk,resim,durum) Values ( '" + sira.Text + "','" + marka.Text + "','" + model.Text + "','" + plaka.Text + "','" + kasatipi.Text + "','" + uretimyili.Text + "','" + yakitturu.Text + "','" + km.Text + "','" + kiraucreti.Text + "','" + renk.Text + "','" + aresmi.Text + "','" + durum.Text + "')";
                baglanti.Open();
                komut.ExecuteNonQuery();
                komut.Dispose();
                baglanti.Close();
                MessageBox.Show("Kayıt Tamamlandı!");
                ds.Clear();
                listele();
            }
            else
            {
                MessageBox.Show("Boş alan geçmeyiniz!");
            }
        }
        
        private void button4_Click(object sender, EventArgs e)
        {
            if (openFileDialog1.ShowDialog() == DialogResult.OK)
            {
                pictureBox1.ImageLocation = openFileDialog1.FileName;
            }
        }
        
        private void button6_Click(object sender, EventArgs e)
        {
            baglanti = new OleDbConnection("Provider=Microsoft.ACE.Oledb.12.0;Data Source=arac_kiralama.accdb");
            adtr = new OleDbDataAdapter("Select * from araba where s_no like '" + sira.Text + "%'", baglanti);
            ds = new DataSet();
            baglanti.Open();
            adtr.Fill(ds, "araba");
            dataGridView1.DataSource = ds.Tables["araba"];
            baglanti.Close();
        }
        
        private void button3_Click(object sender, EventArgs e)
        {
            baglanti.Open();
            komut.Connection = baglanti;
            komut.CommandText = "Delete from araba where s_no=" + sira.Text + "";
            komut.ExecuteNonQuery();
            komut.Dispose();
            baglanti.Close();
            MessageBox.Show("Kayıt silindi!");
            ds.Clear();
            listele();
        }

        private void plaka_TextChanged(object sender, EventArgs e)
        {

        }
        
        private void button1_Click(object sender, EventArgs e)
        {
            komut = new OleDbCommand();
            baglanti.Open();
            komut.Connection = baglanti;
            komut.CommandText = "update araba set marka='" + marka.Text + "',model='" + model.Text + "',plaka='" + plaka.Text + "',kasa_tipi='" + kasatipi.Text + "',u_yili='" + uretimyili.Text + "',y_turu='" + yakitturu.Text + "',km='" + km.Text + "',kira_u='" + kiraucreti.Text + "',renk='" + renk.Text + "',resim='" + pictureBox1.ImageLocation + "',durum='" + durum.Text + "' where s_no=" + sira.Text + "";
            komut.ExecuteNonQuery();
            baglanti.Close();
            MessageBox.Show("Kayıt güncellendi!");
            ds.Clear();
            listele();
        }
        
        private void dataGridView1_CellEnter(object sender, DataGridViewCellEventArgs e)
        {
            sira.Text = dataGridView1.CurrentRow.Cells[0].Value.ToString();
            marka.Text = dataGridView1.CurrentRow.Cells[1].Value.ToString();
            model.Text = dataGridView1.CurrentRow.Cells[2].Value.ToString();
            plaka.Text = dataGridView1.CurrentRow.Cells[3].Value.ToString();
            kasatipi.Text = dataGridView1.CurrentRow.Cells[4].Value.ToString();
            uretimyili.Text = dataGridView1.CurrentRow.Cells[5].Value.ToString();
            yakitturu.Text = dataGridView1.CurrentRow.Cells[6].Value.ToString();
            km.Text = dataGridView1.CurrentRow.Cells[7].Value.ToString();
            kiraucreti.Text = dataGridView1.CurrentRow.Cells[8].Value.ToString();
            renk.Text = dataGridView1.CurrentRow.Cells[9].Value.ToString();
            pictureBox1.ImageLocation = dataGridView1.CurrentRow.Cells[10].Value.ToString();
            durum.Text = dataGridView1.CurrentRow.Cells[11].Value.ToString();
           
          
 
            
        }

        private void durum_SelectedIndexChanged(object sender, EventArgs e)
        {

        }
    }
}
       

    

