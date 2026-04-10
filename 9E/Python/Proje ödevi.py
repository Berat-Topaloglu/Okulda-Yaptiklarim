soru=str(input("Kayıtlı kullanıcı hesabınız var mı?(Evet/Hayır):"))
if soru=="Evet":
 Kullanıcı=int(input("Lütfen sisteme kayıtlı TC kimlik numaranızı giriniz:"))
 ad_soyad=str(input("Lütfen adınızı soyadınızı giriniz:"))
 şifre=input("Lütfen şifrenizi giriniz:")
 randevu_bilgisi=str(" 23 Nisan Pazar saat 13:00'da Tuzla devlet hastanesinde göz doktoru randevunuz bulunmakta randevunuza gelmeniz önemle rica olunur.")
randevu_bilgisi=="randevu"
if (şifre!="Berat_61") and (Kullanıcı!="0123456789") and (ad_soyad=="Berat Topaloğlu"):
 print("Lütfen tekrar deneyiniz!")
elif soru=="Hayır":
 Yeni_kullanıcı=int(input("Lütfen TC kimlik numaranızı giriniz:"))
 ad=str(input("Lütfen adınızı giriniz:"))
 soyad=str(input("Lütfen soyadınızı giriniz:"))
 dogum_tarih=input("Lütfen doğum tarihinizi giriniz:")
 yeni_sifre=input("Lütfen şifrenizi giriniz:")
 print("Hoş geldiniz",ad,"size nasıl yardımcı olabilirim?")
else:
 print("Hoş geldiniz",ad_soyad)
 soru2=str(input("Randevu bilginizi öğrenmek istiyor musunuz?(Evet/Hayır):"))
if (soru2=="Evet"):
 print(randevu_bilgisi)
elif (soru2=="Hayır"):
 print("Başka bir işlem yapmak istemiyorsanız lütfen ana menüye tekrar geri dönünüz.")
 soru3=str(input("Yeni randevu kaydı oluşturmak ister misiniz?(Evet/Hayır):"))
if (soru3=="Evet"):
  print("Lütfen randevu almak istediğiniz bölümü ilgili yerlere yazınız.")
else:
 print("İyi günler dileriz.")