using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace deneme.Entity
{
    public class Bolum
    {
        [Key]
        public int Bolumıd { get; set; }
        public string adi { get; set; }
        public string acıklama { get; set; }
    }
}
