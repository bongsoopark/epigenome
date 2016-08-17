import sys

genome_id = sys.argv[1]

f = open("genome_update.csv","r")

for line in f:
    line = line.strip()
    data = line.split(",")
    if data[1] == "Chr" or data[1] == "Un":
        print("insert into chromosome (genome_id, loc, type, name, ncbi_accession, genome_size, gc_content, protein, rRNA, tRNA, otherRNA, gene, pseudogene) values ('"+genome_id+"','"+data[0]+"','"+data[1]+"','"+data[2]+"','"+data[3]+"','"+data[5]+"','"+data[6]+"','"+data[7]+"','"+data[8]+"','"+data[9]+"','"+data[10]+"','"+data[11]+"','"+data[12]+"');")
f.close()
