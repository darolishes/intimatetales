import React, { useEffect, useState } from 'react';
import { ToastContainer } from 'react-toastify';
import NPCManager from './components/NPCManager';
import SettingsMenu from './components/SettingsMenu';
import Chat from './components/Chat';
import 'react-toastify/dist/ReactToastify.css';
import './App.css';

function App() {

  const npcExemple = "IntimateTales is a little AI. He is kawaii and love help everyone."
  const [clickCount, setClickCount] = useState(0);
  const [imageUrl, setImageUrl] = useState('impai.png');
  const [isSettingsMenuOpen, setIsSettingsMenuOpen] = useState(false);
  const [isNPCMenuOpen, setIsNPCMenuOpen] = useState(false);
  const [message, setMessage] = useState('');
  const [chatHistory, setChatHistory] = useState([]);
  const [width, setWidth] = useState(
    localStorage.getItem('width') ? Number(localStorage.getItem('width')) : 1024);
  const [height, setHeight] = useState(
    localStorage.getItem('height') ? Number(localStorage.getItem('height')) : 512);
  const [steps, setSteps] = useState(
    localStorage.getItem('steps') ? Number(localStorage.getItem('steps')) : 1);
  const [npcList, setNpcList] = useState([]);
  const [npcAvatarList, setNpcAvatarList] = useState([]);

  const defaultFirstPrompt = `<s>[INST] You are a game master of a role play. \
You need to act as a narrator for simulate the beginning of the story. \
Just describe the situation and dont speak for the player. \
This is the story theme: [MESSAGE], write the beginning of \
the story using this information. [/INST]`;

  const [firstUserPrompt, setFirstUserPrompt] = useState(
    localStorage.getItem('firstPrompt') ? localStorage.getItem('firstPrompt') : defaultFirstPrompt);
  const [firstPrompt, setFirstPrompt] = useState(firstUserPrompt
    .replace('[MESSAGE]', message));

  const defaultPrompt = `<s>[INST] You are a game master of a role play. \
You need to act as a narrator for simulate dialog, describe \
scene, etc... but don't write player dialogue. \
This is the role play history: [CHAT_HISTORY], \
the player say: [MESSAGE], continue the rp. [/INST]`;

  const [userPrompt, setUserPrompt] = useState(
    localStorage.getItem('prompt') ? localStorage.getItem('prompt') : defaultPrompt);
  const [prompt, setPrompt] = useState(userPrompt
    .replace('[CHAT_HISTORY]', JSON.stringify(chatHistory))
    .replace('[MESSAGE]', message));

  const toggleSettingsMenu = () => {
    setIsSettingsMenuOpen(!isSettingsMenuOpen);
    setIsNPCMenuOpen(false);
  };

  const toggleNPCMenu = () => {
    setIsNPCMenuOpen(!isNPCMenuOpen);
    setIsSettingsMenuOpen(false);
  };

  const handleClick = () => {
    setClickCount((prevClickCount) => prevClickCount + 1);

    if (clickCount === 9) {
      setImageUrl('angry_impai.png');
    }
  };

  const addNpc = () => {
    setNpcList((prevNpcList) => [
      ...prevNpcList, 
      npcExemple
    ]);
  }

  const editNpc = (index, newValue) => {
    setNpcList((prevNpcList) => {
      const updatedNpcList = [...prevNpcList];
      updatedNpcList[index] = newValue;
      return updatedNpcList;
    });
  };

  const deleteNpc = (index) => {
    setNpcList((prevNpcList) => {
      const updatedNpcList = [...prevNpcList];
      updatedNpcList.splice(index, 1);
      return updatedNpcList;
    });
  };

  const generateImageNpc = (index) => {
        const imagePrompt = `<s>[INST] Extract the most important words \
from your paragraph and list them as keywords, separated \
by commas. For example:\nParagraph: A young woman with long curly hair, \
wearing a red dress, and standing in front of a sunset. \
\nKeywords: young, woman, long curly hair, red dress, standing in front of a sunset \
\nThis is the paragraph you need to describe with keywords: \
${JSON.stringify(npcList[index])} [/INST]`;

    fetch('http://localhost:7542/completion', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({"prompt": imagePrompt, "n_predict": -1}),
    })
    .then(response => response.json())
    .then(data => {
        console.log("keywords: ", data.content);
        fetch('http://localhost:7543/generate_image', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({"keywords": data.content, width: 512, height: 512, steps: steps}),
        })
        .then(response => response.json())
        .then(data => {
          const newArray = [...npcAvatarList];
          newArray[index] = `http://localhost:7543/images/${data.file_name}`;
          setNpcAvatarList(newArray);
        })
        .catch(error => {
            console.error(`Error fetching generated image: ${error.message}`);
            toast.error("Error with the backend !", {
                theme: "dark"
            });
        });
    })
    .catch(error => {
        console.error(`Error fetching completion: ${error.message}`);
        toast.error("Error with llama.cpp server !", {
            theme: "dark"
        });
    });
  }

  useEffect(() => {
    const filteredChatHistory = chatHistory.filter((item) => item.sender !== "image");

    setPrompt(userPrompt
      .replace('[CHAT_HISTORY]', JSON.stringify(filteredChatHistory))
      .replace('[MESSAGE]', message));
  }, [userPrompt, chatHistory, message])

  useEffect(() => {
    setFirstPrompt(firstUserPrompt
      .replace('[MESSAGE]', message));
  }, [firstUserPrompt, message])

  useEffect(() => {
    console.log("npc avatar generated !");
  }, [npcAvatarList])

  return (
    <div>
        <ToastContainer limit={3} />
        <SettingsMenu
            isSettingsMenuOpen={isSettingsMenuOpen}
            toggleSettingsMenu={toggleSettingsMenu}
            width={width}
            setWidth={setWidth}
            height={height}
            setHeight={setHeight}
            steps={steps}
            setSteps={setSteps}
            firstUserPrompt={firstUserPrompt}
            setFirstUserPrompt={setFirstUserPrompt}
            userPrompt={userPrompt}
            setUserPrompt={setUserPrompt}
            defaultFirstPrompt={defaultFirstPrompt}
            defaultPrompt={defaultPrompt}
        />
        <NPCManager
            npcList={npcList}
            setNpcList={setNpcList}
            generateImageNpc={generateImageNpc}
            isNPCMenuOpen={isNPCMenuOpen}
            toggleNPCMenu={toggleNPCMenu}
        />
        <Chat
            firstPrompt={firstPrompt}
            prompt={prompt}
            message={message}
            setMessage={setMessage}
            chatHistory={chatHistory}
            setChatHistory={setChatHistory}
            width={width}
            height={height}
            steps={steps}
            npcList={npcList}
        />
    </div>
);
}

export default App;