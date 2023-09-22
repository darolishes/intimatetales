<?php
/**
 * UserAction class represents user action model in the application.
 */
class UserAction extends BaseAction {
	private Participant $participant;

    /**
     * __Construct
     * 
     * This method handles __construct functionality for UserAction.
     */
	public function __construct(Participant $participant) {
		$this->participant = $participant;
	}
}