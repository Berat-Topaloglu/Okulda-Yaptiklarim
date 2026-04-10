using System.ComponentModel.DataAnnotations;

namespace Soru.Models
{
    public class Kahve
    {
        [Key]
        public int ID { get; set; }
        public int Siparis_No { get; set; }
        public string? Kahve_Turu { get; set; }
        public float Ucret { get; set; }
    }
}
