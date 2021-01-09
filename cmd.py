import os
# os.system('cmd /k "date"') 
command = 'ipconfig'   # ipconfig /all
os.system('cmd /k "{}"'.format(command)) 