import React from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import Dashboard from './pages/Dashboard';
import StoryCreator from './pages/StoryCreator';
import Login from './pages/Login';

function App() {
  return (
    <Router>
      <Switch>
        <Route path="/" exact component={Dashboard} />
        <Route path="/create-story" component={StoryCreator} />
        <Route path="/login" component={Login} />
        {/* Add other routes as needed */}
      </Switch>
    </Router>
  );
}

export default App;
