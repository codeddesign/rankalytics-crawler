import urllib2
import sys
var = 1
while var == 1:
        with open('/var/www/stats/status.txt', 'r') as f:
            count = int(f.read())
        if count == 0:
            print ("is stopped")
            break;
        try:
            link = "http://5.101.106.7/process.php?p="+str(sys.argv[1])+"&type="+sys.argv[2]
            urllib2.urlopen(link)
            print (link)
        except urllib2.HTTPError:
            pass
        with open('/var/www/stats/status.txt', 'r') as f:
            count = int(f.read())
        if count == 0:
            print ("is stopped")
            break;

