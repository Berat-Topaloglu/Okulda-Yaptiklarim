toplam=0
sayi=0
adet=0
while (sayi!=1):
    sayi=int(input("Lütfen bir sayı giriniz:"))
    toplam=toplam+sayi
    adet=adet+1
ort=toplam/adet
print("Sayıların adedi:",adet)
print("Girilen sayıların toplamı",toplam)
print("Girilen sayıların ortalaması:",ort)