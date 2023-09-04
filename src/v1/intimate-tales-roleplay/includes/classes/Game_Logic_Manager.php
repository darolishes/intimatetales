<?php

namespace IntimateTales;

class Game_Logic_Manager {

    private $storyManager;
    private $characterManager;

    public function __construct() {
        $this->storyManager = new Story_Manager();
        $this->characterManager = new Character_Manager();
    }

    // Startet ein neues Spiel für den Benutzer.
    public function start_new_game($user_id) {
        $first_story = $this->storyManager->get_first_story();
        $this->storyManager->save_user_progress($user_id, $first_story->ID);
        return $first_story;
    }

    // Verarbeitet eine Benutzerentscheidung und bestimmt den nächsten Schritt in der Geschichte.
    public function process_user_decision($user_id, $decision) {
        $current_story_id = $this->storyManager->get_user_current_story($user_id);
        $next_story_id = $this->determine_next_story($current_story_id, $decision);

        $this->storyManager->save_user_progress($user_id, $next_story_id);
        return $this->storyManager->get_story_by_id($next_story_id);
    }

    // Basierend auf der aktuellen Geschichte und der Benutzerentscheidung wird bestimmt, welche Story als nächstes geladen werden sollte.
    private function determine_next_story($current_story_id, $decision) {
        // Hier würden Sie die Logik implementieren, die basierend auf der Benutzerentscheidung bestimmt, welcher Pfad in der Geschichte als nächstes genommen wird.
        // Dies kann durch eine Abfrage in einer Datenbank oder durch andere Mittel erreicht werden.
        // Für den Moment gebe ich eine einfache Implementierung zurück, die die Geschichte basierend auf der Entscheidung erhöht:
        return $current_story_id + 1;
    }

    // Gibt die nächste Verzweigung oder Entscheidung zurück, die der Benutzer treffen muss.
    public function get_next_decision($user_id) {
        $current_story_id = $this->storyManager->get_user_current_story($user_id);
        return $this->storyManager->get_decision_for_story($current_story_id);
    }
}
