import json
import urllib
import sys
from Bio import Entrez, SeqIO

proteome_name = "NP_001018029.1"
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
data = results[0]['GBSeq_feature-table'][0]['GBFeature_quals']

cnt = 0
for the_key, the_value in data:
	if data[cnt][the_key] == "chromosome":
		print("chromosome="+data[cnt][the_value])
	cnt += 1

pos = results[0]['GBSeq_feature-table'][0]['GBFeature_location']
tmp = pos.split("..")
print("position="+tmp[0]+"-"+tmp[1])

data = results[0]['GBSeq_feature-table'][2]['GBFeature_quals']

cnt = 0
for the_key, the_value in data:
	if data[cnt][the_key] == "locus_tag":
		print("note="+data[cnt][the_value])
	if data[cnt][the_key] == "note":
		print("note="+data[cnt][the_value])
	cnt += 1
