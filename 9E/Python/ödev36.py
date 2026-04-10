import math
def alan():
    r=int(input("Yaraıçapını giriniz:"))
    alan=math.pi*math.pow(r,2)
    print("Dairenin alanı:",alan)
alan()
import math
def alan(r):
    alan=math.pi*math.pow(r,2)
    print("Dairenin alanı:",alan)
alan(5)

import math
def cevre():
    r=int(input("Yarıçapı giriniz:"))
    cevre=2*math.pi*r
    print("Dairenin çevresi",cevre)
cevre()
import math
def cevre(r):
    cevre=2*math.pi*r
    print("Dairenin çevresi",cevre)
cevre(5)