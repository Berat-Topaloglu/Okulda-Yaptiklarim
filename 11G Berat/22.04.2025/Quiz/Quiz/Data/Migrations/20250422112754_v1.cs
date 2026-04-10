using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace Quiz.Data.Migrations
{
    /// <inheritdoc />
    public partial class v1 : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "Tatil",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Sehir = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Otel_Adi = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Ucret = table.Column<float>(type: "real", nullable: false),
                    Tarih = table.Column<float>(type: "real", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Tatil", x => x.ID);
                });
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "Tatil");
        }
    }
}
