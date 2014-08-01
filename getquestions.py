import requests
import json
import sys
import random



def writeOUT(outDict):
	JSONstr = json.dumps(outDict)
	#file = open('output/getquestionspyOUT.json', 'w') # writes to the out file, read by the php script
	#f.write(JSONstr)

	#f.close()

	#### these will be uncommented if the latter doesn't work on the windows server
	print JSONstr

def getJSON(url):
	tempStore = requests.get(url)
	searchResults = tempStore.text
	JSONdict = json.loads(searchResults)
	return JSONdict

def getResults(id):
	search = 'https://api.quizlet.com/2.0/sets/' + id + '/terms?client_id=RFsBbdeZFt&whitespace=1' # quizlet api terms request url
	results = getJSON(search)
	return results

def perform(ids): # the entry point
	idList = ids.split(',') # read csv values
	outDict = {}
	
	cards = []

	for id in idList:
		id.strip()
		results = getResults(id)
		cards = cards + results
	
	random.shuffle(cards)
	i = 0
	while i < 5:
		card = cards[i]
		q = card['term']
		a = card['definition']
		outDict[q] = a # i.e. {term:definition, term:definition...}
		i = i + 1
	
	writeOUT(outDict)
	return outDict


if(__name__ == "__main__"): # if not run with other input
	args = sys.argv
	
	try:
		argIds = args[1]
	except:
		exit()
	perform(argIds)
