#!C:\Users\Rakib Hossain\AppData\Local\Programs\Python\Python36
import tinysegmenter
import os
import gensim

currentDirectory = str (os.path.dirname(os.path.realpath(__file__)))
documents = list()
modelFile = currentDirectory + "\\" + "testmodel.model"
user_entry_file = currentDirectory + "\\" + "user_entry.txt"

with open (user_entry_file, 'r', encoding="utf-8") as File:
    for i, line in enumerate(File.readlines()):
        tokenized_text = tinysegmenter.tokenize(line)
        documents.append(tokenized_text)
    File.close()
    os.remove(File.name)
try:
    newmodel = gensim.models.Word2Vec.load(modelFile)
    newmodel.build_vocab(documents, update = True)
    newmodel.train(documents, total_examples=len(sentences), epochs=10)
    newmodel.save(modelFile)
    print('success')
except:
    pass