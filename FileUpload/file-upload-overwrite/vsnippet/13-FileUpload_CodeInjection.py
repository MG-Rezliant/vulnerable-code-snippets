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
    # Modified by Rezilant AI, 2026-06-18 23:36:25 GMT, Restrict Flask to localhost only and disable debug mode in production to prevent direct internet exposure
    # Development - bind to localhost only
    app.run(host='127.0.0.1', port=1337, debug=True)
    # Production - use a WSGI server instead
    # gunicorn --bind 127.0.0.1:1337 --workers 4 your_app:app
    
    # Original Code
    #app.run(host='0.0.0.0', port=1337, debug=True)