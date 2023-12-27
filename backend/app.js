const express = require('express');
const Sequelize = require('sequelize');
const userRoutes = require('./routes/userRoutes');
const storyRoutes = require('./routes/storyRoutes'); // Assuming you have storyRoutes set up
const LittleLMService = require('./services/LittleLMService'); // Assuming you have a service for LittleLM

const app = express();
const sequelize = new Sequelize(/* your database connection info here */);

// Middleware to parse JSON bodies
app.use(express.json());

// Database connection
sequelize.authenticate()
  .then(() => console.log('Database connected...'))
  .catch(err => console.log('Error: ' + err));

// Use routes
app.use('/api/users', userRoutes);
app.use('/api/stories', storyRoutes);

// After all route middleware
app.use((err, req, res, next) => {
  console.error(err);
  res.status(err.status || 500).send(err.message || 'Internal Server Error');
});

// Add API call for signup registration
app.post('/api/signup', (req, res) => {
  const { email, password } = req.body;
  // Implement database authentication and validation here
  // ...
  res.json({ message: 'User registered successfully' });
});

// LittleLM Integration (Basic Setup)
app.post('/api/generate-story', (req, res) => {
  const { userPreferences } = req.body;
  LittleLMService.generateStory(userPreferences)
    .then(story => res.json(story))
    .catch(err => res.status(500).send(err.message));
});

// Basic route for testing
app.get('/', (req, res) => {
  res.send('Welcome to the IntimateTales Backend!');
});

// Catch 404 and forward to error handler
app.use((req, res, next) => {
  res.status(404).send('Sorry, that route does not exist.');
});

// Error handling middleware
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).send('Something broke!');
});

module.exports = app;
