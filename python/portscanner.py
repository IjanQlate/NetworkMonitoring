from socket import *
import time, sys
startTime = time.time()

if __name__ == '__main__':
   target = sys.argv[1]
   t_IP = gethostbyname(target)
   print ('Starting scan on host: ', t_IP)
   
   if sys.argv[4] == "Single":

      s = socket(AF_INET, SOCK_STREAM)
      
      conn = s.connect_ex((t_IP, int(sys.argv[2])))
      if(conn == 0) :
         print ('Port %d: OPEN' % (int(sys.argv[2]),))
      else:
         print ('Port %d: CLOSED' % (int(sys.argv[2]),))
      s.close()

   else:

      for i in range(int(sys.argv[2]), int(sys.argv[3])):
         s = socket(AF_INET, SOCK_STREAM)
         
         conn = s.connect_ex((t_IP, i))
         if(conn == 0) :
            print ('Port %d: OPEN' % (i,))
         else:
            print ('Port %d: CLOSED' % (i,))
         s.close()
print('Time taken:', time.time() - startTime)