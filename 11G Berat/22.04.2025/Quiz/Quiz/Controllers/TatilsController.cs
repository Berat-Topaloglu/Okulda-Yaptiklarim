using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using Quiz.Data;
using Quiz.Models;

namespace Quiz.Controllers
{
    public class TatilsController : Controller
    {
        private readonly ApplicationDbContext _context;

        public TatilsController(ApplicationDbContext context)
        {
            _context = context;
        }

        // GET: Tatils
        public async Task<IActionResult> Index()
        {
            return View(await _context.Tatil.ToListAsync());
        }

        // GET: Tatils/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var tatil = await _context.Tatil
                .FirstOrDefaultAsync(m => m.ID == id);
            if (tatil == null)
            {
                return NotFound();
            }

            return View(tatil);
        }

        // GET: Tatils/Create
        public IActionResult Create()
        {
            return View();
        }
        public IActionResult Index2()
        {
            return View();
        }

        // POST: Tatils/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("ID,Sehir,Otel_Adi,Ucret,Tarih")] Tatil tatil)
        {
            if (ModelState.IsValid)
            {
                _context.Add(tatil);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            return View(tatil);
        }

        // GET: Tatils/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var tatil = await _context.Tatil.FindAsync(id);
            if (tatil == null)
            {
                return NotFound();
            }
            return View(tatil);
        }

        // POST: Tatils/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("ID,Sehir,Otel_Adi,Ucret,Tarih")] Tatil tatil)
        {
            if (id != tatil.ID)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(tatil);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!TatilExists(tatil.ID))
                    {
                        return NotFound();
                    }
                    else
                    {
                        throw;
                    }
                }
                return RedirectToAction(nameof(Index));
            }
            return View(tatil);
        }

        // GET: Tatils/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var tatil = await _context.Tatil
                .FirstOrDefaultAsync(m => m.ID == id);
            if (tatil == null)
            {
                return NotFound();
            }

            return View(tatil);
        }

        // POST: Tatils/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var tatil = await _context.Tatil.FindAsync(id);
            if (tatil != null)
            {
                _context.Tatil.Remove(tatil);
            }

            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool TatilExists(int id)
        {
            return _context.Tatil.Any(e => e.ID == id);
        }
    }
}
