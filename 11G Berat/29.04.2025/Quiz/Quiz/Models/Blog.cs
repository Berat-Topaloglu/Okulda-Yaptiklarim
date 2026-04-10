using System.ComponentModel.DataAnnotations;

namespace Quiz.Models
{
    public class Blog
    {
        [Key]
        public int ID { get; set; }
        public string? Isim { get; set; }
        public string? Soyisim { get; set; }
        public int Yas { get; set; }
        public string? Dogum_Yeri { get; set; }
    }
}
