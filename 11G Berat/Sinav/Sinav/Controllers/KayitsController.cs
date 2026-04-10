using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using Sinav.Data;
using Sinav.Models;

namespace Sinav.Controllers
{
    public class KayitsController : Controller
    {
        private readonly ApplicationDbContext _context;

        public KayitsController(ApplicationDbContext context)
        {
            _context = context;
        }

        // GET: Kayits
        public async Task<IActionResult> Index()
        {
            return View(await _context.Kayit.ToListAsync());
        }

        // GET: Kayits/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var kayit = await _context.Kayit
                .FirstOrDefaultAsync(m => m.ID == id);
            if (kayit == null)
            {
                return NotFound();
            }

            return View(kayit);
        }

        // GET: Kayits/Create
        public IActionResult Create()
        {
            return View();
        }
        public IActionResult Index2()
        {
            return View();
        }

        // POST: Kayits/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("ID,Ad,Soyad,Numara,Yas")] Kayit kayit)
        {
            if (ModelState.IsValid)
            {
                _context.Add(kayit);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            return View(kayit);
        }

        // GET: Kayits/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var kayit = await _context.Kayit.FindAsync(id);
            if (kayit == null)
            {
                return NotFound();
            }
            return View(kayit);
        }

        // POST: Kayits/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("ID,Ad,Soyad,Numara,Yas")] Kayit kayit)
        {
            if (id != kayit.ID)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(kayit);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!KayitExists(kayit.ID))
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
            return View(kayit);
        }

        // GET: Kayits/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var kayit = await _context.Kayit
                .FirstOrDefaultAsync(m => m.ID == id);
            if (kayit == null)
            {
                return NotFound();
            }

            return View(kayit);
        }

        // POST: Kayits/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var kayit = await _context.Kayit.FindAsync(id);
            if (kayit != null)
            {
                _context.Kayit.Remove(kayit);
            }

            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool KayitExists(int id)
        {
            return _context.Kayit.Any(e => e.ID == id);
        }
    }
}
