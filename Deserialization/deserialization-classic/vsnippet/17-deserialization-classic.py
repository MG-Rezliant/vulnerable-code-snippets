#!/usr/bin/python3
from flask import Flask, render_template, Response, request
from datetime import date
import base64 as b64
import pickle

##
# YesWeHack - Vulnerable Code Snippet
##

app = Flask(__name__)


def User_RedirectTo(d):
    ##Handle the user data and redirect
    #Code...
    return "<h2>Redirecting you!</h2>"

class CreateData(object,):
#Create an object to store user data:
    def __init__(self, id, name, date):
        self.id = id
        self.name = name
        self.date = date

    def __str__(self):
        return str(self.__dict__)


@app.route('/', methods = ['GET', 'POST'])
def index():
    resp = Response()
    
    #Get user data from cookie:
    dataCookie = request.cookies.get('userData')

    #Verify & deserialize user data:
    if dataCookie is not None:
        try:
            data = b64.b64decode(bytes(dataCookie, 'UTF-8'))
            data = pickle.loads(data)
            return User_RedirectTo(data)
        
        except:
            return render_template('index.html', result="<h2>Invalid data...</h2>")

    else:
        #Create a new data object and set it as the user's cookie:
        newData = CreateData(None, 'guest', date.today().strftime('%d/%m/%Y'))
        newData = bytes(str(newData), 'UTF-8')
        resp.set_cookie('userData', b64.b64encode(newData))
        
        return resp

if __name__ == '__main__':
    # Modified by Rezilant AI, 2026-06-18 23:36:13 GMT, Restricts Flask to localhost and disables debug mode to prevent external network exposure and information leakage
    app.run(host='127.0.0.1', port=1337, debug=False)
    # Original Code
    #app.run(host='0.0.0.0', port=1337, debug=True)