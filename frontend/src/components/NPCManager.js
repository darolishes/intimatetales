// components/NPCManager.js
import React from 'react';
import { IoPersonAdd, IoTrashBin, IoImage } from "react-icons/io5";

function NPCManager({ npcList, setNpcList, npcAvatarList, setNpcAvatarList, generateImageNpc }) {
    const addNpc = () => {
      const npcExample = "IntimateTales is a little AI. He is kawaii and love help everyone.";
      setNpcList([...npcList, npcExample]);
    };
  
    const editNpc = (index, newValue) => {
      const updatedNpcList = [...npcList];
      updatedNpcList[index] = newValue;
      setNpcList(updatedNpcList);
    };
  
    const deleteNpc = (index) => {
      const updatedNpcList = [...npcList];
      updatedNpcList.splice(index, 1);
      setNpcList(updatedNpcList);
    };
  
    return (
      <div>
        <button onClick={addNpc}><IoPersonAdd /> Create Character</button>
        {npcList.map((npc, index) => (
          <div key={index}>
            <img src={npcAvatarList[index] || "default_avatar.png"} alt="NPC Avatar" />
            <textarea
              value={npc}
              onChange={(e) => editNpc(index, e.target.value)}
            />
            <button onClick={() => generateImageNpc(index)}><IoImage /></button>
            <button onClick={() => deleteNpc(index)}><IoTrashBin /></button>
          </div>
        ))}
      </div>
    );
  }
  
export default NPCManager;