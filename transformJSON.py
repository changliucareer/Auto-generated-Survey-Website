
# Python program to read
# json file
 
 
import json
 
# Opening JSON file
f = open('e_surveys.json',)
 
# returns JSON object as
# a dictionary
data = json.load(f)
 
# Iterating through the json list and create new list
newSurveylist = []
for i,v in data.items():
    questionList = []
    for qoalist in v['questionsOptionsAnswers']:
        for qoa in qoalist: 
            if qoa[0]=='' or qoa[0]==" ": # skip empty question
                continue
            questionList.append({'question':qoa[0],'options':qoa[1],'answer':qoa[2]})
    newSurveylist.append(questionList)
    print(f"survery {i} contains {len(questionList)} questions")

print(f"total survey number is {len(newSurveylist)}")

# write to a json file
with open('surveys_fromExample.json', 'w') as fout:
    json.dump(newSurveylist , fout)

# Closing file
f.close()