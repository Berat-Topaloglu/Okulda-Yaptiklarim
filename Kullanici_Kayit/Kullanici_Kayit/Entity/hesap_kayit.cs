using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Kullanici_Kayit.Entity
{
    public class hesap_kayit
    {
        [Key]
        public int ID { get; set; }
        public string Kullanici_Adi { get; set; }
        public string Sifre { get; set; }
    }
}
