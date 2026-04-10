using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace _17_05_2024.entity
{
    public class araba
    {
        [Key]
        public int kayitId { get; set; }
        public string plakano { get; set; }
        public string marka { get; set; }
        public string model { get; set; }
        public int km { get; set; }
        public int fiyat { get; set; }
        public string renk { get; set; }
        public string vites { get; set; }
        public string yakit { get; set; }


    }
}
