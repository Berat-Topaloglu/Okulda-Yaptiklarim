using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WindowsFormsApp1
{
    class Çalışan
    {
        public string yasi { get; set; }
        public int calısma_saati { get; set; }
        public int fazla_mesai { get; set; }
        public string hesapla (string yasi,int calısma_saati,int fazla_mesai)
        {
            int ucret;
            if (int.Parse(yasi) >= 18)
            {
                calısma_saati = 20;
                fazla_mesai = 28;
                ucret = calısma_saati * fazla_mesai;
                
            }
            else if (int.Parse(yasi) >= 31)
            {
                calısma_saati = 25;
                fazla_mesai = 34;
                ucret = calısma_saati * fazla_mesai;
            }
            else if (int.Parse(yasi) >= 46)
            {
                calısma_saati = 30;
                fazla_mesai = 40;
                ucret = calısma_saati * fazla_mesai;
            }
            else
            {
                MessageBox.Show("Lütfen doğtu aralıkta değer veriniz!!");
            }
            return ucret.ToString();
        }

    }
}
