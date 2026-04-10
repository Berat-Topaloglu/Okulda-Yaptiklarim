using Kullanici_Kayit.Entity;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Kullanici_Kayit.Context
{
    public class MyContext:DbContext
    {
        public MyContext():base("sqlim")
        {

        }
        public DbSet<kullanici_kayit> Kullanici_Kayits { get; set; }
    }
}
