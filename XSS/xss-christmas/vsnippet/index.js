const express = require('express');
const bodyParser = require('body-parser');
const path = require('path');
const app = express();
const port = 1337;
const escapeHTML = require('escape-html');

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());
app.use('/ignore', express.static(path.join(__dirname, 'ignore')));

// Modified by Rezilant AI, 2026-03-02 17:26:26 GMT, Added escapeHtml function to sanitize user input and prevent XSS attacks
function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

app.get('/', (req, res) => {
  res.send(`
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <title>Write to Santa</title>
      <link rel="stylesheet" href="/ignore/design/style.css">
    </head>
    <body>
      <div class="snowflakes" aria-hidden="true"></div>
      <div class="container">
        <h1>Write a Letter to Santa Claus 🎅</h1>
        <form method="POST" action="/send-letter">
          <label for="childName">Your Name:</label><br>
          <input type="text" id="childName" name="childName" placeholder="Your Name" required><br>
          <label for="letterContent">Your Letter:</label><br>
          <textarea id="letterContent" style="resize:none;" name="letterContent" rows="5" placeholder="Dear Santa..." required></textarea><br><br>
          <button type="submit" class="button">Send to Santa!</button>
        </form>
      </div>
      <script src="/ignore/design/snowflakes.js"></script>
    </body>
    </html>
  `);
});

function safeXSSMASLetter(content) {
    return !content.includes("<") && !content.includes(">");
  }
  
app.post('/send-letter', (req, res) =>{
  let childName = escapeHTML(req.body.childName);
  // Modified by Rezilant AI, 2026-03-02 17:26:26 GMT, Apply escapeHtml to letterContent to prevent XSS injection
  let letterContent = escapeHtml(req.body.letterContent);
  // Original Code
  // let letterContent = req.body.letterContent; // Custom sanitize – hope it holds!

  if (!safeXSSMASLetter(letterContent)) {
    return renderErrorPage(res); 
  }

  res.send(`
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <title>Letter Sent</title>
      <link rel="stylesheet" href="/ignore/design/style.css">
    </head>
    <body>
      <div class="snowflakes" aria-hidden="true"></div>
      <div class="container">
        <h1>Dear ${childName} 🎄,</h1>
        <p>Your letter has been sent to Santa Claus successfully!</p>
        <p>Here's what you wrote:</p>
        <p><strong>${letterContent}</strong></p>
        <a href="/" class="button">Send another letter</a>
      </div>
      <script src="/ignore/design/snowflakes.js"></script>
    </body>
    </html>
  `);
});

function renderErrorPage(res) {
  res.send(`
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <title>Error - Invalid Characters</title>
      <link rel="stylesheet" href="/ignore/design/style.css">
    </head>
    <body>
      <div class="snowflakes" aria-hidden="true"></div>
      <div class="container">
        <h1>Error</h1>
        <p style="color: red; font-weight: bold;">Your letter contains invalid characters. Please try again!</p>
        <a href="/send-letter" class="button">Back to the form</a>
      </div>
      <script src="/ignore/design/snowflakes.js"></script>
    </body>
    </html>
  `);
}

app.listen(port, () => {
  console.log(`Santa Letter Service running on http://127.0.0.1:${port}`);
});