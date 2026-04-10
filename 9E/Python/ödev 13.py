bas=int(input("Başlangıç değerini giriniz:"))
bit=int(input("Bitiş değerini giriniz:"))
tektoplam=0
çifttoplam=0
for i in range(bas,bit+1):
    if i%2==0:
        çifttoplam=çifttoplam+i
    else:
        tektoplam=tektoplam+i
print("Tek sayıların toplamı:",tektoplam)
print("Çift sayıların toplamı:",çifttoplam)