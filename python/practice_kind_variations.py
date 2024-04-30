import sys
import pymorphy2
import json

morph = pymorphy2.MorphAnalyzer()

# перевод вида практики в дательный падеж
PRACTICE_KIND_DAT = sys.argv[1]
PRACTICE_KIND_VIN = sys.argv[1]

PRACTICE_KIND_DAT_SPLIT = PRACTICE_KIND_DAT.split()
PRACTICE_KIND_DAT_ARR = []
for i in PRACTICE_KIND_DAT_SPLIT:
    PRACTICE_KIND_DAT_PARSE = morph.parse(i)[0]
    PRACTICE_KIND_DAT_WORD = PRACTICE_KIND_DAT_PARSE.inflect({'datv'}).word.upper()
    PRACTICE_KIND_DAT_ARR.append(PRACTICE_KIND_DAT_WORD)
PRACTICE_KIND_DAT = ' '.join(PRACTICE_KIND_DAT_ARR)

# перевод вида практики в винительный падеж
PRACTICE_KIND_VIN_SPLIT = PRACTICE_KIND_VIN.split()
PRACTICE_KIND_VIN_ARR = []
for i in PRACTICE_KIND_VIN_SPLIT:
    PRACTICE_KIND_VIN_PARSE = morph.parse(i)[0]
    PRACTICE_KIND_VIN_WORD = PRACTICE_KIND_VIN_PARSE.inflect({'accs'}).word.capitalize()
    PRACTICE_KIND_VIN_ARR.append(PRACTICE_KIND_VIN_WORD)
PRACTICE_KIND_VIN = ' '.join(PRACTICE_KIND_VIN_ARR)

output = {
    "PRACTICE_KIND_DAT": PRACTICE_KIND_DAT,
    "PRACTICE_KIND_VIN": PRACTICE_KIND_VIN
}
print(json.dumps(output))
