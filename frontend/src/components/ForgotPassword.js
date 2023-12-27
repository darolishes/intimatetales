import React, { useState } from 'react';

function ForgotPassword() {
  const [email, setEmail] = useState('');

  const handleSubmit = (event) => {
    event.preventDefault();
    // Implement functionality to submit email
  };

  return (
    <form onSubmit={handleSubmit}>
      <input
        type="email"
        value={email}
        onChange={(e) => setEmail(e.target.value)}
        placeholder="Enter your email"
      />
      <button type="submit">Send Reset Link</button>
    </form>
  );
}

export default ForgotPassword;
