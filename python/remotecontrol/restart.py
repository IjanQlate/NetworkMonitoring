import os, sys

command = "shutdown /r /t 1 \\{}".format(sys.argv[1])

os.system(command)

# restart = input("Do you wish to restart your computer ? (yes / no): ") 
  
# if restart == 'no': 
#     exit() 
# else: 
#     os.system("shutdown /r /t 1") 