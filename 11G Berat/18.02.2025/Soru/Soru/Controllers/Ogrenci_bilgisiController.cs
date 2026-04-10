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
    public class Ogrenci_bilgisiController : Controller
    {
        private readonly ApplicationDbContext _context;

        public Ogrenci_bilgisiController(ApplicationDbContext context)
        {
            _context = context;
        }

        // GET: Ogrenci_bilgisi
        public async Task<IActionResult> Index()
        {
            return View(await _context.Ogrenci_bilgisi.ToListAsync());
        }

        // GET: Ogrenci_bilgisi/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var ogrenci_bilgisi = await _context.Ogrenci_bilgisi
                .FirstOrDefaultAsync(m => m.ID == id);
            if (ogrenci_bilgisi == null)
            {
                return NotFound();
            }

            return View(ogrenci_bilgisi);
        }

        // GET: Ogrenci_bilgisi/Create
        public IActionResult Create()
        {
            return View();
        }

        // POST: Ogrenci_bilgisi/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("ID,İsim,Soyisim,Sınıf,Şube,Numara")] Ogrenci_bilgisi ogrenci_bilgisi)
        {
            if (ModelState.IsValid)
            {
                _context.Add(ogrenci_bilgisi);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            return View(ogrenci_bilgisi);
        }

        // GET: Ogrenci_bilgisi/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var ogrenci_bilgisi = await _context.Ogrenci_bilgisi.FindAsync(id);
            if (ogrenci_bilgisi == null)
            {
                return NotFound();
            }
            return View(ogrenci_bilgisi);
        }

        // POST: Ogrenci_bilgisi/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("ID,İsim,Soyisim,Sınıf,Şube,Numara")] Ogrenci_bilgisi ogrenci_bilgisi)
        {
            if (id != ogrenci_bilgisi.ID)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(ogrenci_bilgisi);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!Ogrenci_bilgisiExists(ogrenci_bilgisi.ID))
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
            return View(ogrenci_bilgisi);
        }

        // GET: Ogrenci_bilgisi/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var ogrenci_bilgisi = await _context.Ogrenci_bilgisi
                .FirstOrDefaultAsync(m => m.ID == id);
            if (ogrenci_bilgisi == null)
            {
                return NotFound();
            }

            return View(ogrenci_bilgisi);
        }

        // POST: Ogrenci_bilgisi/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var ogrenci_bilgisi = await _context.Ogrenci_bilgisi.FindAsync(id);
            if (ogrenci_bilgisi != null)
            {
                _context.Ogrenci_bilgisi.Remove(ogrenci_bilgisi);
            }

            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool Ogrenci_bilgisiExists(int id)
        {
            return _context.Ogrenci_bilgisi.Any(e => e.ID == id);
        }
    }
}
