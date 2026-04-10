using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.EntityFrameworkCore;
using Berat_Topaloglu.Models;

namespace Berat_Topaloglu.Data
{
    public class Berat_TopalogluContext : DbContext
    {
        public Berat_TopalogluContext (DbContextOptions<Berat_TopalogluContext> options)
            : base(options)
        {
        }

        public DbSet<Berat_Topaloglu.Models.My_Site> My_Site { get; set; } = default!;
    }
}
