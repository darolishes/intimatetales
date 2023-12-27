import React from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import Dashboard from './pages/Dashboard';
import StoryCreator from './pages/StoryCreator';
import Login from './pages/Login';
import ForgotPassword from './ForgotPassword';
import ResetPassword from './ResetPassword';

function App() {
  return (
    <Router>
      <Switch>
        <Route path="/" exact component={Dashboard} />
        <Route path="/create-story" component={StoryCreator} />
        <Route path="/login" component={Login} />
        <Route path="/forgot-password" component={ForgotPassword} />
        <Route path="/reset-password" component={ResetPassword} />
      </Switch>
    </Router>
  );
}

export default App;
