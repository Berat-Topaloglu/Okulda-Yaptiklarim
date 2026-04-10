using System.ComponentModel.DataAnnotations;

namespace Quiz.Models
{
    public class Tatil
    {
        [Key]
        public int ID { get; set; }
        public string? Sehir { get; set; }
        public string? Otel_Adi { get; set; }
        public float Ucret { get; set; }
        public float Tarih { get; set; }
    }
}
