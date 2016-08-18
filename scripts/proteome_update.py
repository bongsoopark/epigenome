import os
import time
import json
import urllib
import sys
from Bio import Entrez, SeqIO

proteome_name = "NP_001032575.1"
user_email = "bxp12@psu.edu"

Entrez.email = user_email
# Retrieve taxonomy ID, and Lineaage

handle = Entrez.efetch(id = proteome_name, db = "protein", rettype="gb", retmode = "xml")
results = Entrez.read(handle)
handle.close()

print("accession_number="+proteome_name)
print("sequence="+results[0]['GBSeq_sequence'])	
print("title="+results[0]['GBSeq_definition'])	
print("size="+results[0]['GBSeq_length'])	

accession_number = proteome_name
sequence = results[0]['GBSeq_sequence']

pos = results[0]['GBSeq_feature-table'][0]['GBFeature_location']
tmp = pos.split("..")
print("position="+tmp[0]+"-"+tmp[1])


data = results[0]['GBSeq_feature-table']
chromosome = []

def retrieve_feature (data):
	for feature in data:
		if feature['GBFeature_key'] == "source":
			cnt = 0
			for key, value in feature['GBFeature_quals']:
				if feature['GBFeature_quals'][cnt][value] == "chromosome":
					print("chromome:"+feature['GBFeature_quals'][cnt][key])
					chromosome.append(feature['GBFeature_quals'][cnt][key])
				cnt += 1
		elif feature['GBFeature_key'] == "CDS":
			cnt = 0
			for key, value in feature['GBFeature_quals']:
				if feature['GBFeature_quals'][cnt][value] == "gene":
					print("gene="+feature['GBFeature_quals'][cnt][key])
				if feature['GBFeature_quals'][cnt][value] == "locus_tag":
					print("locus_tag="+feature['GBFeature_quals'][cnt][key])
				if feature['GBFeature_quals'][cnt][value] == "note":
					print("note="+feature['GBFeature_quals'][cnt][key])
				cnt += 1
		else:
			tmp = 0

while(len(chromosome) == 0):
	time.sleep(5)
	retrieve_feature(data)
	time.sleep(5)

f = open("proteome_update.fa","w")
f.write(">"+accession_number+"\n")
f.write(sequence+"\n")
f.close()

print("Done")
