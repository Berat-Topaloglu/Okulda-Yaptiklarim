not1=int(input("Lütfen 1. sınav notunu giriniz:"))
not2=int(input("Lütfen 2. sınav notunu giriniz:"))
not3=int(input("Lütfen performans notunu giriniz:"))
ort=(not1+not2+not3)/3
if ort>=50:
    print("Geçtiniz ortalamanız:",ort)
else:
    print("Kaldınız ortalamanız:",ort)