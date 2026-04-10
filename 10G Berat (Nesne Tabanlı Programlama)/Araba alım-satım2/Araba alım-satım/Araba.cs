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
        public string marka { get; set; }
        public string model { get; set; } 
        public string renk { get; set; } 
        public string vites_sayısı { get; set; } 
        public string vites_durumu { get; set; }
        public string yakıt_türü { get; set; }
        public int km { get;set; }
        public int fiyat { get; set; }

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
