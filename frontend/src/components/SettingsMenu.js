// components/SettingsMenu.js
import React from 'react';
import { IoClose, IoImage, IoReader, IoReceipt } from "react-icons/io5";

function SettingsMenu({ isSettingsMenuOpen, toggleSettingsMenu, width, setWidth, height, setHeight, steps, setSteps, firstUserPrompt, setFirstUserPrompt, userPrompt, setUserPrompt, defaultFirstPrompt, defaultPrompt }) {
    return (
        <div className={`menu-settings ${isSettingsMenuOpen ? 'open' : ''}`}>
            <a onClick={toggleSettingsMenu}>
                {isSettingsMenuOpen ? <IoClose className="icon-settings" /> : <img src="worker_impai.png" alt="Settings" className="icon-impai-head" />}
            </a>
            {/* Rest des Einstellungsmenüs */}
        </div>
    );
}

export default SettingsMenu;
