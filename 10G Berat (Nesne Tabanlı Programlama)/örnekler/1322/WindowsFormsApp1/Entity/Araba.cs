using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace WindowsFormsApp1.Entity
{
    public class Araba
    {
        [Key]
        public int KayitId { get; set; }
        public string PlakaNo { get; set; }
        public string Marka { get; set; }
        public string Model { get; set; }
        public int Km { get; set; }
        public int Fiyat { get; set; }
        public string Renk { get; set; }
        public string Vites { get; set; }
        public string Yakıt { get; set; }
    }
}
