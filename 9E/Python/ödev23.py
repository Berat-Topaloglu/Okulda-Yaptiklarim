toplam=0
bas=int(input("Lütfen başlangıç sayısını giriniz:"))
bit=int(input("Lütfen bitiş sayısını giriniz:"))
i=bas
while (i<=bit):
    toplam=(toplam+i)
    i=i+1
    ort=toplam/(bit-bas+1)
print("Girilen iki sayının toplamı:",toplam)
print("Girilen iki sayının ortalaması:",ort)