using soru.entity;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace soru.context
{
    public class Mycontext:DbContext
    {
        public Mycontext():base("sqlim")
        {

        }
        public DbSet<okul_sistemi> e_okuls { get; set; }
    }
}
