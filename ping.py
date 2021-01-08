import os

def check_ping():
    hostname = "8.8.8.8"   #change ip
    response = os.system("ping " + hostname)
    # and then check the response...
    if response == 0:
        pingstatus = "Network Active"
    else:
        pingstatus = "Network Error"

    return pingstatus

print(check_ping())