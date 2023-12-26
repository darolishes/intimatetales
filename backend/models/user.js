const Sequelize = require('sequelize');
const sequelize = require('../config/database'); // Assuming a separate database config file

const User = sequelize.define('user', {
  username: {
    type: Sequelize.STRING,
    allowNull: false,
    unique: true
  },
  password: {
    type: Sequelize.STRING,
    allowNull: false
  },
  preferences: {
    type: Sequelize.JSON
  }
});

module.exports = User;
