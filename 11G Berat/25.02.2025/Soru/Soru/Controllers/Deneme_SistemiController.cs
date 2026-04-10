using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using Soru.Data;
using Soru.Models;

namespace Soru.Controllers
{
    public class Deneme_SistemiController : Controller
    {
        private readonly ApplicationDbContext _context;

        public Deneme_SistemiController(ApplicationDbContext context)
        {
            _context = context;
        }

        // GET: Deneme_Sistemi
        public async Task<IActionResult> Index()
        {
            return View(await _context.Deneme_Sistemi.ToListAsync());
        }

        // GET: Deneme_Sistemi/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var deneme_Sistemi = await _context.Deneme_Sistemi
                .FirstOrDefaultAsync(m => m.ID == id);
            if (deneme_Sistemi == null)
            {
                return NotFound();
            }

            return View(deneme_Sistemi);
        }

        // GET: Deneme_Sistemi/Create
        public IActionResult Create()
        {
            return View();
        }

        // POST: Deneme_Sistemi/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("ID,İsim,Soyisim,Numara")] Deneme_Sistemi deneme_Sistemi)
        {
            if (ModelState.IsValid)
            {
                _context.Add(deneme_Sistemi);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            return View(deneme_Sistemi);
        }

        // GET: Deneme_Sistemi/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var deneme_Sistemi = await _context.Deneme_Sistemi.FindAsync(id);
            if (deneme_Sistemi == null)
            {
                return NotFound();
            }
            return View(deneme_Sistemi);
        }

        // POST: Deneme_Sistemi/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("ID,İsim,Soyisim,Numara")] Deneme_Sistemi deneme_Sistemi)
        {
            if (id != deneme_Sistemi.ID)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(deneme_Sistemi);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!Deneme_SistemiExists(deneme_Sistemi.ID))
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
            return View(deneme_Sistemi);
        }

        // GET: Deneme_Sistemi/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var deneme_Sistemi = await _context.Deneme_Sistemi
                .FirstOrDefaultAsync(m => m.ID == id);
            if (deneme_Sistemi == null)
            {
                return NotFound();
            }

            return View(deneme_Sistemi);
        }

        // POST: Deneme_Sistemi/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var deneme_Sistemi = await _context.Deneme_Sistemi.FindAsync(id);
            if (deneme_Sistemi != null)
            {
                _context.Deneme_Sistemi.Remove(deneme_Sistemi);
            }

            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool Deneme_SistemiExists(int id)
        {
            return _context.Deneme_Sistemi.Any(e => e.ID == id);
        }
        public IActionResult Hocama_Saygilar()
        {
            return View();
        }
    }
}
