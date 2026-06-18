from flask import Flask, abort
from flask_restful import Api, Resource
import json

##
# YesWeHack - Vulnerable Code Snippet
##

app = Flask(__name__)
api = Api(app)

class UsersDetails(Resource):
    def get(self, id):
        try:
            return {'users':data['accounts'][id]}
        except:
            return 'Invalid id'

data = json.load(open('users.json', 'r'))

def UserAuthorization(s:str):#<-(Ignore)
    #Code...
    pass

@app.route('/')
def index():
    return 'API v1.0'

api.add_resource(UsersDetails, '/users/<string:id>')
@app.route('/users')
def users():
    if UserAuthorization():
        #Code...
        pass
    else: 
        return abort(403, 'You need authorization to access this endpoint.')


#Start the vulnerable server:
if __name__ == '__main__':
    # Modified by Rezilant AI, 2026-06-18 23:37:28 GMT, Restricting Flask to localhost and disabling debug mode to prevent security risks
    app.run(host='127.0.0.1', port=1337, debug=False)
    # Original Code
    # app.run(host='0.0.0.0', port=1337, debug=True)