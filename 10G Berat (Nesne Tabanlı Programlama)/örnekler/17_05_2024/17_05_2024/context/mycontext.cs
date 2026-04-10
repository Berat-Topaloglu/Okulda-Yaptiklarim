using _17_05_2024.entity;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace _17_05_2024.context
{
    internal class mycontext:DbContext
    {
        public mycontext() : base("araba")
        {

        }
        public DbSet<araba> arabalar { get; set; }
    }
}
