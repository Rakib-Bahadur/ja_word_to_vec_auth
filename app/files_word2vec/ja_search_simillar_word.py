#!C:\Users\Rakib Hossain\AppData\Local\Programs\Python\Python36

import gensim
import json
import os
import sys
import base64
currentDirectory = str (os.path.dirname(os.path.realpath(__file__)))


modelFile = currentDirectory + "\\" + "testmodel.model"

newmodel = gensim.models.Word2Vec.load(modelFile)

searchkeyfile = currentDirectory+"\\"+"searchkey.txt"

who = sys.argv[1]
who = base64.b64decode(who).decode('utf-8')
'''
try:
    with open(searchkeyfile, 'r', encoding="utf-8") as f:
        for i, line in enumerate(f.readlines()):
            who = line
        f.close()
except:
    print('Fail')
'''

keywords = who.split( )

arr = newmodel.wv.most_similar(positive = keywords)

print(json.dumps(arr))