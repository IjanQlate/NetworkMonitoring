import os 
  
shutdown = input("Do you wish to shutdown your computer ? (yes / no): ") 
  
if shutdown == 'no': 
    exit() 
else: 
    os.system("shutdown /s /t 1") 
    # os.system("shutdown -l -m \\192.168.10.111") 
