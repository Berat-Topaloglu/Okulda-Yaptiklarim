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
                name: "Kamp",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Kamp_Adi = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Kişi_Sayisi = table.Column<int>(type: "int", nullable: false),
                    Ucret = table.Column<float>(type: "real", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Kamp", x => x.ID);
                });
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "Kamp");
        }
    }
}
