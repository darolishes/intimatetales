const express = require('express');
const http = require('http');
const WebSocket = require('ws');
const app = express();
const server = http.createServer(app);
const wss = new WebSocket.Server({ server });

wss.on('connection', (ws) => {
  ws.on('message', (message) => {
    // Broadcast the message to all clients
    wss.clients.forEach(client => {
      if (client !== ws && client.readyState === WebSocket.OPEN) {
        client.send(message);
      }
    });
  });
});

app.get('/', (req, res) => {
  res.send('Welcome to IntimateTales!');
});

// Add loading indicator for API call
app.use((req, res, next) => {
  const loading = `Loading...`;
  res.status(200).send(loading);
  setTimeout(() => {
    res.status(200).send('');
  }, 1000);
});

// Remove app.listen and use server.listen only
const port = process.env.PORT || 3000;
server.listen(port, () => {
  console.log(`Server running on port ${port}`);
});
