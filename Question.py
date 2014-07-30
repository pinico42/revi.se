import requests
import json
import random

ListForDefinitions = []
ListForTerms = []
LessThanNumberOfQuestions = 0
NumberOfQuestions = 20
ListToExport = []
QuestionNotRepeated = []
ListForEnerites = []


# This will find a specified set then set the varible search results to results

setid = '45301'
search = 'https://api.quizlet.com/2.0/sets/' + setid + '/terms?client_id=RFsBbdeZFt&whitespace=1'
TempStore = requests.get(search)
SearchResults = TempStore.text

#Will find key points in the data by finding repeating syntax

TermPosition = SearchResults.find("term")


#Once there are no more "terms" (at the end of the list) the .find will return -1

while TermPosition > 1:
    
    SearchResults = SearchResults[TermPosition:len(SearchResults)]
        
    ColonPosition = SearchResults.find(":")
    ComaPosistion = SearchResults.find(",")

    ListForTerms.append(str(SearchResults[ColonPosition+3:ComaPosistion-1]))
        
    DefinitionPosition = SearchResults.find("definition")
    
    SearchResults = SearchResults[DefinitionPosition:len(SearchResults)]

    ColonPosition = SearchResults.find(":")
    ComaPosistion = SearchResults.find(",")

    ListForDefinitions.append(str(SearchResults[ColonPosition+3:ComaPosistion-1]))
        
    TermPosition = SearchResults.find("term")

# compiles a list with the terms and definitions   

#If its less that 20 all cards avalible is selected
if len(ListForTerms) < 21:
    for Current in range(0,len(ListForTerms)-1):
        ListToExport.append(ListForTerms[Current] + " = " + ListForDefinitions[Current])

#Otherwise 20 random questions are selected for the cards   
        
else:
    while LessThanNumberOfQuestions < NumberOfQuestions:
        RandomNO = random.randint(1,(len(ListForTerms)))-1
        ListToExport.append(ListForTerms[RandomNO] + " = " + ListForDefinitions[RandomNO])
        LessThanNumberOfQuestions = LessThanNumberOfQuestions + 1   


print (ListToExport)
print (ListForEnerites)
