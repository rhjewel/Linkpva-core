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
