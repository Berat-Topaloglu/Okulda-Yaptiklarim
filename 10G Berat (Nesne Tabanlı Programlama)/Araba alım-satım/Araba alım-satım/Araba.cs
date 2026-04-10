using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Araba_alım_satım
{
    class Araba
    {
        public string marka, model, renk, vites_sayısı, vites_durumu, yakıt_türü;
        public int km, fiyat;

        public Araba(string marka, string model, string renk, string vites_sayısı, string vites_durumu, string yakıt_türü, int km, int fiyat)
        {
            this.marka = marka;
            this.model = model;
            this.renk = renk;
            this.vites_sayısı = vites_sayısı;
            this.vites_durumu = vites_durumu;
            this.yakıt_türü = yakıt_türü;
            this.km = km;
            this.fiyat = fiyat;
        }
        public void bilgileri_göster()
        {
            MessageBox.Show(marka + "modelinde" + km + "km'de" + fiyat + "fiyatı.");
        }
        public int ileri_git(int ilerleme)
        {
            km += ilerleme;
            return km;
        }
        public float fiyat_arttır(int arttır)
        {
            fiyat += (fiyat * arttır / 100);
            return fiyat;
        }
        public void satış()
        {
            if ((marka=="BMW"||marka=="Mercedes")&&(km<=50000 && renk=="Siyah"))
            {
                MessageBox.Show("Araba hızlı satılır. :)) ");
            }
            else
            {
                MessageBox.Show("Araba yavaş satılır. :(( ");
            }
        }
    }
}
