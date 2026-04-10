using soru2.Entity;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace soru2.Context
{
    public class MyContext:DbContext
    {
        public MyContext():base("Sqlim")
        {

        }
        public DbSet<Araclar> aracs { get; set; }
    }
}
