import React, { useState } from 'react';
import axios from 'axios';

function Signup() {
  const [userInfo, setUserInfo] = useState({
    username: '',
    email: '',
    password: ''
  });
  const [error, setError] = useState('');
  const [isLoading, setIsLoading] = useState(false);

  const handleChange = (e) => {
    setUserInfo({ ...userInfo, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    setError('');
    setIsLoading(true);

    try {
      // Add validation logic here
      
      const response = await axios.post('/api/signup', userInfo);
      // Handle success (e.g., redirect or show a success message)
    } catch (error) {
      setError('Signup failed: ' + error.response.data.message);
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      {/* Form fields */}
      {error && <p className="error">{error}</p>}
      <button type="submit" disabled={isLoading}>
        {isLoading ? 'Signing Up...' : 'Sign Up'}
      </button>
    </form>
  );
}

export default Signup;
