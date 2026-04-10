using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace Ornk.Data.Migrations
{
    /// <inheritdoc />
    public partial class v2 : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "Menü",
                columns: table => new
                {
                    Yemek_ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Yemek_Turu = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Yemek_Adi = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Yemek_Ucreti = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Menü", x => x.Yemek_ID);
                });
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "Menü");
        }
    }
}
