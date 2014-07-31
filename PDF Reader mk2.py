import os
import glob
import pyPdf
 
parent = "file location here  extract-pdf-text"
os.chdir(parent)
filename = os.path.abspath('naacl06-shinyama.pdf')
 
def getPDFContent(path):
    content = ""
    # Load PDF into pyPDF
    pdf = pyPdf.PdfFileReader(file(path, "rb"))
    # Iterate pages
    for i in range(0, pdf.getNumPages()):
        # Extract text from page and add to content
        content += pdf.getPage(i).extractText() + "/n"
    # Collapse whitespace
    content = " ".join(content.replace(u"/xa0", " ").strip().split())
    return content
 
# print getPDFContent(filename).encode("ascii", "ignore")
print getPDFContent(filename).encode("ascii", "xmlcharrefreplace")
