<h2>Nasze uwagi na temat klienta</h2>
<?php /*global $post,$user;
echo "Dd:";
var_dump($post);*/ ?>
<table  class="form-table" role="presentation">
    <tbody>
        <tr>
            <th><label for="_calisia_user_desc">Notatka</label></th>
            <td><?php woocommerce_wp_textarea_input($args['client_desc_settings']); ?></td>
        </tr>
        <tr>
            <th><label for="_calisia_user_trait">Cecha</label></th>
            <td><?php woocommerce_wp_select($args['client_trait_settings']); ?></td>
        </tr>
    </tbody>
</table>