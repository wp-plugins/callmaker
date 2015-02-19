<?php
global $sServiceUrl;
?>
<div class="wrap">
    <h2><?php _e('Callmaker settings'); ?></h2>

    <form method="post" action="options.php">
        <?php wp_nonce_field('update-options'); ?>
        <table class="form-table">
            <tr valign="top" class="form-field term-login-wrap">
                <th scope="row"><?php _e('Login (email)'); ?></th>
                <td><input type="text" name="callmaker_login" value="<?= get_option('callmaker_login'); ?>"/>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php _e('Show widget'); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e('Show widget'); ?></span></legend>
                        <label for="show_widget">
                            <input name="show_widget" type="checkbox" id="show_callmaker_widget"
                                   value="1" <?= checked(get_option('show_callmaker_widget'), 1, false); ?>">
                            <?php _e('Enable widget'); ?></label>
                    </fieldset>
                </td>

            </tr>
        </table>
        <input type="hidden" name="action" value="update"/>
        <input type="hidden" name="page_options" value="callmaker_login,show_callmaker_widget"/>

        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>"/>
        </p>
    </form>

    <?php $callmaker_login = get_option('callmaker_login');
    if (empty($callmaker_login)) {
        ?>
        <a href="admin.php?page=callmaker/register.php"><?php _e("Not a member? Start working with Callmaker"); ?> &raquo;</a>
    <?php } ?>
</div>