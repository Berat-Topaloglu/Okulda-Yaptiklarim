using System.ComponentModel.DataAnnotations;

namespace Soru.Models
{
    public class Deneme_Sistemi
    {
        [Key]
        public int ID { get; set; }
        public string? İsim { get; set; }
        public string? Soyisim { get; set; }
        public readonly string? Sinif_Sube = "11/G";
        public int Numara { get; set; }
    }
}
