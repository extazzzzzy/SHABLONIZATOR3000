import sys
import pymorphy2
import json

morph = pymorphy2.MorphAnalyzer()

PRACTICE_PLACE_PRED = sys.argv[1]
IS_PRACTICE_PLACE_PRED = False
PRACTICE_PLACE_PRED_SPLIT = PRACTICE_PLACE_PRED.split()
PRACTICE_PLACE_PRED_ARR = []
for i in PRACTICE_PLACE_PRED_SPLIT:
    if (IS_PRACTICE_PLACE_PRED == False):
        PRACTICE_PLACE_PRED_PARSE = morph.parse(i)[0]
        PRACTICE_PLACE_PRED_WORD = PRACTICE_PLACE_PRED_PARSE.inflect({'loct'}).word.capitalize()
        IS_PRACTICE_PLACE_PRED = True
    else:
        PRACTICE_PLACE_PRED_PARSE = morph.parse(i)[0]
        PRACTICE_PLACE_PRED_WORD = PRACTICE_PLACE_PRED_PARSE.inflect({'loct'}).word
    PRACTICE_PLACE_PRED_ARR.append(PRACTICE_PLACE_PRED_WORD)
PRACTICE_PLACE_PRED = ' '.join(PRACTICE_PLACE_PRED_ARR)

output = {
    "PRACTICE_PLACE_PRED": PRACTICE_PLACE_PRED,
}
print(json.dumps(output))