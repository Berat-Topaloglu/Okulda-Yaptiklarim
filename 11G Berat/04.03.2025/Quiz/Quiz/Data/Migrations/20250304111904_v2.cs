using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace Quiz.Data.Migrations
{
    /// <inheritdoc />
    public partial class v2 : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "Okul",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Okul_Adi = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Okul_Kategorisi = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Sehir = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Ogrenci_Sayisi = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Okul", x => x.ID);
                });
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "Okul");
        }
    }
}
