import random
import string
import time

def randomString(stringLength=10):
    """generates random string with only lowercase, and only with 10 letters """
    letters = string.ascii_lowercase
    return ''.join(random.choice(letters) for i in range(stringLength))

""" constantly makes new cases, with a pause in between which is shown in seconds at time.sleep """
for i in range(10):
 time.sleep (1)
 print ("Random String is ", randomString() )
 time.sleep (59)
