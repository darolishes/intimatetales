<?php
class IT_Story
{

    private $story_id;
    private $current_scene_id;
    private $user_choices = [];

    public function __construct($story_id)
    {
        $this->story_id = $story_id;
    }

    public function set_current_scene($scene_id)
    {
        $this->current_scene_id = $scene_id;
    }

    public function render_scene()
    {
        // Rendert die aktuelle Szene
    }

    public function make_choice($choice_id)
    {
        // Logik für die Auswahl einer Handlungsoption
    }

    public function get_progress()
    {
        // Gibt den aktuellen Fortschritt zurück
    }

    // Weitere Methoden ...
}
