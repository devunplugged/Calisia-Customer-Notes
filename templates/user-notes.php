<div class="calisia-customer-notes">
<?php foreach($args['notes'] as $note){ ?>
    <div class="calisia-customer-notes-<?php echo $note->id; ?>">
        <div class="calisia-customer-note">
            <?php echo $note->text; ?>
        </div>
        <div class="calisia-customer-note-info-bar"><span class="calisia-customer-note-info"><?php echo $note->time; ?> <?php echo $args['user']->first_name . ' ' . $args['user']->last_name; ?></span> <a class="calisia-delete-customer-note-button" data-id="<?php echo $note->id; ?>"><?php _e( 'Delete note', 'calisia-customer-notes' ); ?></a></div>
    </div>
<?php } ?>
</div>