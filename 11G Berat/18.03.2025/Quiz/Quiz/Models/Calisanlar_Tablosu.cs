using System.ComponentModel.DataAnnotations;

namespace Quiz.Models
{
    public class Calisanlar_Tablosu
    {
        [Key]
        public int ID { get; set; }
        public string? Calisan_Adi { get; set; }
        public string? Bolumu { get; set; }
        public int Adresi { get; set; }
    }
}
