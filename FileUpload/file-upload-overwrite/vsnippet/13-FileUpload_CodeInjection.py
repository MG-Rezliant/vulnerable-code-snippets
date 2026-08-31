from flask import Flask, render_template, request
import html
import customLog
from ignore.design import design
app = design.Design(Flask(__name__), __file__, 'Vsnippet 13 - File upload overwrite python file')

##
# YesWeHack - Vulnerable code snippets
##


app = Flask(__name__)
app.config["UPLOAD_FOLDER"] = "share/"

@app.route('/share')
def sharedFiles():
    # Get: Filename -> Log -> Read it
    getFile = request.args.get("filename").replace('/','').replace('\\', '')
    file = open(app.config['UPLOAD_FOLDER'] + getFile, "r")

    return file.read() 

@app.route('/', methods = ['GET', 'POST'])
def index():
    #Just some custom "logging" here:
    customLog.log()

    #Upload your file:
    if request.method == 'POST':
        f = request.files['file']
        f.save(app.config["UPLOAD_FOLDER"] + f.filename)
        
        return ('''<h2>File: succeeded!</h2><br>
        <a href="/">..Back</a><br>
        <a href="./share?filename=%s">See my file</a>''' % html.escape(f.filename))

    return render_template('index.html')

#Start the server:
if __name__ == '__main__':
    # Modified by Rezilant AI, 2026-08-31 07:01:42 GMT, Restrict Flask to localhost and disable debug mode to prevent external network exposure and sensitive information leakage
    app.run(host='127.0.0.1', port=1337, debug=False)
    # Original Code
    # app.run(host='0.0.0.0', port=1337, debug=True)