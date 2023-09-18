<?php

namespace IntimateTales\Classes;

use IntimateTales\Classes\User;

if (!defined('ABSPATH')) {
    exit;
}

class Onboarding
{
    const ONBOARDING_STEP_META_KEY = 'it_onboarding_step';

    private $user_id;
    private $current_step;

    public function __construct(ä $user_id)
    {
        $this->user_id = $user_id;
        $this->current_step = $this->get_current_step();
    }

    public function get_current_step()
    {
        // Holt den aktuellen Onboarding-Schritt aus der Benutzer-Metadaten
        return get_user_meta($this->user_id, self::ONBOARDING_STEP_META_KEY, true);
    }

    public function set_current_step($step)
    {
        // Setzt den aktuellen Onboarding-Schritt in den Benutzer-Metadaten
        update_user_meta($this->user_id, self::ONBOARDING_STEP_META_KEY, $step);
        $this->current_step = $step;
    }

    public function render_step()
    {
        // Rendert den aktuellen Schritt des Onboardings
        // Die genaue Logik hängt von der Implementierung Ihrer Anwendung ab
        // Sie könnten eine Switch-Anweisung oder eine Reihe von if-Anweisungen verwenden, um den richtigen Schritt zu rendern
        switch ($this->current_step) {
            case 1:
                $this->render_step_1();
                break;
            case 2:
                $this->render_step_2();
                break;
            case 3:
                $this->render_step_3();
                break;
            case 4:
                $this->render_step_4();
                break;
            case 5:
                $this->render_step_5();
                break;

            default:
                break;
        }

        return $this->current_step;
    }

    public function submit_step_data($data)
    {
        switch ($this->current_step) {
            case 1:
                $this->submit_step_1_data($data);
                break;
            case 2:
                $this->submit_step_2_data($data);
                break;
            case 3:
                $this->submit_step_3_data($data);
                break;
            case 4:
                $this->submit_step_4_data($data);
                break;
            case 5:
                $this->submit_step_5_data($data);
                break;

            default:
                break;
        }

        // Geht zum nächsten Schritt
        $this->go_to_next_step();
    }

    private function go_to_next_step()
    {
        // Erhöht den aktuellen Schritt um eins
        $this->set_current_step($this->current_step + 1);
    }
}
