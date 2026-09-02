<?php

function login_register_form_by_woocommerce()
{
    if (!class_exists('WooCommerce') || !function_exists('wc_get_page_permalink')) {
        return '';
    }

    static $instance = 0;
    $instance++;

    $form_id                   = 'linkpva-auth-' . $instance;
    $login_panel_id            = $form_id . '-login-panel';
    $register_panel_id         = $form_id . '-register-panel';
    $registration_enabled      = 'yes' === get_option('woocommerce_enable_myaccount_registration', 'no');
    $generate_username         = 'no' !== get_option('woocommerce_registration_generate_username', 'yes');
    $generate_password         = 'no' !== get_option('woocommerce_registration_generate_password', 'yes');
    $is_login_submission       = isset($_POST['login']); // phpcs:ignore WordPress.Security.NonceVerification.Missing
    $is_register_submission    = $registration_enabled && isset($_POST['register']); // phpcs:ignore WordPress.Security.NonceVerification.Missing
    $login_username            = $is_login_submission && isset($_POST['username']) && is_string($_POST['username']) ? wp_unslash($_POST['username']) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing
    $register_username         = $is_register_submission && isset($_POST['username']) && is_string($_POST['username']) ? wp_unslash($_POST['username']) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing
    $register_email            = $is_register_submission && isset($_POST['email']) && is_string($_POST['email']) ? wp_unslash($_POST['email']) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing
    $register_display_name     = $is_register_submission && isset($_POST['display_name']) && is_string($_POST['display_name']) ? wp_unslash($_POST['display_name']) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing
    $my_account_url            = wc_get_page_permalink('myaccount');
    $my_account_url            = $my_account_url ?: home_url('/');
    $lost_password_url         = function_exists('wc_lostpassword_url') ? wc_lostpassword_url() : wp_lostpassword_url();
    $terms_page_id             = function_exists('wc_terms_and_conditions_page_id') ? absint(wc_terms_and_conditions_page_id()) : 0;
    $terms_url                 = $terms_page_id ? get_permalink($terms_page_id) : '';
    $privacy_url               = get_privacy_policy_url();
    $notices                   = function_exists('wc_print_notices') ? wc_print_notices(true) : '';

    ob_start();

    if (!is_user_logged_in()) {
        do_action('woocommerce_before_customer_login_form');
    }
?>
    <section class="linkpva-auth-wrap woocommerce">
        <div class="container">
            <div class="linkpva-content-card linkpva-auth-card">
                <span class="linkpva-section-tag"><?php echo esc_html__('Customer Account', 'linkpva-core'); ?></span>
                <h1><?php echo esc_html__('Access your account', 'linkpva-core'); ?></h1>

                <?php if (is_user_logged_in()) : ?>
                    <?php $current_user = wp_get_current_user(); ?>
                    <p><?php echo esc_html(sprintf(__('You are signed in as %s.', 'linkpva-core'), $current_user->display_name)); ?></p>

                    <?php
                    // Notices are generated and escaped by WooCommerce templates.
                    echo $notices; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?>

                    <a class="linkpva-button linkpva-button-primary w-100" href="<?php echo esc_url($my_account_url); ?>">
                        <?php echo esc_html__('Go to My Account', 'linkpva-core'); ?>
                    </a>
                    <a class="linkpva-text-link linkpva-auth-logout" href="<?php echo esc_url(wc_logout_url($my_account_url)); ?>">
                        <?php echo esc_html__('Sign out', 'linkpva-core'); ?>
                    </a>
                <?php else : ?>
                    <p><?php echo esc_html__('Sign in to manage your orders or create a new customer account.', 'linkpva-core'); ?></p>

                    <?php
                    // Notices are generated and escaped by WooCommerce templates.
                    echo $notices; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?>

                    <div class="linkpva-tabs linkpva-auth-tabs" data-tabs>
                        <div class="linkpva-tab-nav linkpva-auth-tab-nav<?php echo $registration_enabled ? '' : ' has-single-tab'; ?>" role="tablist" aria-label="<?php echo esc_attr__('Customer account options', 'linkpva-core'); ?>">
                            <button class="<?php echo $is_register_submission ? '' : 'is-active'; ?>" type="button" role="tab" aria-selected="<?php echo $is_register_submission ? 'false' : 'true'; ?>" aria-controls="<?php echo esc_attr($login_panel_id); ?>" data-tab-target="<?php echo esc_attr($login_panel_id); ?>">
                                <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i> <?php echo esc_html__('Sign In', 'linkpva-core'); ?>
                            </button>

                            <?php if ($registration_enabled) : ?>
                                <button class="<?php echo $is_register_submission ? 'is-active' : ''; ?>" type="button" role="tab" aria-selected="<?php echo $is_register_submission ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr($register_panel_id); ?>" data-tab-target="<?php echo esc_attr($register_panel_id); ?>">
                                    <i class="bi bi-person-plus" aria-hidden="true"></i> <?php echo esc_html__('Register', 'linkpva-core'); ?>
                                </button>
                            <?php endif; ?>
                        </div>

                        <div class="linkpva-tab-panel" id="<?php echo esc_attr($login_panel_id); ?>" role="tabpanel" <?php echo $is_register_submission ? ' hidden' : ''; ?>>
                            <h2><?php echo esc_html__('Welcome back', 'linkpva-core'); ?></h2>
                            <p><?php echo esc_html__('Enter your customer details to continue.', 'linkpva-core'); ?></p>

                            <form class="woocommerce-form woocommerce-form-login login" method="post" novalidate>
                                <?php do_action('woocommerce_login_form_start'); ?>

                                <div class="linkpva-form-field mb-3">
                                    <label for="<?php echo esc_attr($form_id); ?>-login-username"><?php echo esc_html__('Username or email address', 'linkpva-core'); ?></label>
                                    <input id="<?php echo esc_attr($form_id); ?>-login-username" name="username" type="text" autocomplete="username" value="<?php echo esc_attr($login_username); ?>" required aria-required="true">
                                </div>
                                <div class="linkpva-form-field mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="<?php echo esc_attr($form_id); ?>-login-password"><?php echo esc_html__('Password', 'linkpva-core'); ?></label>
                                        <a class="small" href="<?php echo esc_url($lost_password_url); ?>"><?php echo esc_html__('Forgot password?', 'linkpva-core'); ?></a>
                                    </div>
                                    <input id="<?php echo esc_attr($form_id); ?>-login-password" name="password" type="password" autocomplete="current-password" required aria-required="true">
                                </div>

                                <?php do_action('woocommerce_login_form'); ?>

                                <label class="linkpva-checkbox mb-3" for="<?php echo esc_attr($form_id); ?>-rememberme">
                                    <input id="<?php echo esc_attr($form_id); ?>-rememberme" name="rememberme" type="checkbox" value="forever">
                                    <span><?php echo esc_html__('Remember this device', 'linkpva-core'); ?></span>
                                </label>

                                <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                                <input type="hidden" name="redirect" value="<?php echo esc_url($my_account_url); ?>">
                                <button class="linkpva-button linkpva-button-primary woocommerce-form-login__submit w-100" type="submit" name="login" value="<?php echo esc_attr__('Sign In', 'linkpva-core'); ?>">
                                    <?php echo esc_html__('Sign In', 'linkpva-core'); ?>
                                </button>

                                <?php do_action('woocommerce_login_form_end'); ?>
                            </form>
                        </div>

                        <?php if ($registration_enabled) : ?>
                            <div class="linkpva-tab-panel" id="<?php echo esc_attr($register_panel_id); ?>" role="tabpanel" <?php echo $is_register_submission ? '' : ' hidden'; ?>>
                                <h2><?php echo esc_html__('Create an account', 'linkpva-core'); ?></h2>
                                <p><?php echo esc_html__('Create your customer account to manage orders and account details.', 'linkpva-core'); ?></p>

                                <form class="woocommerce-form woocommerce-form-register register" method="post" <?php do_action('woocommerce_register_form_tag'); ?>>
                                    <?php do_action('woocommerce_register_form_start'); ?>

                                    <div class="linkpva-form-field mb-3">
                                        <label for="<?php echo esc_attr($form_id); ?>-register-name"><?php echo esc_html__('Display name', 'linkpva-core'); ?></label>
                                        <input id="<?php echo esc_attr($form_id); ?>-register-name" name="display_name" type="text" autocomplete="name" value="<?php echo esc_attr($register_display_name); ?>" required aria-required="true">
                                    </div>

                                    <?php if (!$generate_username) : ?>
                                        <div class="linkpva-form-field mb-3">
                                            <label for="<?php echo esc_attr($form_id); ?>-register-username"><?php echo esc_html__('Username', 'linkpva-core'); ?></label>
                                            <input id="<?php echo esc_attr($form_id); ?>-register-username" name="username" type="text" autocomplete="username" value="<?php echo esc_attr($register_username); ?>" required aria-required="true">
                                        </div>
                                    <?php endif; ?>

                                    <div class="linkpva-form-field mb-3">
                                        <label for="<?php echo esc_attr($form_id); ?>-register-email"><?php echo esc_html__('Email address', 'linkpva-core'); ?></label>
                                        <input id="<?php echo esc_attr($form_id); ?>-register-email" name="email" type="email" autocomplete="email" value="<?php echo esc_attr($register_email); ?>" required aria-required="true">
                                    </div>

                                    <?php if (!$generate_password) : ?>
                                        <div class="linkpva-form-field mb-3">
                                            <label for="<?php echo esc_attr($form_id); ?>-register-password"><?php echo esc_html__('Password', 'linkpva-core'); ?></label>
                                            <input id="<?php echo esc_attr($form_id); ?>-register-password" name="password" type="password" autocomplete="new-password" required aria-required="true">
                                        </div>
                                    <?php else : ?>
                                        <p class="linkpva-auth-generated-password"><?php echo esc_html__('A link to set a password will be sent to your email address.', 'linkpva-core'); ?></p>
                                    <?php endif; ?>

                                    <?php do_action('woocommerce_register_form'); ?>

                                    <label class="linkpva-checkbox" for="<?php echo esc_attr($form_id); ?>-terms">
                                        <input id="<?php echo esc_attr($form_id); ?>-terms" name="linkpva_terms" type="checkbox" value="1" required aria-required="true">
                                        <span>
                                            <?php echo esc_html__('I agree to the', 'linkpva-core'); ?>
                                            <?php if ($terms_url) : ?><a href="<?php echo esc_url($terms_url); ?>"><?php echo esc_html__('terms', 'linkpva-core'); ?></a><?php else : ?><?php echo esc_html__('terms', 'linkpva-core'); ?><?php endif; ?>
                                                <?php echo esc_html__('and', 'linkpva-core'); ?>
                                                <?php if ($privacy_url) : ?><a href="<?php echo esc_url($privacy_url); ?>"><?php echo esc_html__('privacy policy', 'linkpva-core'); ?></a><?php else : ?><?php echo esc_html__('privacy policy', 'linkpva-core'); ?><?php endif; ?>.
                                        </span>
                                    </label>

                                    <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                                    <input type="hidden" name="linkpva_registration_form" value="1">
                                    <input type="hidden" name="redirect" value="<?php echo esc_url($my_account_url); ?>">
                                    <button class="linkpva-button linkpva-button-primary woocommerce-form-register__submit w-100 mt-3" type="submit" name="register" value="<?php echo esc_attr__('Register', 'linkpva-core'); ?>">
                                        <?php echo esc_html__('Register', 'linkpva-core'); ?>
                                    </button>

                                    <?php do_action('woocommerce_register_form_end'); ?>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
    if (!is_user_logged_in()) {
        do_action('woocommerce_after_customer_login_form');
    }

    return ob_get_clean();
}
add_shortcode('login_register_form', 'login_register_form_by_woocommerce');


