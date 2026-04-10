using System.ComponentModel.DataAnnotations;

namespace Quiz.Models
{
    public class Uye
    {
        [Key]
        public int ID { get; set; }
        public string? Ad { get; set; }
        public string? Soyad { get; set; }
        public DateTime Kayit_Tarihi { get; set; }
        public int Yas { get; set; }
    }
}
