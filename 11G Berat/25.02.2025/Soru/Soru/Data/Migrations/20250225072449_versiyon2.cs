using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace Soru.Data.Migrations
{
    /// <inheritdoc />
    public partial class versiyon2 : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "Deneme_Sistemi",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    İsim = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Soyisim = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Numara = table.Column<int>(type: "int", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Deneme_Sistemi", x => x.ID);
                });
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "Deneme_Sistemi");
        }
    }
}
