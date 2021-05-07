<div class="calisia-customer-notes">
<?php foreach($args['notes'] as $note){ ?>
    <?php $poster = get_user_by( 'id', $note->added_by ); ?>
    <div class="calisia-customer-notes-<?php echo $note->id; ?>">
        <div class="calisia-customer-note">
            <?php echo $note->text; ?>
        </div>
        <div class="calisia-customer-note-info-bar"><span class="calisia-customer-note-info"><?php echo $note->time; ?> <?php echo $poster->first_name . ' ' . $poster->last_name; ?></span> <a class="calisia-delete-customer-note-button" data-id="<?php echo $note->id; ?>"><?php _e( 'Delete note', 'calisia-customer-notes' ); ?></a></div>
    </div>
<?php } ?>
</div>