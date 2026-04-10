using System.ComponentModel.DataAnnotations;

namespace Quiz.Models
{
    public class Kamp
    {
        [Key]
        public int ID { get; set; }
        public string? Kamp_Adi { get; set; }
        public int Kişi_Sayisi { get; set; }
        public float Ucret { get; set; }
    }
}
