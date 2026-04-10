bas=int(input("Başlangıç değerini giriniz:"))
bit=int(input("Bitiş değerini giriniz:"))
tekadet=0
çiftadet=0
for i in range(bas,bit+1):
 if i%2==0:
    çiftadet=çiftadet+1
 else:
  tekadet=tekadet+1
print("Tek sayıların toplamı:",tekadet)
print("Çift sayıların toplamı:",çiftadet)