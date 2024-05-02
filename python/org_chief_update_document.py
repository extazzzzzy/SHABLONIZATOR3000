from docxtpl import DocxTemplate
import sys
import pymorphy2

morph = pymorphy2.MorphAnalyzer()

SRC_DOCUMENT = sys.argv[1]
STUDENT_QUALITIES = sys.argv[2]
PROBLEM_SOLVING_SPEED = sys.argv[3]
WORK_AMOUNT = sys.argv[4]
REMARKS = sys.argv[5]
STUDENT_ASSESSMENT = sys.argv[6]

doc = DocxTemplate(SRC_DOCUMENT)

context = {"STUDENT_QUALITIES": STUDENT_QUALITIES, "PROBLEM_SOLVING_SPEED": PROBLEM_SOLVING_SPEED, "WORK_AMOUNT": WORK_AMOUNT,
           "REMARKS": REMARKS, "STUDENT_ASSESSMENT": STUDENT_ASSESSMENT}

doc.render(context)
doc.save(SRC_DOCUMENT)