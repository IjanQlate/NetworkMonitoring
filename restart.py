import os

check = input("Restart your computer ? (y/n): ")
if check == 'n':
    exit()
else:
    os.system("shutdown /r /t 1")