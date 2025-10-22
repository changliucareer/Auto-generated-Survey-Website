import os
#First print the current working directory
print("Current Working Directory", os.getcwd())
#Find out this file's dirname
THIS_FOLDER = os.path.dirname(os.path.abspath(__file__))
print("Current file is in folder:", THIS_FOLDER)
#Change the current working directory to this folder
os.chdir(THIS_FOLDER)
print("Current working directory is changed to ", os.getcwd())
###############################################################
 
 
import json
 
# Opening JSON file
f = open('CTRW_semantic_hard_tasks_forSeparatedExampleSentences.json',)
 
# returns JSON object as
# a dictionary
data = json.load(f)

def pairBlankAndOption(exampleWithBlank, options, correctAnswers ):
    blankIndex = 0
    wordList = exampleWithBlank.split()
    pairs = []
    # mark out the current blank one at a time
    for i,word in enumerate(wordList):
        if word=='____':
            wordList[i]='{_?_}'
            curText = ' '.join(wordList)
            if blankIndex<len(options):
                pairs.append((curText,options[blankIndex],correctAnswers[blankIndex]))
                blankIndex +=1
                # reverse the change
                wordList[i]='____'
            else:
                print("Exception: more blanks than answers")

    return pairs
 
# Iterating through the json list and create new list
newSurveylist = []
minQC = 10
maxQC =0
totalQC = 0
noExamplePartCount =0
for i,v in data.items():
    questionList = []
    try:
        examples = v['examplePart']
        ori_dis = v['original_discussion']
        for e in examples: 
            wordSetString = ",".join(e['wordSet'])
            exampleWithBlank = e['question']
            hardOptions = e['hardOptions']
            correctAnswers = e['answers']
            optionsList = [ [c for r,c in pairList] for pairList in hardOptions]
            # deal with example sentence with multiple blanks
            pairs = pairBlankAndOption(exampleWithBlank, optionsList, correctAnswers )
            for p in pairs:
                questionList.append({'question':p[0],'options':p[1],'answer':p[2]})
    except: # no example
        noExamplePartCount +=1
        continue
        
    newSurveylist.append({'wordSetString': wordSetString,'original_discussion':ori_dis,'questionList':questionList})
    if len(questionList)>maxQC:
        maxQC = len(questionList)
    if len(questionList)<minQC:
        minQC = len(questionList)
    totalQC += len(questionList)
    print(f"survery {i} contains {len(questionList)} questions")

print(f"minQC:{minQC}, maxQC:{maxQC}, totalQC:{totalQC}")
print(f"total survey number is {len(newSurveylist)}")
print(f"no example part count: {noExamplePartCount}")

# write to a json file
with open('surveys_fromExample_new.json', 'w') as fout:
    json.dump(newSurveylist , fout)

# Closing file
f.close()