using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace Soru.Data.Migrations
{
    /// <inheritdoc />
    public partial class Versiyon : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "Ogrenci_bilgisi",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    İsim = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Soyisim = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Sınıf = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Şube = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Numara = table.Column<int>(type: "int", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Ogrenci_bilgisi", x => x.ID);
                });
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "Ogrenci_bilgisi");
        }
    }
}
