using deneme.Entity;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace deneme.Context
{
    public class Mycontext:DbContext
    {
        public Mycontext():base("sqlim")
        {

        }
        public DbSet<Bolum> bolumler { get; set; }
    }
}
