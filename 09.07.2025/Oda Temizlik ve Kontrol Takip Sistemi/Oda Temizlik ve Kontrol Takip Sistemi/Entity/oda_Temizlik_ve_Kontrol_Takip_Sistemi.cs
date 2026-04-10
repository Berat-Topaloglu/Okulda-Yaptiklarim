using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Oda_Temizlik_ve_Kontrol_Takip_Sistemi.Entity
{
    public class oda_Temizlik_ve_Kontrol_Takip_Sistemi
    {
        public string Oda_Numarasi { get; set; }
        public DateTime Günler { get; set; }
        public float Saatler { get; set; }
        public string Klozet_Temizligi { get; set; }
        public string Lavabo_Temizligi { get; set; }
        public string Musluk_Temizligi { get; set; }
        public string Ayna_Temizligi { get; set; }
        public string Kapı_Kolu_Temizligi { get; set; }
        public string Zemin_Temizligi { get; set; }
        public string Cop_Torbasinin_Degisimi { get; set; }
        public string Oda_Ici_Temizligi { get; set; }
        public string Yatak_Düzeni { get; set; }
        public string Oda_Tefrisati_Duzeni { get; set; }
    }
}
