namespace Araba_kıralama_programı
{
    partial class Form1
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.plaka = new System.Windows.Forms.TextBox();
            this.marka = new System.Windows.Forms.ComboBox();
            this.label3 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.kasatipi = new System.Windows.Forms.ComboBox();
            this.model = new System.Windows.Forms.TextBox();
            this.label6 = new System.Windows.Forms.Label();
            this.label7 = new System.Windows.Forms.Label();
            this.yakitturu = new System.Windows.Forms.ComboBox();
            this.kiraucreti = new System.Windows.Forms.TextBox();
            this.label8 = new System.Windows.Forms.Label();
            this.label9 = new System.Windows.Forms.Label();
            this.renk = new System.Windows.Forms.ComboBox();
            this.km = new System.Windows.Forms.TextBox();
            this.dataGridView1 = new System.Windows.Forms.DataGridView();
            this.button6 = new System.Windows.Forms.Button();
            this.button4 = new System.Windows.Forms.Button();
            this.button3 = new System.Windows.Forms.Button();
            this.button2 = new System.Windows.Forms.Button();
            this.button1 = new System.Windows.Forms.Button();
            this.pictureBox1 = new System.Windows.Forms.PictureBox();
            this.label11 = new System.Windows.Forms.Label();
            this.aresmi = new System.Windows.Forms.TextBox();
            this.label12 = new System.Windows.Forms.Label();
            this.durum = new System.Windows.Forms.ComboBox();
            this.openFileDialog1 = new System.Windows.Forms.OpenFileDialog();
            this.uretimyili = new System.Windows.Forms.TextBox();
            this.label5 = new System.Windows.Forms.Label();
            this.sira = new System.Windows.Forms.TextBox();
            this.label14 = new System.Windows.Forms.Label();
            this.label10 = new System.Windows.Forms.Label();
            this.label13 = new System.Windows.Forms.Label();
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView1)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.pictureBox1)).BeginInit();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Microsoft Sans Serif", 11F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.label1.ForeColor = System.Drawing.Color.Red;
            this.label1.Location = new System.Drawing.Point(25, 127);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(50, 18);
            this.label1.TabIndex = 0;
            this.label1.Text = "marka";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Microsoft Sans Serif", 11F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.label2.ForeColor = System.Drawing.Color.Red;
            this.label2.Location = new System.Drawing.Point(32, 150);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(43, 18);
            this.label2.TabIndex = 1;
            this.label2.Text = "plaka";
            // 
            // plaka
            // 
            this.plaka.BackColor = System.Drawing.Color.Silver;
            this.plaka.Font = new System.Drawing.Font("Microsoft Sans Serif", 6F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.plaka.Location = new System.Drawing.Point(81, 153);
            this.plaka.Name = "plaka";
            this.plaka.Size = new System.Drawing.Size(77, 17);
            this.plaka.TabIndex = 3;
            this.plaka.TextChanged += new System.EventHandler(this.plaka_TextChanged);
            // 
            // marka
            // 
            this.marka.BackColor = System.Drawing.Color.Silver;
            this.marka.Font = new System.Drawing.Font("Microsoft Sans Serif", 6F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.marka.FormattingEnabled = true;
            this.marka.Items.AddRange(new object[] {
            "BMW",
            "MERCEDES",
            "OPEL",
            "RENAULT",
            "HYUNDAİ",
            "TOYOTA",
            "GEELY",
            "SKODA",
            "FİAT",
            "FORD",
            "AUDİ",
            "MAZDA",
            "HONDA",
            "NİSSAN",
            "SEAT",
            "PEUGEOT",
            "VOLVO",
            "CITROEN"});
            this.marka.Location = new System.Drawing.Point(81, 127);
            this.marka.Name = "marka";
            this.marka.Size = new System.Drawing.Size(77, 17);
            this.marka.TabIndex = 4;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(64)))), ((int)(((byte)(64)))), ((int)(((byte)(64)))));
            this.label3.Font = new System.Drawing.Font("Microsoft Sans Serif", 11F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.label3.ForeColor = System.Drawing.Color.Red;
            this.label3.Location = new System.Drawing.Point(26, 171);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(49, 18);
            this.label3.TabIndex = 5;
            this.label3.Text = "model";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(64)))), ((int)(((byte)(64)))), ((int)(((byte)(64)))));
            this.label4.Font = new System.Drawing.Font("Microsoft Sans Serif", 11F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.label4.ForeColor = System.Drawing.Color.Red;
            this.label4.Location = new System.Drawing.Point(13, 196);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(62, 18);
            this.label4.TabIndex = 6;
            this.label4.Text = "kasa tipi";
            // 
            // kasatipi
            // 
            this.kasatipi.BackColor = System.Drawing.Color.Silver;
            this.kasatipi.Font = new System.Drawing.Font("Microsoft Sans Serif", 6F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.kasatipi.FormattingEnabled = true;
            this.kasatipi.Items.AddRange(new object[] {
            "",
            "hatback",
            "sedan",
            "    Station Wagon",
            "Sedan",
            "  Sedan",
            "sedan",
            "  Sedan",
            "  Hatchback 5 kapı",
            "  Hatchback 5 kapı",
            "sedan",
            "sedan",
            "power",
            "sedan",
            "  Station Wagon",
            "  Hatchback 5 kapı",
            "sedan",
            "sedan",
            "sedan",
            "  Hatchback 5 kapı",
            "sedan"});
            this.kasatipi.Location = new System.Drawing.Point(81, 199);
            this.kasatipi.Name = "kasatipi";
            this.kasatipi.Size = new System.Drawing.Size(77, 17);
            this.kasatipi.TabIndex = 7;
            // 
            // model
            // 
            this.model.BackColor = System.Drawing.Color.Silver;
            this.model.Font = new System.Drawing.Font("Microsoft Sans Serif", 6F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.model.Location = new System.Drawing.Point(81, 176);
            this.model.Name = "model";
            this.model.Size = new System.Drawing.Size(77, 17);
            this.model.TabIndex = 8;
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Font = new System.Drawing.Font("Microsoft Sans Serif", 11F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.label6.ForeColor = System.Drawing.Color.Red;
            this.label6.Location = new System.Drawing.Point(11, 296);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(67, 18);
            this.label6.TabIndex = 11;
            this.label6.Text = "yakıt türü";
            // 
            // label7
            // 
            this.label7.AutoSize = true;
            this.label7.Font = new System.Drawing.Font("Microsoft Sans Serif", 11F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.label7.ForeColor = System.Drawing.Color.Red;
            this.label7.Location = new System.Drawing.Point(9, 320);
            this.label7.Name = "label7";
            this.label7.Size = new System.Drawing.Size(72, 18);
            this.label7.TabIndex = 12;
            this.label7.Text = "kira ücreti";
            // 
            // yakitturu
            // 
            this.yakitturu.BackColor = System.Drawing.Color.Silver;
            this.yakitturu.Font = new System.Drawing.Font("Microsoft Sans Serif", 6F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.yakitturu.FormattingEnabled = true;
            this.yakitturu.Items.AddRange(new object[] {
            "benzin",
            "lpg",
            "benzin lpg",
            "dizel"});
            this.yakitturu.Location = new System.Drawing.Point(84, 301);
            this.yakitturu.Name = "yakitturu";
            this.yakitturu.Size = new System.Drawing.Size(77, 17);
            this.yakitturu.TabIndex = 13;
            // 
            // kiraucreti
            // 
            this.kiraucreti.BackColor = System.Drawing.Color.Silver;
            this.kiraucreti.Font = new System.Drawing.Font("Microsoft Sans Serif", 6F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.kiraucreti.Location = new System.Drawing.Point(81, 323);
            this.kiraucreti.Name = "kiraucreti";
            this.kiraucreti.Size = new System.Drawing.Size(77, 17);
            this.kiraucreti.TabIndex = 14;
            // 
            // label8
            // 
            this.label8.AutoSize = true;
            this.label8.Font = new System.Drawing.Font("Microsoft Sans Serif", 11F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.label8.ForeColor = System.Drawing.Color.Red;
            this.label8.Location = new System.Drawing.Point(46, 250);
            this.label8.Name = "label8";
            this.label8.Size = new System.Drawing.Size(29, 18);
            this.label8.TabIndex = 15;
            this.label8.Text = "km";
            // 
            // label9
            // 
            this.label9.AutoSize = true;
            this.label9.Font = new System.Drawing.Font("Microsoft Sans Serif", 11F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.label9.ForeColor = System.Drawing.Color.Red;
            this.label9.Location = new System.Drawing.Point(38, 274);
            this.label9.Name = "label9";
            this.label9.Size = new System.Drawing.Size(37, 18);
            this.label9.TabIndex = 16;
            this.label9.Text = "renk";
            // 
            // renk
            // 
            this.renk.BackColor = System.Drawing.Color.Silver;
            this.renk.Font = new System.Drawing.Font("Microsoft Sans Serif", 6F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.renk.FormattingEnabled = true;
            this.renk.Items.AddRange(new object[] {
            "siyah",
            "kırmızı",
            "beyaz",
            "kırmızı",
            "gri",
            "gri",
            "mavi",
            "siyah",
            "yeşil",
            "mor",
            "siyah",
            "mavi",
            "kırmızı",
            "lacivert",
            "siyah",
            "siyah",
            "gri",
            "gri",
            "beyaz",
            "mavi"});
            this.renk.Location = new System.Drawing.Point(81, 278);
            this.renk.Name = "renk";
            this.renk.Size = new System.Drawing.Size(77, 17);
            this.renk.TabIndex = 17;
            // 
            // km
            // 
            this.km.BackColor = System.Drawing.Color.Silver;
            this.km.Font = new System.Drawing.Font("Microsoft Sans Serif", 6F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.km.Location = new System.Drawing.Point(81, 251);
            this.km.Name = "km";
            this.km.Size = new System.Drawing.Size(77, 17);
            this.km.TabIndex = 18;
            // 
            // dataGridView1
            // 
            this.dataGridView1.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dataGridView1.Location = new System.Drawing.Point(28, 372);
            this.dataGridView1.Name = "dataGridView1";
            this.dataGridView1.Size = new System.Drawing.Size(600, 150);
            this.dataGridView1.TabIndex = 25;
            this.dataGridView1.CellEnter += new System.Windows.Forms.DataGridViewCellEventHandler(this.dataGridView1_CellEnter);
            // 
            // button6
            // 
            this.button6.BackgroundImage = global::Araba_kıralama_programı.Properties.Resources.indir__11_;
            this.button6.ForeColor = System.Drawing.Color.Red;
            this.button6.Location = new System.Drawing.Point(396, 122);
            this.button6.Name = "button6";
            this.button6.Size = new System.Drawing.Size(57, 54);
            this.button6.TabIndex = 27;
            this.button6.Text = "kayıt arama";
            this.button6.UseVisualStyleBackColor = true;
            this.button6.Click += new System.EventHandler(this.button6_Click);
            // 
            // button4
            // 
            this.button4.BackgroundImage = global::Araba_kıralama_programı.Properties.Resources.indir__8_;
            this.button4.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.button4.ForeColor = System.Drawing.Color.Red;
            this.button4.Location = new System.Drawing.Point(477, 171);
            this.button4.Name = "button4";
            this.button4.Size = new System.Drawing.Size(66, 59);
            this.button4.TabIndex = 23;
            this.button4.Text = "fotograf yükle";
            this.button4.UseVisualStyleBackColor = true;
            this.button4.Click += new System.EventHandler(this.button4_Click);
            // 
            // button3
            // 
            this.button3.BackgroundImage = global::Araba_kıralama_programı.Properties.Resources.images__1_;
            this.button3.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.button3.ForeColor = System.Drawing.Color.Red;
            this.button3.Location = new System.Drawing.Point(396, 57);
            this.button3.Name = "button3";
            this.button3.Size = new System.Drawing.Size(57, 59);
            this.button3.TabIndex = 22;
            this.button3.Text = "aracı sil";
            this.button3.UseVisualStyleBackColor = true;
            this.button3.Click += new System.EventHandler(this.button3_Click);
            // 
            // button2
            // 
            this.button2.BackgroundImage = global::Araba_kıralama_programı.Properties.Resources.images4;
            this.button2.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.button2.ForeColor = System.Drawing.Color.Red;
            this.button2.Location = new System.Drawing.Point(477, 301);
            this.button2.Name = "button2";
            this.button2.Size = new System.Drawing.Size(66, 65);
            this.button2.TabIndex = 21;
            this.button2.Text = "ekle";
            this.button2.UseVisualStyleBackColor = true;
            this.button2.Click += new System.EventHandler(this.button2_Click);
            // 
            // button1
            // 
            this.button1.BackgroundImage = global::Araba_kıralama_programı.Properties.Resources.indir3;
            this.button1.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.button1.ForeColor = System.Drawing.Color.Red;
            this.button1.Location = new System.Drawing.Point(477, 236);
            this.button1.Name = "button1";
            this.button1.Size = new System.Drawing.Size(66, 59);
            this.button1.TabIndex = 20;
            this.button1.Text = "güncelle";
            this.button1.UseVisualStyleBackColor = true;
            this.button1.Click += new System.EventHandler(this.button1_Click);
            // 
            // pictureBox1
            // 
            this.pictureBox1.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(255)))), ((int)(((byte)(192)))), ((int)(((byte)(255)))));
            this.pictureBox1.Location = new System.Drawing.Point(167, 178);
            this.pictureBox1.Name = "pictureBox1";
            this.pictureBox1.Size = new System.Drawing.Size(300, 188);
            this.pictureBox1.TabIndex = 19;
            this.pictureBox1.TabStop = false;
            // 
            // label11
            // 
            this.label11.AutoSize = true;
            this.label11.Font = new System.Drawing.Font("Microsoft Sans Serif", 11F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.label11.ForeColor = System.Drawing.Color.Red;
            this.label11.Location = new System.Drawing.Point(155, 94);
            this.label11.Name = "label11";
            this.label11.Size = new System.Drawing.Size(105, 18);
            this.label11.TabIndex = 28;
            this.label11.Text = "arabanın resmi";
            // 
            // aresmi
            // 
            this.aresmi.BackColor = System.Drawing.Color.Silver;
            this.aresmi.Font = new System.Drawing.Font("Microsoft Sans Serif", 6F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.aresmi.Location = new System.Drawing.Point(266, 95);
            this.aresmi.Name = "aresmi";
            this.aresmi.Size = new System.Drawing.Size(77, 17);
            this.aresmi.TabIndex = 29;
            // 
            // label12
            // 
            this.label12.AutoSize = true;
            this.label12.Font = new System.Drawing.Font("Microsoft Sans Serif", 11F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.label12.ForeColor = System.Drawing.Color.Red;
            this.label12.Location = new System.Drawing.Point(25, 344);
            this.label12.Name = "label12";
            this.label12.Size = new System.Drawing.Size(50, 18);
            this.label12.TabIndex = 30;
            this.label12.Text = "durum";
            // 
            // durum
            // 
            this.durum.BackColor = System.Drawing.Color.Silver;
            this.durum.Font = new System.Drawing.Font("Microsoft Sans Serif", 6F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.durum.FormattingEnabled = true;
            this.durum.Items.AddRange(new object[] {
            "kiralandı",
            "kiralanmadı"});
            this.durum.Location = new System.Drawing.Point(77, 345);
            this.durum.Name = "durum";
            this.durum.Size = new System.Drawing.Size(81, 17);
            this.durum.TabIndex = 32;
            this.durum.SelectedIndexChanged += new System.EventHandler(this.durum_SelectedIndexChanged);
            // 
            // openFileDialog1
            // 
            this.openFileDialog1.FileName = "openFileDialog1";
            // 
            // uretimyili
            // 
            this.uretimyili.BackColor = System.Drawing.Color.Silver;
            this.uretimyili.Font = new System.Drawing.Font("Microsoft Sans Serif", 6F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.uretimyili.Location = new System.Drawing.Point(81, 228);
            this.uretimyili.Name = "uretimyili";
            this.uretimyili.Size = new System.Drawing.Size(77, 17);
            this.uretimyili.TabIndex = 36;
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(64)))), ((int)(((byte)(64)))), ((int)(((byte)(64)))));
            this.label5.Font = new System.Drawing.Font("Microsoft Sans Serif", 11F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.label5.ForeColor = System.Drawing.Color.Red;
            this.label5.Location = new System.Drawing.Point(6, 225);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(69, 18);
            this.label5.TabIndex = 35;
            this.label5.Text = "üretim yılı";
            // 
            // sira
            // 
            this.sira.BackColor = System.Drawing.Color.Silver;
            this.sira.Font = new System.Drawing.Font("Microsoft Sans Serif", 6F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.sira.Location = new System.Drawing.Point(276, 139);
            this.sira.Name = "sira";
            this.sira.Size = new System.Drawing.Size(103, 17);
            this.sira.TabIndex = 39;
            // 
            // label14
            // 
            this.label14.AutoSize = true;
            this.label14.Font = new System.Drawing.Font("Microsoft Sans Serif", 11F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.label14.ForeColor = System.Drawing.Color.Red;
            this.label14.Location = new System.Drawing.Point(223, 139);
            this.label14.Name = "label14";
            this.label14.Size = new System.Drawing.Size(37, 18);
            this.label14.TabIndex = 40;
            this.label14.Text = "s.no";
            // 
            // label10
            // 
            this.label10.AutoSize = true;
            this.label10.Font = new System.Drawing.Font("Microsoft Sans Serif", 28F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.label10.ForeColor = System.Drawing.Color.Aqua;
            this.label10.Location = new System.Drawing.Point(126, 9);
            this.label10.Name = "label10";
            this.label10.Size = new System.Drawing.Size(449, 44);
            this.label10.TabIndex = 41;
            this.label10.Text = "Araba Kiralama Programı";
            // 
            // label13
            // 
            this.label13.AutoSize = true;
            this.label13.Font = new System.Drawing.Font("Microsoft Sans Serif", 11F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.label13.ForeColor = System.Drawing.Color.Red;
            this.label13.Location = new System.Drawing.Point(641, 504);
            this.label13.Name = "label13";
            this.label13.Size = new System.Drawing.Size(54, 18);
            this.label13.TabIndex = 42;
            this.label13.Text = "label13";
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(64)))), ((int)(((byte)(64)))), ((int)(((byte)(64)))));
            this.ClientSize = new System.Drawing.Size(695, 531);
            this.Controls.Add(this.label13);
            this.Controls.Add(this.label10);
            this.Controls.Add(this.label14);
            this.Controls.Add(this.sira);
            this.Controls.Add(this.uretimyili);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.durum);
            this.Controls.Add(this.label12);
            this.Controls.Add(this.aresmi);
            this.Controls.Add(this.label11);
            this.Controls.Add(this.button6);
            this.Controls.Add(this.dataGridView1);
            this.Controls.Add(this.button4);
            this.Controls.Add(this.button3);
            this.Controls.Add(this.button2);
            this.Controls.Add(this.button1);
            this.Controls.Add(this.pictureBox1);
            this.Controls.Add(this.km);
            this.Controls.Add(this.renk);
            this.Controls.Add(this.label9);
            this.Controls.Add(this.label8);
            this.Controls.Add(this.kiraucreti);
            this.Controls.Add(this.yakitturu);
            this.Controls.Add(this.label7);
            this.Controls.Add(this.label6);
            this.Controls.Add(this.model);
            this.Controls.Add(this.kasatipi);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.marka);
            this.Controls.Add(this.plaka);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Name = "Form1";
            this.Text = "Form1";
            this.Load += new System.EventHandler(this.Form1_Load);
            ((System.ComponentModel.ISupportInitialize)(this.dataGridView1)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.pictureBox1)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox plaka;
        private System.Windows.Forms.ComboBox marka;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.ComboBox kasatipi;
        private System.Windows.Forms.TextBox model;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.Label label7;
        private System.Windows.Forms.ComboBox yakitturu;
        private System.Windows.Forms.TextBox kiraucreti;
        private System.Windows.Forms.Label label8;
        private System.Windows.Forms.Label label9;
        private System.Windows.Forms.ComboBox renk;
        private System.Windows.Forms.TextBox km;
        private System.Windows.Forms.PictureBox pictureBox1;
        private System.Windows.Forms.Button button1;
        private System.Windows.Forms.Button button2;
        private System.Windows.Forms.Button button3;
        private System.Windows.Forms.DataGridView dataGridView1;
        private System.Windows.Forms.Button button4;
        private System.Windows.Forms.Button button6;
        private System.Windows.Forms.Label label11;
        private System.Windows.Forms.TextBox aresmi;
        private System.Windows.Forms.Label label12;
        private System.Windows.Forms.ComboBox durum;
        private System.Windows.Forms.OpenFileDialog openFileDialog1;
        private System.Windows.Forms.TextBox uretimyili;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.TextBox sira;
        private System.Windows.Forms.Label label14;
        private System.Windows.Forms.Label label10;
        private System.Windows.Forms.Label label13;
    }
}

