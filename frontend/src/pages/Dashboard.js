// Example in src/pages/Dashboard.js
import React, { useEffect, useState } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { fetchRecentActivities, fetchStoryRecommendations } from '../services/apiService';

function Dashboard() {
  const [recentActivities, setRecentActivities] = useState([]);
  const [storyRecommendations, setStoryRecommendations] = useState([]);
  const userPreferences = useSelector(state => state.user.preferences);
  const dispatch = useDispatch();

  useEffect(() => {
    fetchRecentActivities().then(data => setRecentActivities(data));
    fetchStoryRecommendations(userPreferences).then(data => setStoryRecommendations(data));
  }, [userPreferences, dispatch]);

  return (
    <div>
      <h1>Dashboard</h1>
      {/* Display recent activities */}
      {/* Display story recommendations */}
      {/* Options to influence upcoming storylines */}
    </div>
  );
}

export default Dashboard;
