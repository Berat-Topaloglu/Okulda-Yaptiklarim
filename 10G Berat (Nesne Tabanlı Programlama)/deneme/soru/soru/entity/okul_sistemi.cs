using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace soru.entity
{
    public class okul_sistemi
    {
        [Key]
        public int ogr_no { get; set; }
        public string ogr_adi { get; set; }
        public string ogr_soyadi { get; set; }
        public string ogr_bolumu { get; set; }
        public int ogr_yasi { get; set; }
    }
}
