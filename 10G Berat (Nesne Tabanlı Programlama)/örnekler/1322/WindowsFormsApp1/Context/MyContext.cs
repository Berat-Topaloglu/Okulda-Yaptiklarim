using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using WindowsFormsApp1.Entity;

namespace WindowsFormsApp1.Context
{
    public class MyContext:DbContext
    {
        public MyContext():base("sqlim")
        {

        }
        public DbSet<Araba> Arabalar { get; set; }
    }
}
