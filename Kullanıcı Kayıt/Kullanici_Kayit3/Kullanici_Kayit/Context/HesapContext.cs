using Kullanici_Kayit.Entity;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Kullanici_Kayit.Context
{
    public class HesapContext : DbContext
    {
        public HesapContext():base("sqlim")
        {

        }
        public DbSet<hesap_kayit> Hesap_Kayits { get; set; }
    }
}
