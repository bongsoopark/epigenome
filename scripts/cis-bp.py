import MySQLdb

f = open("cis-bp-TF_Information.txt","r")

locus_name = {}
gene_name = {}
for line in f:
	line = line.strip()
	data = line.split("\t")
	if data[5] != "DBID":
		locus_name.update({data[5]:data[9]})
		gene_name.update({data[5]:data[6]})
f.close()

#print len(locus_name)

f = open("cis-bp-addition.sql","w")
db = MySQLdb.connect(host="localhost",port=3306,user="bongsoo",passwd="450NFrear",db="dataset")
cursor = db.cursor()
cursor.execute("SELECT id, locus_name, note from regulome_genes where regulome_id=19;")
data = cursor.fetchall()
cnt = 0
for row in data:
	if locus_name.has_key(row[1]):
		tmp = 0
		#print row[0], row[1]
	else:
		f.write("update regulome_genes set regulome_id = '27' where locus_name = '%s';\n" % row[1])
		cnt += 1
cursor.close()
db.close()
f.close()

print cnt
