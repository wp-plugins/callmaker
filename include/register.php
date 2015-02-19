<?php
$regFormErr = '';

global $sServiceUrl;

if (!empty($_REQUEST['reg_form'])) {
    $regForm = cleanQuery($_REQUEST['reg_form']);
    $curlResult = apiGet('http://' . $sServiceUrl . '/api/company/create/', $regForm);
    if (!empty($curlResult->res) && $curlResult->res == 'err' && $curlResult->descr != 'already_registered') {
        $regFormErr = '<p>' . translate('An error occurred while trying to register. Please try again later') . '</p>';
    } else {
        // if register is successful, save data in options and redirect to settings page
        update_option('callmaker_login', $regForm['email']);
        update_option('show_callmaker_widget', 1);
        echo '
        <script>
        window.location.href = "' . admin_url('admin.php?page=callmaker/index.php') . '";
        </script>
        ';
    }
}
?>

<div class="wrap">
    <h2><?php _e('Callmaker Registration'); ?></h2>

    <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>" name="reg_form">
        <table class="form-table">
            <tr valign="top" class="form-field term-website-wrap">
                <th scope="row"><?php _e('Site url'); ?></th>
                <td><input type="text" name="reg_form[website]" value="<?= get_home_url(); ?>"/>
                </td>
            </tr>
            <tr valign="top" class="form-field term-name-wrap">
                <th scope="row"><?php _e('Your name'); ?></th>
                <td><input type="text" name="reg_form[name]" autocomplete="off" value=""/>
                </td>
            </tr>
            <tr valign="top" class="form-field term-email-wrap">
                <th scope="row"><?php _e('Your e-mail'); ?></th>
                <td><input type="text" name="reg_form[email]" value=""/>
                </td>
            </tr>
            <tr valign="top" class="form-field term-phone-wrap">
                <th scope="row"><?php _e('Phone number'); ?></th>
                <td><input type="text" name="reg_form[phone]" value=""/>
                </td>
            </tr>
            <tr valign="top" class="form-field term-pass-wrap">
                <th scope="row"><?php _e('Password'); ?></th>
                <td><input type="password" name="reg_form[pass]" autocomplete="off" value=""/>
                </td>
            </tr>
        </table>
        <?= $regFormErr; ?>
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Register') ?>"/>
        </p>
    </form>
</div>