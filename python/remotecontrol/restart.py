import os, sys

command = "shutdown /m /r \\{}".format(sys.argv[1])

os.system(command)

# restart = input("Do you wish to restart your computer ? (yes / no): ") 
  
# if restart == 'no': 
#     exit() 
# else: 
#     os.system("shutdown /r /t 1") 