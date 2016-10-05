f = open("gene_list2.txt","r")
for line in f:
	line = line.strip()
	data = line.split("\t")
	print(len(data))
	print(data)
f.close()
