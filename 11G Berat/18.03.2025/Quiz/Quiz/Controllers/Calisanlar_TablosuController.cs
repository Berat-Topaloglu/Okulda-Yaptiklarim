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
    public class Calisanlar_TablosuController : Controller
    {
        private readonly ApplicationDbContext _context;

        public Calisanlar_TablosuController(ApplicationDbContext context)
        {
            _context = context;
        }

        // GET: Calisanlar_Tablosu
        public async Task<IActionResult> Index()
        {
            return View(await _context.Calisanlar_Tablosu.ToListAsync());
        }

        // GET: Calisanlar_Tablosu/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var calisanlar_Tablosu = await _context.Calisanlar_Tablosu
                .FirstOrDefaultAsync(m => m.ID == id);
            if (calisanlar_Tablosu == null)
            {
                return NotFound();
            }

            return View(calisanlar_Tablosu);
        }

        // GET: Calisanlar_Tablosu/Create
        public IActionResult Create()
        {
            return View();
        }
        public IActionResult Index2()
        {
            return View();
        }

        // POST: Calisanlar_Tablosu/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("ID,Calisan_Adi,Bolumu,Adresi")] Calisanlar_Tablosu calisanlar_Tablosu)
        {
            if (ModelState.IsValid)
            {
                _context.Add(calisanlar_Tablosu);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            return View(calisanlar_Tablosu);
        }

        // GET: Calisanlar_Tablosu/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var calisanlar_Tablosu = await _context.Calisanlar_Tablosu.FindAsync(id);
            if (calisanlar_Tablosu == null)
            {
                return NotFound();
            }
            return View(calisanlar_Tablosu);
        }

        // POST: Calisanlar_Tablosu/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("ID,Calisan_Adi,Bolumu,Adresi")] Calisanlar_Tablosu calisanlar_Tablosu)
        {
            if (id != calisanlar_Tablosu.ID)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(calisanlar_Tablosu);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!Calisanlar_TablosuExists(calisanlar_Tablosu.ID))
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
            return View(calisanlar_Tablosu);
        }

        // GET: Calisanlar_Tablosu/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var calisanlar_Tablosu = await _context.Calisanlar_Tablosu
                .FirstOrDefaultAsync(m => m.ID == id);
            if (calisanlar_Tablosu == null)
            {
                return NotFound();
            }

            return View(calisanlar_Tablosu);
        }

        // POST: Calisanlar_Tablosu/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var calisanlar_Tablosu = await _context.Calisanlar_Tablosu.FindAsync(id);
            if (calisanlar_Tablosu != null)
            {
                _context.Calisanlar_Tablosu.Remove(calisanlar_Tablosu);
            }

            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool Calisanlar_TablosuExists(int id)
        {
            return _context.Calisanlar_Tablosu.Any(e => e.ID == id);
        }
    }
}
