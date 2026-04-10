p=int(input("lütfen satın aldığınız pataesin kilosunu yazınız:"))
d=int(input("lütfen satın aldığınız domatesin kilosunu yazınız:"))
m=int(input("lütfen satın alınan makarna adetini yazınız:"))
s=int(input("lütfen satın alınan sütün adetini yazınız:"))
toplam=(p*10+d*15+m*8+s*16)
if (toplam>100):
    toplam=toplam-toplam*0.15
    print("sepetinizin indirimle beraber güncel tutarı",toplam)
else:
    print("Ödenecek tutar",toplam)