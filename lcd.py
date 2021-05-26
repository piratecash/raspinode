#!/usr/bin/env python3
__author__ = 'hades'

import requests
import json
import datetime
import time
from pyfiglet import Figlet

try:
    request = 'http://127.0.0.1/raspinode/index.php/app/lcd'
    response = requests.get(request)
    print(str(response.content))
    if response.status_code == 200:
        lcd = json.loads(response.content.decode('utf-8'))
        if not lcd['error']:
            print("\033c\033[1;35m" \
                  ".----. .-..----.   .--.  .---. .----.")
            print("| {}  }| || {}  } / {} \{_   _}| {_")
            print("| .--' | || .-. \/  /\  \ | |  | {__")
            print("`-'    `-'`-' `-'`-'  `-' `-'  `----'")
            print("\033[0;37m                               v%s" % lcd['raspinode'])
            #print
            print("\033[1;32mAvailable:\033[1;37m%20.8f \033[0;37mPIRATE" % lcd['available'])
            print("\033[1;32mStake:\033[0;37m%24.8f PIRATE" % lcd['stake'])
            print("\033[1;32mTotal:\033[1;37m%24.8f \033[0;37mPIRATE\n" % (lcd['available'] + lcd['stake']))
            print("\033[1;32mNumber of connections:\033[1;37m%11d" % lcd['connections'])
            print("\033[1;32mCurrent number of blocks:\033[1;37m%10d" % lcd['blocks'])
            print("\033[1;32mLast block time:\033[1;37m%s\n" % datetime.datetime.fromtimestamp(
                lcd['last_block_time']).strftime('%Y-%m-%d %H:%M:%S'))
            print("Staking info:")
            if lcd['enabled']:
                en = "\033[1;32mOK"
            else:
                en = "\033[1;31mNO"
            if lcd['staking']:
                st = "\033[1;32mOK"
            else:
                st = "\033[1;31mNO"
            print("\033[1;37mEnabled:        %s" % en)
            print("\033[1;37mStaking:        %s" % st)
            print("\033[1;37mExpected time to earn reward:")
            print("\033[1;35m                %s" % lcd['expected_time'])
            print("\033[1;32mWallet:\033[0;37m         %s" % lcd['version'])
            custom_fig = Figlet(font='clr6x8')
            ascii_banner = custom_fig.renderText(datetime.datetime.now().strftime('%H:%M'))
            print("\033[1;37m%s" % ascii_banner)
            diff = round((time.time() - lcd['last_block_time'])/60,2)
            print("\033[1;32mTime diff:\033[1;37m      %s" % diff)
except requests.exceptions.ConnectionError:
    pass
except KeyError:
    pass
