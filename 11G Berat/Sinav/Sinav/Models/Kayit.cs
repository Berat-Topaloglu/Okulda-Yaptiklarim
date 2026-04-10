using System.ComponentModel.DataAnnotations;

namespace Sinav.Models
{
    public class Kayit
    {
        [Key]
        public int ID { get; set; }
        public string? Ad { get; set; }
        public string? Soyad { get; set; }
        public int Numara { get; set; }
        public int Yas { get; set; }
    }
}
