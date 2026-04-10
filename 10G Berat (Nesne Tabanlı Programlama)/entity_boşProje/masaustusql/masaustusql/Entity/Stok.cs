using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace masaustusql.Entity
{
    public class Stok
    {
        [Key]
        public int urunİd { get; set; }
        public string urun_adi { get; set; }
        public int urun_sayisi { get; set; }
        public int urun_fiyati { get; set; }
        public string urun_marka { get; set; }
    }
}
