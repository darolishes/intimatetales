<?php

namespace IntimateTales\User;

class UserActions
{

    private $user;

    public function __construct( User $user )
    {
        $this->user = $user;
    }

    public function sendInvite( User $recipient )
    {
        if ( !$recipient->getEmail() ) {
            throw new InvalidRecipientException();
        }

        $invite_link = wp_nonce_url( ... );

        $wpdb->insert(
            '{$wpdb->prefix}invites',
            [
            'invite_link'  => $invite_link,
            'recipient_id' => $recipient->getID(),
            'sender_id'    => $this->user->getID(),
            ]
        );

        $subject = sprintf( '%s invited you', $this->user->getUsername() );
        $message = "You have been invited by {$this->user->getUsername()} to join ...";

        $result = wp_mail(
            $recipient->getEmail(),
            $subject,
            $message,
            'From: ' . $this->user->getUsername()
        );

        if ( !$result ) {
            throw new InviteSendFailedException();
        }
    }

    public function getInviteForUser( User $user )
    {
        return $wpdb->get_var( $wpdb->prepare(
            "SELECT invite_link 
       FROM {$wpdb->prefix}invites 
       WHERE recipient_id = %d",
            $user->getID()
        ) );
    }

    public function acceptInvite( User $sender )
    {
        $invite_link = $wpdb->get_var( $wpdb->prepare(
            "SELECT invite_link 
       FROM {$wpdb->prefix}invites 
       WHERE recipient_id = %d 
         AND sender_id = %d",
            $this->user->getID(),
            $sender->getID()
        ) );

        if ( ! $invite_link ) {
            throw new InvalidInviteException();
        }

        // Validate nonce
        if ( ! wp_verify_nonce( $invite_link ) ) {
            throw new InvalidInviteException();
        }

        // Accept invite
        $this->user->addFriend( $sender );

        // Update database
        $wpdb->update(
            '{$wpdb->prefix}invites',
            [ 'accepted_at' => current_time( 'mysql' ) ],
            [ 'invite_link' => $invite_link ]
        );

        $subject = sprintf( '%s accepted your invite', $this->user->getName() );
        $message = "Your friend {$this->user->getName()} has accepted your invite.";

        wp_mail(
            $sender->getEmail(),
            $subject,
            $message
        );
    }

    public function joinStory( Story $story )
    {
        $story_id = $story->getID();

        if ( $story->isPrivate() && ! $story->isCreatedBy( $this->user ) ) {
            throw new AccessDeniedException();
        }

        $story->addContributor( $this->user );

        $subject = sprintf( '%s has joined your story', $this->user->getName() );
        $message = "Your new contributor {$this->user->getName()} has joined the story.";

        wp_mail(
            $story->getCreatedBy()->getEmail(),
            $subject,
            $message
        );
    }
}
