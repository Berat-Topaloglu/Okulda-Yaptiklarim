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
    public class KahvesController : Controller
    {
        private readonly ApplicationDbContext _context;

        public KahvesController(ApplicationDbContext context)
        {
            _context = context;
        }

        // GET: Kahves
        public async Task<IActionResult> Index()
        {
            return View(await _context.Kahve.ToListAsync());
        }

        // GET: Kahves/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var kahve = await _context.Kahve
                .FirstOrDefaultAsync(m => m.ID == id);
            if (kahve == null)
            {
                return NotFound();
            }

            return View(kahve);
        }

        // GET: Kahves/Create
        public IActionResult Create()
        {
            return View();
        }
        public IActionResult Index2()
        {
            return View();
        }

        // POST: Kahves/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("ID,Siparis_No,Kahve_Turu,Ucret")] Kahve kahve)
        {
            if (ModelState.IsValid)
            {
                _context.Add(kahve);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            return View(kahve);
        }

        // GET: Kahves/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var kahve = await _context.Kahve.FindAsync(id);
            if (kahve == null)
            {
                return NotFound();
            }
            return View(kahve);
        }

        // POST: Kahves/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("ID,Siparis_No,Kahve_Turu,Ucret")] Kahve kahve)
        {
            if (id != kahve.ID)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(kahve);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!KahveExists(kahve.ID))
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
            return View(kahve);
        }

        // GET: Kahves/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var kahve = await _context.Kahve
                .FirstOrDefaultAsync(m => m.ID == id);
            if (kahve == null)
            {
                return NotFound();
            }

            return View(kahve);
        }

        // POST: Kahves/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var kahve = await _context.Kahve.FindAsync(id);
            if (kahve != null)
            {
                _context.Kahve.Remove(kahve);
            }

            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool KahveExists(int id)
        {
            return _context.Kahve.Any(e => e.ID == id);
        }
    }
}
