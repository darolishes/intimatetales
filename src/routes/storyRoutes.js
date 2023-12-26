const express = require('express');
const router = express.Router();
const StoryController = require('../controllers/StoryController');

router.post('/', StoryController.createStory);
router.get('/:userId', StoryController.getUserStories);

module.exports = router;
