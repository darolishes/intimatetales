const User = require('../models/user'); // Adjust based on your user model

exports.verifyEmail = async (req, res) => {
  const { token } = req.params;

  try {
    // Find the user by token
    const user = await User.findOne({ verificationToken: token });

    if (!user) {
      return res.status(400).send('Invalid or expired verification token.');
    }

    // Update user status to 'verified'
    user.verified = true;
    user.verificationToken = null; // Clear the token
    await user.save();

    res.send('Email verified successfully. You can now login.');
  } catch (error) {
    res.status(500).send('Internal Server Error.');
  }
};
