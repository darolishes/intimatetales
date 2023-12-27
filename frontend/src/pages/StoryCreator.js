// Example in src/pages/StoryCreator.js
import React, { useState } from 'react';
import { createStory } from '../services/apiService';

function StoryCreator() {
  const [title, setTitle] = useState('');
  const [content, setContent] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    createStory({ title, content }).then(/* handle response */);
  };

  return (
    <form onSubmit={handleSubmit}>
      <input type="text" value={title} onChange={e => setTitle(e.target.value)} />
      <textarea value={content} onChange={e => setContent(e.target.value)} />
      <button type="submit">Create Story</button>
    </form>
  );
}

export default StoryCreator;