function linkpva_validate_woocommerce_registration_fields($errors, $username, $password, $email)
{
    if (empty($_POST['linkpva_registration_form'])) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
        return $errors;
    }

    $display_name = isset($_POST['display_name']) && is_string($_POST['display_name']) ? sanitize_text_field(wp_unslash($_POST['display_name'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing

    if ('' === $display_name) {
        $errors->add('linkpva_display_name_required', __('Display name is required.', 'linkpva-core'));
    }

    if (empty($_POST['linkpva_terms'])) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
        $errors->add('linkpva_terms_required', __('Please accept the terms and privacy policy.', 'linkpva-core'));
    }

    return $errors;
}
add_filter('woocommerce_process_registration_errors', 'linkpva_validate_woocommerce_registration_fields', 10, 4);


function linkpva_save_woocommerce_customer_display_name($customer_id)
{
    if (empty($_POST['linkpva_registration_form']) || empty($_POST['display_name']) || !is_string($_POST['display_name'])) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
        return;
    }

    $display_name = sanitize_text_field(wp_unslash($_POST['display_name'])); // phpcs:ignore WordPress.Security.NonceVerification.Missing

    if ($display_name) {
        wp_update_user(array(
            'ID'           => absint($customer_id),
            'display_name' => $display_name,
            'nickname'     => $display_name,
        ));
    }
}
add_action('woocommerce_created_customer', 'linkpva_save_woocommerce_customer_display_name');




