using System.ComponentModel.DataAnnotations;

namespace Ornk.Models
{
    public class Menü
    {
        [Key]
        public int Yemek_ID { get; set; }
        public string? Yemek_Turu { get; set; }
        public string? Yemek_Adi { get; set; }
        public string? Yemek_Ucreti { get; set; }
    }
}
