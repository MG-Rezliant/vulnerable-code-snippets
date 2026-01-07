const express = requireexpress
const bodyParser = requirebody-parser
const path = requirepath
const app = express
const port = 1337
const escapeHTML = requireescape-html

app.usebodyParser.urlencoded extended: true 
app.usebodyParser.json
app.use/ignore, express.staticpath.join__dirname, ignore


app.get/, req, res = 
  res.send
    !DOCTYPE html
    html lang=en
    head
      titleWrite to Santa/title
      link rel=styleshe