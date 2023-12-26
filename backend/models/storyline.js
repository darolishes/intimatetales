const Sequelize = require('sequelize');
const sequelize = require('../config/database');

const Storyline = sequelize.define('storyline', {
  title: {
    type: Sequelize.STRING,
    allowNull: false
  },
  content: {
    type: Sequelize.TEXT,
    allowNull: false
  },
  createdBy: {
    type: Sequelize.INTEGER,
    references: {
      model: 'users',
      key: 'id'
    }
  }
});

module.exports = Storyline;
