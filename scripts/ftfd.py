import operator
import MySQLdb

f = open("ftfd_sacCer3_TFs.csv","r")

locus_name = {}
for line in f:
	line = line.strip()
	data = line.split(",")
	data[3] = data[3].strip()
	if data[1] != "Systematicname":
		try:
			locus_name[data[1]] += ","+data[3]
		except:
			locus_name.update({data[1]:data[3]})
f.close()

db = MySQLdb.connect(host="localhost",port=3306,user="bongsoo",passwd="450NFrear",db="dataset")
cnt = 0
for the_key, the_value in sorted(locus_name.items(), key=operator.itemgetter(1)):
	cursor = db.cursor()
	cursor.execute("SELECT count(*) from regulome_genes where locus_name = '"+the_key+"';")
	data = cursor.fetchone()
	cnt = int(data[0])
	if cnt > 0:
		tmp = 0
	else:
		print data[0], the_key, the_value
	cursor.close()
db.close()
