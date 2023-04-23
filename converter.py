from docx2pdf import convert
import json
# convert("order.docx", "order.pdf")
try:
    convert("order.docxpp", "output.pdf")
    print(json.dumps({"status": "200"}))
except Exception as e:
    print('xatolik chiqdi')
# convert("my_docx_folder/")