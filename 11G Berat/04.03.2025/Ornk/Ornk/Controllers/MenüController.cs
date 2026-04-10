using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using Ornk.Data;
using Ornk.Models;

namespace Ornk.Controllers
{
    public class MenüController : Controller
    {
        private readonly ApplicationDbContext _context;

        public MenüController(ApplicationDbContext context)
        {
            _context = context;
        }

        // GET: Menü
        public async Task<IActionResult> Index()
        {
            return View(await _context.Menü.ToListAsync());
        }

        // GET: Menü/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var menü = await _context.Menü
                .FirstOrDefaultAsync(m => m.Yemek_ID == id);
            if (menü == null)
            {
                return NotFound();
            }

            return View(menü);
        }

        // GET: Menü/Create
        public IActionResult Create()
        {
            return View();
        }
        public IActionResult Index2()
        {
            return View();
        }

        // POST: Menü/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("Yemek_ID,Yemek_Turu,Yemek_Adi,Yemek_Ucreti")] Menü menü)
        {
            if (ModelState.IsValid)
            {
                _context.Add(menü);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            return View(menü);
        }

        // GET: Menü/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var menü = await _context.Menü.FindAsync(id);
            if (menü == null)
            {
                return NotFound();
            }
            return View(menü);
        }

        // POST: Menü/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("Yemek_ID,Yemek_Turu,Yemek_Adi,Yemek_Ucreti")] Menü menü)
        {
            if (id != menü.Yemek_ID)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(menü);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!MenüExists(menü.Yemek_ID))
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
            return View(menü);
        }

        // GET: Menü/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var menü = await _context.Menü
                .FirstOrDefaultAsync(m => m.Yemek_ID == id);
            if (menü == null)
            {
                return NotFound();
            }

            return View(menü);
        }

        // POST: Menü/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var menü = await _context.Menü.FindAsync(id);
            if (menü != null)
            {
                _context.Menü.Remove(menü);
            }

            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool MenüExists(int id)
        {
            return _context.Menü.Any(e => e.Yemek_ID == id);
        }
    }
}
