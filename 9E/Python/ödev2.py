ad_soyad=str(input("Lütfen adınızı ve soyadınızı giriniz:"))
yabancı_dıl=str(input("Lütfen bildiğiniz yabancı dili yazınız:"))
yas=int(input("lütfen yaşınızı giriniz:"))
if ((yabancı_dıl=="İngilizce" or yabancı_dıl=="Fransızca") and yas<=40):
    print("Sayın",ad_soyad,"başvurunuz kabul edildi !tebrikler!")
else:
    print("Sayın",ad_soyad,"başvurunuz ne yazık ki reddedildi.")