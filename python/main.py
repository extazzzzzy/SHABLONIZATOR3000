from docxtpl import DocxTemplate
import sys

fullname = sys.argv[1]
address = sys.argv[2]
doc = DocxTemplate("template.docx")
context = {"fullname": fullname, "address": address}
doc.render(context)
doc.save("test.docx")