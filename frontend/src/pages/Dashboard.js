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
    <div className="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center space-x-4">
      <div>
        <h1 className="text-xl font-medium text-black">Dashboard</h1>
        {/* Rest of your component */}
      </div>
    </div>
  );
}

export default Dashboard;