function language_shortcode()
{
    ?>
    <div class="language-btn">
        <div class="icon-and-content">
            <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <path d="M8 16C12.41 16 16 12.41 16 8C16 3.59 12.41 0 8 0C3.59 0 0 3.59 0 8C0 12.41 3.59 16 8 16ZM8.3925 12.1425C9.1675 12.1625 9.9225 12.2425 10.6375 12.375C10.0975 13.8725 9.295 14.92 8.3925 15.16V12.1425ZM8.3925 11.355V8.3925H11.34C11.31 9.5575 11.1425 10.655 10.8775 11.62C10.0875 11.4675 9.25 11.375 8.3925 11.355ZM8.3925 7.6075V4.645C9.25 4.6225 10.0875 4.5325 10.875 4.38C11.1425 5.345 11.3075 6.4425 11.3375 7.6075H8.3925ZM8.3925 3.8575V0.84C9.2925 1.08 10.095 2.1275 10.6375 3.625C9.925 3.76 9.17 3.8375 8.3925 3.8575ZM7.6075 3.8575C6.83 3.8375 6.075 3.7575 5.3625 3.625C5.9025 2.1275 6.705 1.08 7.6075 0.84V3.8575ZM7.6075 4.645V7.6075H4.66C4.69 6.4425 4.8575 5.345 5.1225 4.38C5.9125 4.5325 6.7475 4.625 7.6075 4.645ZM7.6075 8.3925V11.355C6.7475 11.3775 5.9125 11.4675 5.125 11.62C4.8575 10.6575 4.6925 9.5575 4.6625 8.3925H7.6075ZM7.6075 12.1425V15.16C6.7075 14.92 5.9025 13.8725 5.3625 12.375C6.0725 12.24 6.8275 12.1625 7.6075 12.1425ZM5.8725 14.8925C4.76228 14.5474 3.75135 13.9403 2.925 13.1225C3.42 12.89 3.98 12.7 4.5775 12.5475C4.915 13.5025 5.3575 14.3025 5.8725 14.8925ZM11.42 12.5475C12.02 12.7025 12.575 12.895 13.07 13.125C12.2458 13.9425 11.2363 14.5488 10.1275 14.8925C10.6425 14.305 11.0825 13.5025 11.42 12.5475ZM11.6525 11.7975C11.93 10.78 12.0975 9.6275 12.1275 8.395H15.2025C15.1206 9.90237 14.5661 11.3457 13.6175 12.52C13.035 12.2275 12.3725 11.985 11.6525 11.7975ZM12.1275 7.6075C12.0975 6.3725 11.93 5.22 11.6525 4.205C12.3725 4.0175 13.035 3.775 13.615 3.4825C14.535 4.625 15.1175 6.0525 15.2 7.6075H12.1275ZM11.42 3.4525C11.085 2.4975 10.6425 1.695 10.1275 1.1075C11.25 1.455 12.255 2.07 13.07 2.875C12.575 3.105 12.0175 3.2975 11.42 3.4525ZM4.58 3.4525C3.98 3.2975 3.425 3.1075 2.93 2.875C3.745 2.0675 4.75 1.455 5.8725 1.1075C5.3575 1.695 4.9175 2.4975 4.58 3.4525ZM4.3475 4.2025C4.07 5.22 3.9025 6.3725 3.8725 7.605H0.7975C0.8825 6.0475 1.4625 4.62 2.3825 3.48C2.965 3.7725 3.6275 4.015 4.3475 4.2025ZM3.8725 8.3925C3.9025 9.6275 4.07 10.78 4.3475 11.795C3.6275 11.9825 2.965 12.225 2.385 12.5175C1.465 11.375 0.8825 9.95 0.8 8.3925H3.8725Z"></path>
                </g>
            </svg>
            <span>EN</span>
        </div>
        <i class="bi bi-caret-down-fill"></i>
    </div>
    <ul class="language-list">
        <li><a href="#">English</a></li>
        <li><a href="#">Dutch</a></li>
        <li><a href="#">Japanese</a></li>
        <li><a href="#">Korean</a></li>
        <li><a href="#">Chinese</a></li>
    </ul>
<?php
}
add_shortcode('languages-switcher', 'language_shortcode');
