using System.ComponentModel.DataAnnotations;

namespace Berat__Topaloglu.Models
{
    public class My_Site
    {

        [Key]
        public int ID { get; set; }
        public string? Name { get; set; }
        public string? Surname { get; set; }
        public string? E_Mail { get; set; }
    }
}
