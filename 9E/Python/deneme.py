soru=str(input("Kayıtlı kullanıcı hesabınız var mı?(Evet/Hayır):"))
if soru=="Evet":
 Kullanıcı=int(input("Lütfen sisteme kayıtlı TC kimlik numaranızı giriniz:"))
 ad_soyad=str(input("Lütfen adınızı soyadınızı giriniz:"))
 şifre=input("Lütfen şifrenizi giriniz:")
 randevu_bilgisi=str(" 23 Nisan Pazar saat 13:00'da Tuzla devlet hastanesinde göz doktoru randevunuz bulunmakta randevunuza gelmeniz önemle rica olunur.")
if (şifre!="Berat_61") and (Kullanıcı!="0123456789"):
  print("Lütfen tekrar deneyiniz!")
elif soru=="Hayır":
 Yeni_kullanıcı=int(input("Lütfen TC kimlik numaranızı giriniz:"))
 ad=str(input("Lütfen adınızı giriniz:"))
 soyad=str(input("Lütfen soyadınızı giriniz:"))
 dogum_tarih=input("Lütfen doğum tarihinizi giriniz:")
 yeni_sifre=input("Lütfen şifrenizi giriniz:")
 print("Hoş geldiniz",ad,"size nasıl yardımcı olabilirim?")
else:
 print("Hoş Geldiniz:",ad_soyad,"randevunuz",randevu_bilgisi,)
