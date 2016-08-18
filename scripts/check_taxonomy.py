import json
import urllib
import sys
from Bio import Entrez, SeqIO

genus_name = sys.argv[1]
species_name = sys.argv[2]
genome_name = genus_name+" "+species_name
user_email = "bxp12@psu.edu"

def get_tax_id(species):
    """to get data from ncbi taxomomy, we need to have the taxid.  we can
    get that by passing the species name to esearch, which will return
    the tax id"""
    species = species.replace(" ", "+").strip()
    search = Entrez.esearch(term = species, db = "taxonomy", retmode = "xml")
    record = Entrez.read(search)
    return record['IdList'][0]

def get_tax_data(taxid):
    """once we have the taxid, we can fetch the record"""
    search = Entrez.efetch(id = taxid, db = "taxonomy", retmode = "xml")
    return Entrez.read(search)

def get_genome_id(species):
    """to get data from ncbi taxomomy, we need to have the taxid.  we can
    get that by passing the species name to esearch, which will return
    the tax id"""
    species = species.replace(" ", "+").strip()
    search = Entrez.esearch(term = species, db = "genome", retmode = "xml")
    record = Entrez.read(search)
    return record['IdList'][0]

def get_genome_data(genome_id):
    """once we have the taxid, we can fetch the record"""
    search = Entrez.efetch(id = genome_id, db = "nucleotide", rettype="gb", retmode = "xml")
    return Entrez.read(search)

Entrez.email = user_email
# Retrieve taxonomy ID, and Lineaage
taxid = get_tax_id(genome_name)
data = get_tax_data(taxid)
genome = genome_name.split(" ")
print("insert into species (genus_name, species_name, strain_name, ncbi_txid, lineage) values ('"+genome[0]+"','"+genome[1]+"','','"+taxid+"','"+data[0]['Lineage']+"');")

exit(0)
# ToDoList
# Search how to retreive genome assembly info automatically
search = Entrez.esearch(term = "txid"+taxid+"[orgn]", db = "genome", retmode = "xml")
record = Entrez.read(search)
print(record)
# Successful!

# Retrieve the assembly information
# Not implemented yet

# Retrieve Chromosome information
search_term = 'refseq[FILTER] AND txid'+taxid+'[Organism]'
handle = Entrez.esearch(db='nucleotide', term=search_term)
results = Entrez.read(handle)
handle.close()

for seq_id in results['IdList']:
    handle = Entrez.efetch(db='nucleotide', id=seq_id, rettype='gb', retmode='text')
    gb_txt = handle.read()
    #print(gb_txt)
    #=>How to retrieve the protein sequences, tRNA, rRNA, gene, pseudogene
    handle.close()
    handle = Entrez.efetch(db='nucleotide', id=seq_id, rettype='gb', retmode='text')
    record = SeqIO.read(handle, "genbank")
    handle.close()
    gene_id=record.id
    name = gene_id.split("_")
    if name[0] == "NC":
        print("Downloading:"+gene_id+".fasta")
        handle = Entrez.efetch(db='nucleotide', id=seq_id, rettype='fasta', retmode='text')
        record = handle.read()
        handle.close()
        out_handle = open("./generated/"+gene_id+".fasta","w")
        out_handle.write(record.rstrip('\n'))
        out_handle.close()
