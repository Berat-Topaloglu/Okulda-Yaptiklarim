using masaustusql.Entity;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace masaustusql.Context
{
    public class MyContext:DbContext
    {
        public MyContext():base("sqlim")
        { 
        
        }
        public DbSet<Stok>urunler { get; set; }
    }
}
