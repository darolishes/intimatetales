const nodemailer = require('nodemailer');
const crypto = require('crypto');
const User = require('../models/user'); // Adjust based on your user model

const sendVerificationEmail = async (user, req) => {
  const token = crypto.randomBytes(20).toString('hex');
  
  // Save the token to the user's profile in your DB

  const transporter = nodemailer.createTransport({
    service: 'gmail', // or your preferred email service
    auth: {
      user: 'your_email@example.com',
      pass: 'your_password',
    },
  });

  const mailOptions = {
    from: 'youremail@example.com',
    to: user.email,
    subject: 'Account Verification Token',
    text: 'Please verify your account by clicking the link: \nhttp://' 
          + req.headers.host + '/api/verify/' + token,
  };

  await transporter.sendMail(mailOptions);
};

exports.signup = async (req, res) => {
  // Your existing signup logic

  // After creating the user
  sendVerificationEmail(newUser, req);
};
