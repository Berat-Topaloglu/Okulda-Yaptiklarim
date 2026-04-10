using System.ComponentModel.DataAnnotations;

namespace Quiz.Models
{
    public class Okul
    {
        [Key]
        public int ID { get; set; }
        public string? Okul_Adi { get; set; }
        public string? Okul_Kategorisi { get; set; }
        public string? Sehir { get; set; }
        public string? Ogrenci_Sayisi { get; set; }
    }
}
