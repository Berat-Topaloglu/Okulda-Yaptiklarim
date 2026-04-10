using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Kullanici_Kayit.Entity
{
    public class kullanici_kayit
    {
        [Key]
        public int ID { get; set; }
        public float TC_Kimlik_Numarsı { get; set; }
        public string Isim { get; set; }
        public string Soyisim { get; set; }
        public int Dogum_Yılı { get; set; }
        public string Oturdugu_Sehir { get; set; }
    }
}
