using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.EntityFrameworkCore;
using Quiz.Models;

namespace Quiz.Data
{
    public class QuizContext : DbContext
    {
        public QuizContext (DbContextOptions<QuizContext> options)
            : base(options)
        {
        }

        public DbSet<Quiz.Models.Uye> Uye { get; set; } = default!;
    }
}
