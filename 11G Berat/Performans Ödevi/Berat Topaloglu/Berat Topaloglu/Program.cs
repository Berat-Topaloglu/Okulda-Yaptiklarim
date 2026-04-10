using Microsoft.EntityFrameworkCore;
using Microsoft.Extensions.DependencyInjection;
using Berat_Topaloglu.Data;
var builder = WebApplication.CreateBuilder(args);
builder.Services.AddDbContext<Berat_TopalogluContext>(options =>
    options.UseSqlServer(builder.Configuration.GetConnectionString("Berat_TopalogluContext") ?? throw new InvalidOperationException("Connection string 'Berat_TopalogluContext' not found.")));

// Add services to the container.
builder.Services.AddControllersWithViews();

var app = builder.Build();

// Configure the HTTP request pipeline.
if (!app.Environment.IsDevelopment())
{
    app.UseExceptionHandler("/Home/Error");
    // The default HSTS value is 30 days. You may want to change this for production scenarios, see https://aka.ms/aspnetcore-hsts.
    app.UseHsts();
}

app.UseHttpsRedirection();
app.UseRouting();

app.UseAuthorization();

app.MapStaticAssets();

app.MapControllerRoute(
    name: "default",
    pattern: "{controller=My_Site}/{action=Ana_Sayfa}/{id?}")
    .WithStaticAssets();


app.Run();
