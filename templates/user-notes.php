<div class="calisia-customer-notes">
<?php foreach($args['notes'] as $note){ ?>
    <?php 
        $poster = get_user_by( 'id', $note->added_by ); 
        $poster_name = trim($poster->first_name . ' ' . $poster->last_name);
        $poster_name = !empty($poster_name) ? $poster_name : $poster->user_login;
    ?>
    <div class="calisia-customer-notes-<?php echo $note->id; ?>">
        <div class="calisia-customer-note">
            <?php echo $note->text; ?>
        </div>
        <div class="calisia-customer-note-info-bar"><span class="calisia-customer-note-info"><?php echo $note->time; ?> <?php echo $poster_name; ?></span> <a class="calisia-delete-customer-note-button" data-id="<?php echo $note->id; ?>"><?php _e( 'Delete note', 'calisia-customer-notes' ); ?></a></div>
    </div>
<?php } ?>
<input type="hidden" id="calisia-nonce"   name="calisia-nonce"   value="<?php echo $args['nonce']; ?>">
<input type="hidden" id="calisia-user-id" name="calisia-user-id" value="<?php echo $args['user_id']; ?>">
</div>