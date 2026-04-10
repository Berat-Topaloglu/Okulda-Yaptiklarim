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
    public class OkulsController : Controller
    {
        private readonly ApplicationDbContext _context;

        public OkulsController(ApplicationDbContext context)
        {
            _context = context;
        }

        // GET: Okuls
        public async Task<IActionResult> Index()
        {
            return View(await _context.Okul.ToListAsync());
        }

        // GET: Okuls/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var okul = await _context.Okul
                .FirstOrDefaultAsync(m => m.ID == id);
            if (okul == null)
            {
                return NotFound();
            }

            return View(okul);
        }

        // GET: Okuls/Create
        public IActionResult Create()
        {
            return View();
        }
        public IActionResult Index2()
        {
            return View();
        }

        // POST: Okuls/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("ID,Okul_Adi,Okul_Kategorisi,Sehir,Ogrenci_Sayisi")] Okul okul)
        {
            if (ModelState.IsValid)
            {
                _context.Add(okul);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            return View(okul);
        }

        // GET: Okuls/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var okul = await _context.Okul.FindAsync(id);
            if (okul == null)
            {
                return NotFound();
            }
            return View(okul);
        }

        // POST: Okuls/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("ID,Okul_Adi,Okul_Kategorisi,Sehir,Ogrenci_Sayisi")] Okul okul)
        {
            if (id != okul.ID)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(okul);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!OkulExists(okul.ID))
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
            return View(okul);
        }

        // GET: Okuls/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var okul = await _context.Okul
                .FirstOrDefaultAsync(m => m.ID == id);
            if (okul == null)
            {
                return NotFound();
            }

            return View(okul);
        }

        // POST: Okuls/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var okul = await _context.Okul.FindAsync(id);
            if (okul != null)
            {
                _context.Okul.Remove(okul);
            }

            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool OkulExists(int id)
        {
            return _context.Okul.Any(e => e.ID == id);
        }
    }
}
