import React, { useEffect, useState } from 'react';

function RealTimeStory() {
  const [ws, setWs] = useState(null);

  useEffect(() => {
    const newWs = new WebSocket('ws://localhost:3000');
    
    newWs.onmessage = (event) => {
      console.log('Story update:', event.data);
      // Process and display story updates
    };

    setWs(newWs);

    return () => {
      newWs.close();
    };
  }, []);

  const sendUpdate = (update) => {
    if (ws && ws.readyState === WebSocket.OPEN) {
      ws.send(update);
    }
  };

  return (
    <div>
      <h2>Real-Time Story Collaboration</h2>
      {/* Story collaboration interface */}
      <button onClick={() => sendUpdate('Story update from user')}>Send Update</button>
    </div>
  );
}

export default RealTimeStory;
