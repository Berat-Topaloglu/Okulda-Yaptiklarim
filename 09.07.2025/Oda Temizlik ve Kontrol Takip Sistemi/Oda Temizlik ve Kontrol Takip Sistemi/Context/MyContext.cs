using Oda_Temizlik_ve_Kontrol_Takip_Sistemi.Entity;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Oda_Temizlik_ve_Kontrol_Takip_Sistemi.Context
{
    public class MyContext:DbContext
    {
        public MyContext():base("sqlim")
        {

        }
        public DbSet<oda_Temizlik_ve_Kontrol_Takip_Sistemi> oda_temizlik_ve_kontrol_takip_sistemis { get; set; }
    }
}
