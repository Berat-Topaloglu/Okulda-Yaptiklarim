import math
def hipo():
    a=int(input("a kenarını giriniz:"))
    b=int(input("b kenarını giriniz:"))
    cgececi=math.pow(a,2)+math.pow(b,2)
    c=math.sqrt(cgececi)
    print("Hipotenüs",c)
hipo()
import math
def hipo(a,b):
    cgececi=math.pow(a,2)+math.pow(b,2)
    c=math.sqrt(cgececi)
    print("Hipotenüs",c)
hipo(3,4)