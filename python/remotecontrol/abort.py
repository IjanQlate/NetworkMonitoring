import os, sys

command = "shutdown -a -m \\{}".format(sys.argv[1])

os.system(command) 


# logout = input("Do you wish to log out your computer ? (yes / no): ") 

# if logout == 'no': 
# 	exit() 
# else: 
# print("hey")
