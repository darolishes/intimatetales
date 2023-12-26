const Storyline = require('../models/storyline');

const StoryController = {
  async createStory(req, res) {
    try {
      const story = await Storyline.create({ ...req.body });
      res.status(201).json(story);
    } catch (error) {
      res.status(500).send(error.message);
    }
  },

  async getUserStories(req, res) {
    // Implement logic to retrieve stories for a user
  }
};

module.exports = StoryController;
