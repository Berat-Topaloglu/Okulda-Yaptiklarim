using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.EntityFrameworkCore;
using Berat__Topaloglu.Models;

namespace Berat__Topaloglu.Data
{
    public class Berat__TopalogluContext : DbContext
    {
        public Berat__TopalogluContext (DbContextOptions<Berat__TopalogluContext> options)
            : base(options)
        {
        }

        public DbSet<Berat__Topaloglu.Models.My_Site> My_Site { get; set; } = default!;
    }
}
