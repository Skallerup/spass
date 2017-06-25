<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_admin_general_settings') ): 
    function reales_admin_general_settings() {
        add_settings_section( 'reales_generalSettings_section', __( 'General Settings', 'reales' ), 'reales_general_settings_section_callback', 'reales_general_settings' );
        add_settings_field( 'reales_logo_field', __( 'Logo', 'reales' ), 'reales_logo_field_render', 'reales_general_settings', 'reales_generalSettings_section' );
        add_settings_field( 'reales_app_logo_field', __( 'App Logo (32x32px)', 'reales' ), 'reales_app_logo_field_render', 'reales_general_settings', 'reales_generalSettings_section' );
        add_settings_field( 'reales_favicon_field', __( 'Favicon', 'reales' ), 'reales_favicon_field_render', 'reales_general_settings', 'reales_generalSettings_section' );
        add_settings_field( 'reales_country_field', __( 'Country', 'reales' ), 'reales_country_field_render', 'reales_general_settings', 'reales_generalSettings_section' );
        add_settings_field( 'reales_locale_field', __( 'Price format', 'reales' ), 'reales_locale_field_render', 'reales_general_settings', 'reales_generalSettings_section' );
        add_settings_field( 'reales_decimals_field', __( 'Use decimals for price', 'reales' ), 'reales_decimals_field_render', 'reales_general_settings', 'reales_generalSettings_section' );
        add_settings_field( 'reales_currency_symbol_field', __( 'Currency Symbol', 'reales' ), 'reales_currency_symbol_field_render', 'reales_general_settings', 'reales_generalSettings_section' );
        add_settings_field( 'reales_currency_symbol_pos_field', __( 'Currency Symbol Position', 'reales' ), 'reales_currency_symbol_pos_field_render', 'reales_general_settings', 'reales_generalSettings_section' );
        add_settings_field( 'reales_max_price_field', __( 'Max price for properties filter', 'reales' ), 'reales_max_price_field_render', 'reales_general_settings', 'reales_generalSettings_section' );
        add_settings_field( 'reales_unit_field', __( 'Measurement Unit', 'reales' ), 'reales_unit_field_render', 'reales_general_settings', 'reales_generalSettings_section' );
        add_settings_field( 'reales_max_area_field', __( 'Max area value for properties filter', 'reales' ), 'reales_max_area_field_render', 'reales_general_settings', 'reales_generalSettings_section' );
        add_settings_field( 'reales_max_files_field', __( 'Maximum number of uploaded photos', 'reales' ), 'reales_max_files_field_render', 'reales_general_settings', 'reales_generalSettings_section' );
        add_settings_field( 'reales_review_field', __( 'Front-end property publish without admin approval', 'reales' ), 'reales_review_field_render', 'reales_general_settings', 'reales_generalSettings_section' );
        add_settings_field( 'reales_agents_rate_field', __( 'Enable agent reviews and rating', 'reales' ), 'reales_agents_rating_field_render', 'reales_general_settings', 'reales_generalSettings_section' );
        add_settings_field( 'reales_report_field', __( 'Enable report property', 'reales' ), 'reales_report_field_render', 'reales_general_settings', 'reales_generalSettings_section' );
    }
endif;

if( !function_exists('reales_general_settings_section_callback') ): 
    function reales_general_settings_section_callback() { 
        echo '';
    }
endif;

if( !function_exists('reales_logo_field_render') ): 
    function reales_logo_field_render() { 
        $options = get_option( 'reales_general_settings' );
        ?>
        <input id="logoImage" type="text" size="40" name="reales_general_settings[reales_logo_field]" value="<?php if(isset($options['reales_logo_field'])) { echo esc_attr($options['reales_logo_field']); } ?>" />
        <input id="logoImageBtn" type="button"  class="button" value="<?php esc_html_e('Browse...','reales') ?>" />
        <?php
    }
endif;

if( !function_exists('reales_app_logo_field_render') ): 
    function reales_app_logo_field_render() { 
        $options = get_option( 'reales_general_settings' );
        ?>
        <input id="appLogoImage" type="text" size="40" name="reales_general_settings[reales_app_logo_field]" value="<?php if(isset($options['reales_app_logo_field'])) { echo esc_attr($options['reales_app_logo_field']); } ?>" />
        <input id="appLogoImageBtn" type="button"  class="button" value="<?php esc_html_e('Browse...','reales') ?>" />
        <?php
    }
endif;

