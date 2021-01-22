import subprocess
import re
import pprint
import sys



output = subprocess.check_output("ipconfig /all")

lines = output.splitlines()
pp = pprint.PrettyPrinter()
# pp.pprint(lines)

lines = filter(lambda x: x, lines)



items_dict = {}
header_list = []


# Get Header
count = 0
for line in lines:
    line = str(line)
    
    # print(line)
    num = line.find(".")
    # print(num)
    if num<0:  
        count = int(count)      
        header_list.append(line)
        head = line
        count = count + 1
        # print(line)
        # print(count)
    else:
        count = str(count)
        items_dict[count,line] = head

        
# pp.pprint(items_dict)


user_input = "Bluetooth"
# user_input = "Ethernet adapter Local Area Connection" #Jarang
# user_input = "Ethernet adapter Ethernet"  # Jarang
user_input = "Wireless LAN adapter Wi-Fi"
user_input = "Wireless LAN adapter Local Area Connection"
user_input = "IP Configuration"

user_input = sys.argv[1]


for x in header_list:
    if user_input in x:
        print(x)
        for item, header in items_dict.items():  
            if header == x:
                # item = item.replace(".", " ")
                print(item)