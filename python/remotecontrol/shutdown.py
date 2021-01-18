import os, sys

command = "shutdown /s /t 1 \\{}".format(sys.argv[1])

os.system(command)

  
# shutdown = input("Do you wish to shutdown your computer ? (yes / no): ") 
  
# if shutdown == 'no': 
#     exit() 
# else: 
#     os.system("shutdown /s /t 1") 
#     # os.system("shutdown -l -m \\192.168.10.111") 
