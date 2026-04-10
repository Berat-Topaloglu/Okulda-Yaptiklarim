using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace Soru.Data.Migrations
{
    /// <inheritdoc />
    public partial class v1 : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "Kahve",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Siparis_No = table.Column<int>(type: "int", nullable: false),
                    Kahve_Turu = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Ucret = table.Column<float>(type: "real", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Kahve", x => x.ID);
                });
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "Kahve");
        }
    }
}
