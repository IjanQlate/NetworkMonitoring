import os, sys

command = "shutdown /s /t 1 -m \\{}".format(sys.argv[1])

# print (command)

os.system(command)
