from docxtpl import DocxTemplate
import sys

fullname = sys.argv[1]
address = sys.argv[2]
doc = DocxTemplate("../templates/template.docx")
context = {"fullname": fullname, "address": address}
doc.render(context)
doc.save("../documents/test.docx")