if( !function_exists('reales_favicon_field_render') ): 
    function reales_favicon_field_render() { 
        $options = get_option( 'reales_general_settings' );
        ?>
        <input id="faviconImage" type="text" size="40" name="reales_general_settings[reales_favicon_field]" value="<?php if(isset($options['reales_favicon_field'])) { echo esc_attr($options['reales_favicon_field']); } ?>" />
        <input id="faviconImageBtn" type="button"  class="button" value="<?php esc_html_e('Browse...','reales') ?>" />
        <?php
    }
endif;

if( !function_exists('reales_country_field_render') ): 
    function reales_country_field_render() { 
        $options = get_option( 'reales_general_settings' );

        $countries = array("Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium","Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo, Republic of the", "Congo, Democratic Republic of the", "Costa Rica", "Cote d Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Danmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kosovo", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "Norway", "Oman", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico", "Qatar", "Romania", "Russia", "Rwanda", "St. Kitts and Nevis", "St. Lucia", "St. Vincent and The Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe");
        $country_select = '<select id="reales_general_settings[reales_country_field]" name="reales_general_settings[reales_country_field]">';

        foreach($countries as $country) {
            $country_select .= '<option value="' . esc_attr($country) . '"';
            if(isset($options['reales_country_field']) && $options['reales_country_field'] == $country) {
                $country_select .= 'selected="selected"';
            }
            $country_select .= '>' . esc_html($country) . '</option>';
        }

        $country_select .= '</select>';

        print $country_select;
    }
endif;

if( !function_exists('reales_locale_field_render') ): 
    function reales_locale_field_render() { 
        $options = get_option( 'reales_general_settings' );

        $locales = array(
            "en_US" => "English (United States)",
            "af_ZA" => "Afrikaans (South Africa)",
            "sq_AL" => "Albanian (Albania)",
            "ar_BH" => "Arabic (Bahrain)",
            "ar_EG" => "Arabic (Egypt)",
            "ar_IQ" => "Arabic (Iraq)",
            "ar_JO" => "Arabic (Jordan)",
            "ar_KW" => "Arabic (Kuwait)",
            "ar_LB" => "Arabic (Lebanon)",
            "ar_LY" => "Arabic (Libya)",
            "ar_MA" => "Arabic (Morocco)",
            "ar_OM" => "Arabic (Oman)",
            "ar_QA" => "Arabic (Qatar)",
            "ar_SA" => "Arabic (Saudi Arabia)",
            "ar_SD" => "Arabic (Sudan)",
            "ar_SY" => "Arabic (Syria)",
            "ar_TN" => "Arabic (Tunisia)",
            "ar_AE" => "Arabic (United Arab Emirates)",
            "ar_YE" => "Arabic (Yemen)",
            "hy_AM" => "Armenian (Armenia)",
            "as_IN" => "Assamese (India)",
            "bm_ML" => "Bambara (Mali)",
            "eu_ES" => "Basque (Spain)",
            "be_BY" => "Belarusian (Belarus)",
            "bn_BD" => "Bengali (Bangladesh)",
            "bn_IN" => "Bengali (India)",
            "bs_BA" => "Bosnian (Bosnia and Herzegovina)",
            "bg_BG" => "Bulgarian (Bulgaria)",
            "my_MM" => "Burmese (Myanmar [Burma])",
            "ca_ES" => "Catalan (Spain)",
            "cgg_UG" => "Chiga (Uganda)",
            "zh_Hans" => "Chinese (Simplified Han)",
            "zh_Hant" => "Chinese (Traditional Han)",
            "kw_GB" => "Cornish (United Kingdom)",
            "hr_HR" => "Croatian (Croatia)",
            "cs_CZ" => "Czech (Czech Republic)",
            "da_DK" => "Danish (Danmark)",
            "nl_BE" => "Dutch (Belgium)",
            "nl_NL" => "Dutch (Netherlands)",
            "en_AS" => "English (American Samoa)",
            "en_AU" => "English (Australia)",
            "en_BE" => "English (Belgium)",
            "en_BZ" => "English (Belize)",
            "en_BW" => "English (Botswana)",
            "en_CA" => "English (Canada)",
            "en_GU" => "English (Guam)",
            "en_HK" => "English (Hong Kong SAR China)",
            "en_IN" => "English (India)",
            "en_IE" => "English (Ireland)",
            "en_JM" => "English (Jamaica)",
            "en_MT" => "English (Malta)",
            "en_MH" => "English (Marshall Islands)",
            "en_MU" => "English (Mauritius)",
            "en_NA" => "English (Namibia)",
            "en_NZ" => "English (New Zealand)",
            "en_MP" => "English (Northern Mariana Islands)",
            "en_PK" => "English (Pakistan)",
            "en_PH" => "English (Philippines)",
            "en_SG" => "English (Singapore)",
            "en_ZA" => "English (South Africa)",
            "en_TT" => "English (Trinidad and Tobago)",
            "en_UM" => "English (U.S. Minor Outlying Islands)",
            "en_VI" => "English (U.S. Virgin Islands)",
            "en_GB" => "English (United Kingdom)",
            "en_ZW" => "English (Zimbabwe)",
            "et_EE" => "Estonian (Estonia)",
            "fo_FO" => "Faroese (Faroe Islands)",
            "fil_PH" => "Filipino (Philippines)",
            "fi_FI" => "Finnish (Finland)",
            "fr_BE" => "French (Belgium)",
            "fr_BJ" => "French (Benin)",
            "fr_BF" => "French (Burkina Faso)",
            "fr_BI" => "French (Burundi)",
            "fr_CM" => "French (Cameroon)",
            "fr_CA" => "French (Canada)",
            "fr_CF" => "French (Central African Republic)",
            "fr_TD" => "French (Chad)",
            "fr_KM" => "French (Comoros)",
            "fr_CG" => "French (Congo - Brazzaville)",
            "fr_CD" => "French (Congo - Kinshasa)",
            "fr_CI" => "French (Côte d’Ivoire)",
            "fr_DJ" => "French (Djibouti)",
            "fr_GQ" => "French (Equatorial Guinea)",
            "fr_FR" => "French (France)",
            "fr_GA" => "French (Gabon)",
            "fr_GP" => "French (Guadeloupe)",
            "fr_GN" => "French (Guinea)",
            "fr_LU" => "French (Luxembourg)",
            "fr_MG" => "French (Madagascar)",
            "fr_ML" => "French (Mali)",
            "fr_MQ" => "French (Martinique)",
            "fr_MC" => "French (Monaco)",
            "fr_NE" => "French (Niger)",
            "fr_RW" => "French (Rwanda)",
            "fr_RE" => "French (Réunion)",
            "fr_BL" => "French (Saint Barthélemy)",
            "fr_MF" => "French (Saint Martin)",
            "fr_SN" => "French (Senegal)",
            "fr_CH" => "French (Switzerland)",
            "fr_TG" => "French (Togo)",
            "ff_SN" => "Fulah (Senegal)",
            "gl_ES" => "Galician (Spain)",
            "ka_GE" => "Georgian (Georgia)",
            "de_AT" => "German (Austria)",
            "de_BE" => "German (Belgium)",
            "de_DE" => "German (Germany)",
            "de_LI" => "German (Liechtenstein)",
            "de_LU" => "German (Luxembourg)",
            "de_CH" => "German (Switzerland)",
            "el_CY" => "Greek (Cyprus)",
            "el_GR" => "Greek (Greece)",
            "gu_IN" => "Gujarati (India)",
            "guz_KE" => "Gusii (Kenya)",
            "he_IL" => "Hebrew (Israel)",
            "hi_IN" => "Hindi (India)",
            "hu_HU" => "Hungarian (Hungary)",
            "is_IS" => "Icelandic (Iceland)",
            "ig_NG" => "Igbo (Nigeria)",
            "id_ID" => "Indonesian (Indonesia)",
            "ga_IE" => "Irish (Ireland)",
            "it_IT" => "Italian (Italy)",
            "it_CH" => "Italian (Switzerland)",
            "ja_JP" => "Japanese (Japan)",
            "kn_IN" => "Kannada (India)",
            "km_KH" => "Khmer (Cambodia)",
            "ko_KR" => "Korean (South Korea)",
            "khq_ML" => "Koyra Chiini (Mali)",
            "ses_ML" => "Koyraboro Senni (Mali)",
            "lv_LV" => "Latvian (Latvia)",
            "lt_LT" => "Lithuanian (Lithuania)",
            "mk_MK" => "Macedonian (Macedonia)",
            "ms_BN" => "Malay (Brunei)",
            "ms_MY" => "Malay (Malaysia)",
            "ml_IN" => "Malayalam (India)",
            "mt_MT" => "Maltese (Malta)",
            "gv_GB" => "Manx (United Kingdom)",
            "mr_IN" => "Marathi (India)",
            "mfe_MU" => "Morisyen (Mauritius)",
            "ne_IN" => "Nepali (India)",
            "nb_NO" => "Norwegian Bokmål (Norway)",
            "nn_NO" => "Norwegian Nynorsk (Norway)",
            "or_IN" => "Oriya (India)",
            "ps_AF" => "Pashto (Afghanistan)",
            "fa_AF" => "Persian (Afghanistan)",
            "fa_IR" => "Persian (Iran)",
            "pl_PL" => "Polish (Poland)",
            "pt_BR" => "Portuguese (Brazil)",
            "pt_PT" => "Portuguese (Portugal)",
            "pa_Arab" => "Punjabi (Arabic)",
            "ro_MD" => "Romanian (Moldova)",
            "ro_RO" => "Romanian (Romania)",
            "rm_CH" => "Romansh (Switzerland)",
            "ru_MD" => "Russian (Moldova)",
            "ru_RU" => "Russian (Russia)",
            "ru_UA" => "Russian (Ukraine)",
            "sg_CF" => "Sango (Central African Republic)",
            "sr_Latn" => "Serbian (Latin)",
            "ii_CN" => "Sichuan Yi (China)",
            "si_LK" => "Sinhala (Sri Lanka)",
            "sk_SK" => "Slovak (Slovakia)",
            "sl_SI" => "Slovenian (Slovenia)",
            "so_ET" => "Somali (Ethiopia)",
            "es_AR" => "Spanish (Argentina)",
            "es_BO" => "Spanish (Bolivia)",
            "es_CL" => "Spanish (Chile)",
            "es_CO" => "Spanish (Colombia)",
            "es_CR" => "Spanish (Costa Rica)",
            "es_DO" => "Spanish (Dominican Republic)",
            "es_EC" => "Spanish (Ecuador)",
            "es_SV" => "Spanish (El Salvador)",
            "es_GQ" => "Spanish (Equatorial Guinea)",
            "es_GT" => "Spanish (Guatemala)",
            "es_HN" => "Spanish (Honduras)",
            "es_419" => "Spanish (Latin America)",
            "es_MX" => "Spanish (Mexico)",
            "es_NI" => "Spanish (Nicaragua)",
            "es_PA" => "Spanish (Panama)",
            "es_PY" => "Spanish (Paraguay)",
            "es_PE" => "Spanish (Peru)",
            "es_PR" => "Spanish (Puerto Rico)",
            "es_ES" => "Spanish (Spain)",
            "es_US" => "Spanish (United States)",
            "es_UY" => "Spanish (Uruguay)",
            "es_VE" => "Spanish (Venezuela)",
            "sw_KE" => "Swahili (Kenya)",
            "sw_TZ" => "Swahili (Tanzania)",
            "sv_FI" => "Swedish (Finland)",
            "sv_SE" => "Swedish (Sweden)",
            "gsw_CH" => "Swiss German (Switzerland)",
            "shi_Latn" => "Tachelhit (Latin)",
            "ta_IN" => "Tamil (India)",
            "ta_LK" => "Tamil (Sri Lanka)",
            "te_IN" => "Telugu (India)",
            "th_TH" => "Thai (Thailand)",
            "bo_CN" => "Tibetan (China)",
            "bo_IN" => "Tibetan (India)",
            "to_TO" => "Tonga (Tonga)",
            "tr_TR" => "Turkish (Turkey)",
            "uk_UA" => "Ukrainian (Ukraine)",
            "ur_IN" => "Urdu (India)",
            "ur_PK" => "Urdu (Pakistan)",
            "uz_Arab" => "Uzbek (Arabic)",
            "uz_Latn" => "Uzbek (Latin)",
            "vi_VN" => "Vietnamese (Vietnam)",
            "cy_GB" => "Welsh (United Kingdom)",
            "zu_ZA" => "Zulu (South Africa)",
        );
        $locale_select = '<select id="reales_general_settings[reales_locale_field]" name="reales_general_settings[reales_locale_field]">';

        foreach($locales as $key => $value) {
            $locale_select .= '<option value="' . esc_attr($key) . '"';
            if(isset($options['reales_locale_field']) && $options['reales_locale_field'] == $key) {
                $locale_select .= 'selected="selected"';
            }
            $locale_select .= '>' . esc_html($value) . '</option>';
        }

        $locale_select .= '</select>';

        print $locale_select;
    }
endif;

if( !function_exists('reales_decimals_field_render') ): 
    function reales_decimals_field_render() {
        $options = get_option( 'reales_general_settings' );
        ?>
        <input type="checkbox" name="reales_general_settings[reales_decimals_field]" <?php if(isset($options['reales_decimals_field'])) { checked( $options['reales_decimals_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_currency_symbol_field_render') ): 
    function reales_currency_symbol_field_render() {
        $options = get_option( 'reales_general_settings' );
        ?>
        <input id="reales_general_settings[reales_currency_symbol_field]" type="text" size="10" name="reales_general_settings[reales_currency_symbol_field]" value="<?php if(isset($options['reales_currency_symbol_field'])) { echo esc_attr($options['reales_currency_symbol_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_currency_symbol_pos_field_render') ): 
    function reales_currency_symbol_pos_field_render() {
        $options = get_option( 'reales_general_settings' );

        $position_select = '<select id="reales_general_settings[reales_currency_symbol_pos_field]" name="reales_general_settings[reales_currency_symbol_pos_field]">';
        $position_select .= '<option value="before"';
        if(isset($options['reales_currency_symbol_pos_field']) && $options['reales_currency_symbol_pos_field'] == 'before') {
            $position_select .= 'selected="selected"';
        }
        $position_select .= '>' . __('before', 'reales') . '</option>';
        $position_select .= '<option value="after"';
        if(isset($options['reales_currency_symbol_pos_field']) && $options['reales_currency_symbol_pos_field'] == 'after') {
            $position_select .= 'selected="selected"';
        }
        $position_select .= '>' . __('after', 'reales') . '</option>';
        $position_select .= '</select>';

        print $position_select;
    }
endif;

if( !function_exists('reales_max_price_field_render') ): 
    function reales_max_price_field_render() {
        $options = get_option( 'reales_general_settings' );
        ?>
        <input id="reales_general_settings[reales_max_price_field]" type="text" size="10" name="reales_general_settings[reales_max_price_field]" value="<?php if(isset($options['reales_max_price_field'])) { echo esc_attr($options['reales_max_price_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_unit_field_render') ): 
    function reales_unit_field_render() {
        $options = get_option( 'reales_general_settings' );

        $units = array(__('sq ft', 'reales'), __('sq m', 'reales'));
        $unit_select = '<select id="reales_general_settings[reales_unit_field]" name="reales_general_settings[reales_unit_field]">';

        foreach($units as $unit) {
            $unit_select .= '<option value="' . esc_attr($unit) . '"';
            if(isset($options['reales_unit_field']) && $options['reales_unit_field'] == $unit) {
                $unit_select .= 'selected="selected"';
            }
            $unit_select .= '>' . esc_html($unit) . '</option>';
        }

        $unit_select .= '</select>';

        print $unit_select;
    }
endif;

if( !function_exists('reales_max_area_field_render') ): 
    function reales_max_area_field_render() {
        $options = get_option( 'reales_general_settings' );
        ?>
        <input id="reales_general_settings[reales_max_area_field]" type="text" size="10" name="reales_general_settings[reales_max_area_field]" value="<?php if(isset($options['reales_max_area_field'])) { echo esc_attr($options['reales_max_area_field']); } ?>" /> <?php if(isset($options['reales_unit_field'])) { echo esc_html($options['reales_unit_field']); } ?>
        <?php
    }
endif;

if( !function_exists('reales_max_files_field_render') ): 
    function reales_max_files_field_render() {
        $options = get_option( 'reales_general_settings' );
        ?>
        <input id="reales_general_settings[reales_max_files_field]" type="text" size="10" name="reales_general_settings[reales_max_files_field]" value="<?php if(isset($options['reales_max_files_field'])) { echo esc_attr($options['reales_max_files_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_review_field_render') ): 
    function reales_review_field_render() {
        $options = get_option( 'reales_general_settings' );
        ?>
        <input type="checkbox" name="reales_general_settings[reales_review_field]" <?php if(isset($options['reales_review_field'])) { checked( $options['reales_review_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_agents_rating_field_render') ): 
    function reales_agents_rating_field_render() {
        $options = get_option( 'reales_general_settings' );
        ?>
        <input type="checkbox" name="reales_general_settings[reales_agents_rating_field]" <?php if(isset($options['reales_agents_rating_field'])) { checked( $options['reales_agents_rating_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_report_field_render') ): 
    function reales_report_field_render() {
        $options = get_option( 'reales_general_settings' );
        ?>
        <input type="checkbox" name="reales_general_settings[reales_report_field]" <?php if(isset($options['reales_report_field'])) { checked( $options['reales_report_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

?>