donanim=["yazıcı","klavye","işlemci","bellek","sabit disk","klavye"]
yazilim=["işletim sistemi","Pycharm"]
yeni_donanim=donanim.copy()
donanim.append("mouse")
donanim.extend(yazilim)
donanim.insert(2,"tarayıcı")
print(donanim)