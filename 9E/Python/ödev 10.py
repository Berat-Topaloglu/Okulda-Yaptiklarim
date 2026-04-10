toplam=0
bas=int(input("Başlangıç değerini giriniz:"))
bit=int(input("Bitiş değerini giriniz:"))
for sayilar in range(bas,bit+1):
    toplam=toplam+sayilar
print("Sayıların toplamı=",toplam)