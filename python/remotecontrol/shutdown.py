import os, sys

command = "shutdown /s /t 1 -m \\\\{}".format(sys.argv[1])
# print (command)
os.system(command)

if os.system(command) is not "":
    # print(os.system(command))
    print(os.WEXITSTATUS(command))

# print (os.system(command))
