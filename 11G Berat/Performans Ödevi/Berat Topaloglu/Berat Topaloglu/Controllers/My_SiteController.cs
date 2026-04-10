using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using Berat_Topaloglu.Data;
using Berat_Topaloglu.Models;

namespace Berat_Topaloglu.Controllers
{
    public class My_SiteController : Controller
    {
        private readonly Berat_TopalogluContext _context;

        public My_SiteController(Berat_TopalogluContext context)
        {
            _context = context;
        }

        // GET: My_Site
        public async Task<IActionResult> Index()
        {
            return View(await _context.My_Site.ToListAsync());
        }

        // GET: My_Site/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var my_Site = await _context.My_Site
                .FirstOrDefaultAsync(m => m.ID == id);
            if (my_Site == null)
            {
                return NotFound();
            }

            return View(my_Site);
        }

        // GET: My_Site/Create
        public IActionResult Create()
        {
            return View();
        }
        public IActionResult Ana_Sayfa()
        {
            return View();
        }
        public IActionResult Hakkimda()
        {
            return View();
        }

        // POST: My_Site/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("ID,Name,Surname,E_Mail")] My_Site my_Site)
        {
            if (ModelState.IsValid)
            {
                _context.Add(my_Site);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            return View(my_Site);
        }

        // GET: My_Site/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var my_Site = await _context.My_Site.FindAsync(id);
            if (my_Site == null)
            {
                return NotFound();
            }
            return View(my_Site);
        }

        // POST: My_Site/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("ID,Name,Surname,E_Mail")] My_Site my_Site)
        {
            if (id != my_Site.ID)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(my_Site);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!My_SiteExists(my_Site.ID))
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
            return View(my_Site);
        }

        // GET: My_Site/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var my_Site = await _context.My_Site
                .FirstOrDefaultAsync(m => m.ID == id);
            if (my_Site == null)
            {
                return NotFound();
            }

            return View(my_Site);
        }

        // POST: My_Site/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var my_Site = await _context.My_Site.FindAsync(id);
            if (my_Site != null)
            {
                _context.My_Site.Remove(my_Site);
            }

            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool My_SiteExists(int id)
        {
            return _context.My_Site.Any(e => e.ID == id);
        }
    }
}
