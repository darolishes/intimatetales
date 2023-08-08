<h2>Your Invitations</h2>
<?php if (empty($invitations)): ?>
    <p>You have no pending invitations.</p>
<?php else: ?>
    <ul>
        <?php foreach ($invitations as $invitation): ?>
            <li>
                Invitation from <?php echo $invitation->getUsername(); ?>
                <form action="" method="post">
                    <input type="hidden" name="invitation_id" value="<?php echo $invitation->getID(); ?>">
                    <input type="submit" name="accept_invitation" value="Accept">
                    <input type="submit" name="decline_invitation" value="Decline">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
