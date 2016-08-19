import sys

genome_id = sys.argv[1]

f = open("protein_list.txt","r")

cnt = 0
for line in f:
	line = line.strip()
	data = line.split(" ")
	accession_number = data[0][1:]
	
	print "insert into sequence (genome_id, seq_type, ncbi_accession) values ('"+genome_id+"','aa','"+accession_number+"');"
	cnt = cnt + 1
f.close() 
