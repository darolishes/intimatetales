// Example in src/pages/Dashboard.js
import React, { useEffect, useState } from 'react';
import { fetchStories } from '../services/apiService';

function Dashboard() {
  const [stories, setStories] = useState([]);

  useEffect(() => {
    fetchStories().then(data => setStories(data));
  }, []);

  const handleStorySelect = (storyId) => {
    // Logic to navigate or start the story
  };

  return (
    <div>
      <h1>Dashboard</h1>
      {stories.map(story => (
        <div key={story.id} onClick={() => handleStorySelect(story.id)}>
          {story.title}
        </div>
      ))}
    </div>
  );
}

export default Dashboard;
