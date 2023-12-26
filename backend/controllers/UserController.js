const User = require('../models/user');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');

const UserController = {
  async register(req, res) {
    try {
      const hashedPassword = await bcrypt.hash(req.body.password, 10);
      const user = await User.create({ ...req.body, password: hashedPassword });
      res.status(201).json(user);
    } catch (error) {
      res.status(500).send(error.message);
    }
  },

  async login(req, res) {
    try {
      const user = await User.findOne({ where: { username: req.body.username } });
      if (!user || !await bcrypt.compare(req.body.password, user.password)) {
        return res.status(401).send('Authentication failed');
      }

      const token = jwt.sign({ userId: user.id }, 'your_secret_key', { expiresIn: '1h' });
      res.json({ token });
    } catch (error) {
      res.status(500).send(error.message);
    }
  }
};

module.exports = UserController;
