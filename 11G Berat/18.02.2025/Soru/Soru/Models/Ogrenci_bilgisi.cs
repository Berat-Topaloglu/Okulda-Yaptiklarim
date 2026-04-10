using System.ComponentModel.DataAnnotations;

namespace Soru.Models
{
    public class Ogrenci_bilgisi
    {
        [Key]
        public int ID { get; set; }
        public string? İsim { get; set; }
        public string? Soyisim { get; set; }
        public string? Sınıf { get; set; }
        public int Şube { get; set; }
        public int Numara { get; set; }
    }
}
