import React from 'react';
import { Provider } from 'react-redux';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import store from './redux/store'; // Importiere deinen Redux-Store

import Dashboard from './pages/Dashboard';
import StoryCreator from './pages/StoryCreator';
import Login from './pages/Login';
import ForgotPassword from './components/ForgotPassword';
import ResetPassword from './pages/ResetPassword';
import Signup from './pages/Signup';

function App() {
  return (
    <Provider store={store}>
      <Router>
        <Routes>
          <Route path="/" element={<Dashboard />} />
          <Route path="/signup" element={<Signup />} />
          <Route path="/create-story" element={<StoryCreator />} />
          <Route path="/login" element={<Login />} />
          <Route path="/forgot-password" element={<ForgotPassword />} />
          <Route path="/reset-password" element={<ResetPassword />} />
        </Routes>
      </Router>
    </Provider>
  );
}

export default App;
