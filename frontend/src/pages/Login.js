import React, { useState } from 'react';
import { useDispatch } from 'react-redux';
import { loginUser } from '../services/apiService';
import { setUser } from '../redux/actions/userActions'; // assuming you have userActions

function Login() {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const dispatch = useDispatch();

  const handleSubmit = (e) => {
    e.preventDefault();
    loginUser(username, password)
      .then(user => {
        dispatch(setUser(user));
        // Redirect to dashboard or another page
      })
      .catch(error => {
        // Handle login error
      });
  };

  return (
    <form onSubmit={handleSubmit}>
      <input type="text" value={username} onChange={e => setUsername(e.target.value)} />
      <input type="password" value={password} onChange={e => setPassword(e.target.value)} />
      <button type="submit">Login</button>
      <Link to="/forgot-password">Forgot Password?</Link>
      <Link to="/signup">Don't have an account? Sign up</Link>

    </form>
  );
}

export default Login;
