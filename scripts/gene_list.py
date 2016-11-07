f = open("gene_list_db.txt","r")
gene_list = {}
for line in f:
	line = line.strip()
	gene_list.update({line:1})
f.close()

f = open("gene_list_goterm.txt","r")
for line in f:
	line = line.strip()
	data = line.split("\t")
	try:
		data2 = data[7].split("|")
		#print(data[3]+"\t"+data2[0]+"\t"+data[4])
		if gene_list.has_key(data2[0]):
			tmp = 0
			#print("UPDATE regulome_genes set note = '"+data[4]+"' where locus_name='"+data2[0]+"';")
		else:
			print("INSERT INTO regulome_genes (regulome_id, locus_name, gene_name, note) values ('19','"+data2[0]+"','"+data[3]+"','"+data[4]+"');")
	except:
		tmp = 0
		#print("None\t"+data[3]+"\t"+data[4])
f.close()
