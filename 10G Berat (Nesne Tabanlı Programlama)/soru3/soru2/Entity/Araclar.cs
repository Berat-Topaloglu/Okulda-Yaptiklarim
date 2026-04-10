using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace soru2.Entity
{
    public class Araclar
    {
        [Key]
        public string plakaId { get; set; }
        public string marka { get; set; }
        public string model { get; set; }
        public int model_yili { get; set; }
        public int fiyat { get; set; }
        public int km { get; set; }
    }
}
