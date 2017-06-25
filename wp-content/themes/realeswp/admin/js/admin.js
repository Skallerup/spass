(function($) {
    "use strict";

    var simpleIcons = "icon-user,icon-user-female,icon-users,icon-user-follow,icon-user-following,icon-user-unfollow,icon-trophy,icon-speedometer,icon-social-youtube,icon-social-twitter,icon-social-tumblr,icon-social-facebook,icon-social-dropbox,icon-social-dribbble,icon-shield,icon-screen-tablet,icon-screen-smartphone,icon-screen-desktop,icon-plane,icon-notebook,icon-moustache,icon-mouse,icon-magnet,icon-magic-wand,icon-hourglass,icon-graduation,icon-ghost,icon-game-controller,icon-fire,icon-eyeglasses,icon-envelope-open,icon-envelope-letter,icon-energy,icon-emoticon-smile,icon-disc,icon-cursor-move,icon-crop,icon-credit-card,icon-chemistry,icon-bell,icon-badge,icon-anchor,icon-action-redo,icon-action-undo,icon-bag,icon-basket,icon-basket-loaded,icon-book-open,icon-briefcase,icon-bubbles,icon-calculator,icon-call-end,icon-call-in,icon-call-out,icon-compass,icon-cup,icon-diamond,icon-direction,icon-directions,icon-docs,icon-drawer,icon-drop,icon-earphones,icon-earphones-alt,icon-feed,icon-film,icon-folder-alt,icon-frame,icon-globe,icon-globe-alt,icon-handbag,icon-layers,icon-map,icon-picture,icon-pin,icon-playlist,icon-present,icon-printer,icon-puzzle,icon-speech,icon-vector,icon-wallet,icon-arrow-down,icon-arrow-left,icon-arrow-right,icon-arrow-up,icon-bar-chart,icon-bulb,icon-calendar,icon-control-end,icon-control-forward,icon-control-pause,icon-control-play,icon-control-rewind,icon-control-start,icon-cursor,icon-dislike,icon-equalizer,icon-graph,icon-grid,icon-home,icon-like,icon-list,icon-login,icon-logout,icon-loop,icon-microphone,icon-music-tone,icon-music-tone-alt,icon-note,icon-pencil,icon-pie-chart,icon-question,icon-rocket,icon-share,icon-share-alt,icon-shuffle,icon-size-actual,icon-size-fullscreen,icon-support,icon-tag,icon-trash,icon-umbrella,icon-wrench,icon-ban,icon-bubble,icon-camcorder,icon-camera,icon-check,icon-clock,icon-close,icon-cloud-download,icon-cloud-upload,icon-doc,icon-envelope,icon-eye,icon-flag,icon-folder,icon-heart,icon-info,icon-key,icon-link,icon-lock,icon-lock-open,icon-magnifier,icon-magnifier-add,icon-magnifier-remove,icon-paper-clip,icon-paper-plane,icon-plus,icon-pointer,icon-power,icon-refresh,icon-reload,icon-settings,icon-star,icon-symbol-female,icon-symbol-male,icon-target,icon-volume-1,icon-volume-2,icon-volume-off";
    var faIcons = "fa-adjust,fa-anchor,fa-archive,fa-area-chart,fa-arrows,fa-arrows-h,fa-arrows-v,fa-asterisk,fa-at,fa-automobile,fa-ban,fa-bank,fa-bar-chart,fa-bar-chart-o,fa-barcode,fa-bars,fa-beer,fa-bell,fa-bell-o,fa-bell-slash,fa-bell-slash-o,fa-bicycle,fa-binoculars,fa-birthday-cake,fa-bolt,fa-bomb,fa-book,fa-bookmark,fa-bookmark-o,fa-briefcase,fa-bug,fa-building,fa-building-o,fa-bullhorn,fa-bullseye,fa-bus,fa-cab,fa-calculator,fa-calendar,fa-calendar-o,fa-camera,fa-camera-retro,fa-car,fa-caret-square-o-down,fa-caret-square-o-left,fa-caret-square-o-right,fa-caret-square-o-up,fa-cc,fa-certificate,fa-check,fa-check-circle,fa-check-circle-o,fa-check-square,fa-check-square-o,fa-child,fa-circle,fa-circle-o,fa-circle-o-notch,fa-circle-thin,fa-clock-o,fa-close,fa-cloud,fa-cloud-download,fa-cloud-upload,fa-code,fa-code-fork,fa-coffee,fa-cog,fa-cogs,fa-comment,fa-comment-o,fa-comments,fa-comments-o,fa-compass,fa-copyright,fa-credit-card,fa-crop,fa-crosshairs,fa-cube,fa-cubes,fa-cutlery,fa-dashboard,fa-database,fa-desktop,fa-dot-circle-o,fa-download,fa-edit,fa-ellipsis-h,fa-ellipsis-v,fa-envelope,fa-envelope-o,fa-envelope-square,fa-eraser,fa-exchange,fa-exclamation,fa-exclamation-circle,fa-exclamation-triangle,fa-external-link,fa-external-link-square,fa-eye,fa-eye-slash,fa-eyedropper,fa-fax,fa-female,fa-fighter-jet,fa-file-archive-o,fa-file-audio-o,fa-file-code-o,fa-file-excel-o,fa-file-image-o,fa-file-movie-o,fa-file-pdf-o,fa-file-photo-o,fa-file-picture-o,fa-file-powerpoint-o,fa-file-sound-o,fa-file-video-o,fa-file-word-o,fa-file-zip-o,fa-film,fa-filter,fa-fire,fa-fire-extinguisher,fa-flag,fa-flag-checkered,fa-flag-o,fa-flash,fa-flask,fa-folder,fa-folder-o,fa-folder-open,fa-folder-open-o,fa-frown-o,fa-futbol-o,fa-gamepad,fa-gavel,fa-gear,fa-gears,fa-gift,fa-glass,fa-globe,fa-graduation-cap,fa-group,fa-hdd-o,fa-headphones,fa-heart,fa-heart-o,fa-history,fa-home,fa-image,fa-inbox,fa-info,fa-info-circle,fa-institution,fa-key,fa-keyboard-o,fa-language,fa-laptop,fa-leaf,fa-legal,fa-lemon-o,fa-level-down,fa-level-up,fa-life-bouy,fa-life-buoy,fa-life-ring,fa-life-saver,fa-lightbulb-o,fa-line-chart,fa-location-arrow,fa-lock,fa-magic,fa-magnet,fa-mail-forward,fa-mail-reply,fa-mail-reply-all,fa-male,fa-map-marker,fa-meh-o,fa-microphone,fa-microphone-slash,fa-minus,fa-minus-circle,fa-minus-square,fa-minus-square-o,fa-mobile,fa-mobile-phone,fa-money,fa-moon-o,fa-mortar-board,fa-music,fa-navicon,fa-newspaper-o,fa-paint-brush,fa-paper-plane,fa-paper-plane-o,fa-paw,fa-pencil,fa-pencil-square,fa-pencil-square-o,fa-phone,fa-phone-square,fa-photo,fa-picture-o,fa-pie-chart,fa-plane,fa-plug,fa-plus,fa-plus-circle,fa-plus-square,fa-plus-square-o,fa-power-off,fa-print,fa-puzzle-piece,fa-qrcode,fa-question,fa-question-circle,fa-quote-left,fa-quote-right,fa-random,fa-recycle,fa-refresh,fa-remove,fa-reorder,fa-reply,fa-reply-all,fa-retweet,fa-road,fa-rocket,fa-rss,fa-rss-square,fa-search,fa-search-minus,fa-search-plus,fa-send,fa-send-o,fa-share,fa-share-alt,fa-share-alt-square,fa-share-square,fa-share-square-o,fa-shield,fa-shopping-cart,fa-sign-in,fa-sign-out,fa-signal,fa-sitemap,fa-sliders,fa-smile-o,fa-soccer-ball-o,fa-sort,fa-sort-alpha-asc,fa-sort-alpha-desc,fa-sort-amount-asc,fa-sort-amount-desc,fa-sort-asc,fa-sort-desc,fa-sort-down,fa-sort-numeric-asc,fa-sort-numeric-desc,fa-sort-up,fa-space-shuttle,fa-spinner,fa-spoon,fa-square,fa-square-o,fa-star,fa-star-half,fa-star-half-empty,fa-star-half-full,fa-star-half-o,fa-star-o,fa-suitcase,fa-sun-o,fa-support,fa-tablet,fa-tachometer,fa-tag,fa-tags,fa-tasks,fa-taxi,fa-terminal,fa-thumb-tack,fa-thumbs-down,fa-thumbs-o-down,fa-thumbs-o-up,fa-thumbs-up,fa-ticket,fa-times,fa-times-circle,fa-times-circle-o,fa-tint,fa-toggle-down,fa-toggle-left,fa-toggle-off,fa-toggle-on,fa-toggle-right,fa-toggle-up,fa-trash,fa-trash-o,fa-tree,fa-trophy,fa-truck,fa-tty,fa-umbrella,fa-university,fa-unlock,fa-unlock-alt,fa-unsorted,fa-upload,fa-user,fa-users,fa-video-camera,fa-volume-down,fa-volume-off,fa-volume-up,fa-warning,fa-wheelchair,fa-wifi,fa-wrench,fa-file,fa-file-archive-o,fa-file-audio-o,fa-file-code-o,fa-file-excel-o,fa-file-image-o,fa-file-movie-o,fa-file-o,fa-file-pdf-o,fa-file-photo-o,fa-file-picture-o,fa-file-powerpoint-o,fa-file-sound-o,fa-file-text,fa-file-text-o,fa-file-video-o,fa-file-word-o,fa-file-zip-o,fa-check-square,fa-check-square-o,fa-circle,fa-circle-o,fa-dot-circle-o,fa-minus-square,fa-minus-square-o,fa-plus-square,fa-plus-square-o,fa-square,fa-square-o,fa-cc-amex,fa-cc-discover,fa-cc-mastercard,fa-cc-paypal,fa-cc-stripe,fa-cc-visa,fa-credit-card,fa-google-wallet,fa-paypal,fa-area-chart,fa-bar-chart,fa-bar-chart-o,fa-line-chart,fa-pie-chart,fa-bitcoin,fa-btc,fa-cny,fa-dollar,fa-eur,fa-euro,fa-gbp,fa-ils,fa-inr,fa-jpy,fa-krw,fa-money,fa-rmb,fa-rouble,fa-rub,fa-ruble,fa-rupee,fa-shekel,fa-sheqel,fa-try,fa-turkish-lira,fa-usd,fa-won,fa-yen,fa-align-center,fa-align-justify,fa-align-left,fa-align-right,fa-bold,fa-chain,fa-chain-broken,fa-clipboard,fa-columns,fa-copy,fa-cut,fa-dedent,fa-eraser,fa-file,fa-file-o,fa-file-text,fa-file-text-o,fa-files-o,fa-floppy-o,fa-font,fa-header,fa-indent,fa-italic,fa-link,fa-list,fa-list-alt,fa-list-ol,fa-list-ul,fa-outdent,fa-paperclip,fa-paragraph,fa-paste,fa-repeat,fa-rotate-left,fa-rotate-right,fa-save,fa-scissors,fa-strikethrough,fa-subscript,fa-superscript,fa-table,fa-text-height,fa-text-width,fa-th,fa-th-large,fa-th-list,fa-underline,fa-undo,fa-unlink,fa-angle-double-down,fa-angle-double-left,fa-angle-double-right,fa-angle-double-up,fa-angle-down,fa-angle-left,fa-angle-right,fa-angle-up,fa-arrow-circle-down,fa-arrow-circle-left,fa-arrow-circle-o-down,fa-arrow-circle-o-left,fa-arrow-circle-o-right,fa-arrow-circle-o-up,fa-arrow-circle-right,fa-arrow-circle-up,fa-arrow-down,fa-arrow-left,fa-arrow-right,fa-arrow-up,fa-arrows,fa-arrows-alt,fa-arrows-h,fa-arrows-v,fa-caret-down,fa-caret-left,fa-caret-right,fa-caret-square-o-down,fa-caret-square-o-left,fa-caret-square-o-right,fa-caret-square-o-up,fa-caret-up,fa-chevron-circle-down,fa-chevron-circle-left,fa-chevron-circle-right,fa-chevron-circle-up,fa-chevron-down,fa-chevron-left,fa-chevron-right,fa-chevron-up,fa-hand-o-down,fa-hand-o-left,fa-hand-o-right,fa-hand-o-up,fa-long-arrow-down,fa-long-arrow-left,fa-long-arrow-right,fa-long-arrow-up,fa-toggle-down,fa-toggle-left,fa-toggle-right,fa-toggle-up,fa-arrows-alt,fa-backward,fa-compress,fa-eject,fa-expand,fa-fast-backward,fa-fast-forward,fa-forward,fa-pause,fa-play,fa-play-circle,fa-play-circle-o,fa-step-backward,fa-step-forward,fa-stop,fa-youtube-play,fa-adn,fa-android,fa-angellist,fa-apple,fa-behance,fa-behance-square,fa-bitbucket,fa-bitbucket-square,fa-bitcoin,fa-btc,fa-cc-amex,fa-cc-discover,fa-cc-mastercard,fa-cc-paypal,fa-cc-stripe,fa-cc-visa,fa-codepen,fa-css3,fa-delicious,fa-deviantart,fa-digg,fa-dribbble,fa-dropbox,fa-drupal,fa-empire,fa-facebook,fa-facebook-square,fa-flickr,fa-foursquare,fa-ge,fa-git,fa-git-square,fa-github,fa-github-alt,fa-github-square,fa-gittip,fa-google,fa-google-plus,fa-google-plus-square,fa-google-wallet,fa-hacker-news,fa-html5,fa-instagram,fa-ioxhost,fa-joomla,fa-jsfiddle,fa-lastfm,fa-lastfm-square,fa-linkedin,fa-linkedin-square,fa-linux,fa-maxcdn,fa-meanpath,fa-openid,fa-pagelines,fa-paypal,fa-pied-piper,fa-pied-piper-alt,fa-pinterest,fa-pinterest-square,fa-qq,fa-ra,fa-rebel,fa-reddit,fa-reddit-square,fa-renren,fa-share-alt,fa-share-alt-square,fa-skype,fa-slack,fa-slideshare,fa-soundcloud,fa-spotify,fa-stack-exchange,fa-stack-overflow,fa-steam,fa-steam-square,fa-stumbleupon,fa-stumbleupon-circle,fa-tencent-weibo,fa-trello,fa-tumblr,fa-tumblr-square,fa-twitch,fa-twitter,fa-twitter-square,fa-vimeo-square,fa-vine,fa-vk,fa-wechat,fa-weibo,fa-weixin,fa-windows,fa-wordpress,fa-xing,fa-xing-square,fa-yahoo,fa-yelp,fa-youtube,fa-youtube-play,fa-youtube-square,fa-ambulance,fa-h-square,fa-hospital-o,fa-medkit,fa-plus-square,fa-stethoscope,fa-user-md,fa-wheelchair";
    var simpleIconsArray = simpleIcons.split(',');
    var faIconsArray = faIcons.split(',');
    var amenities_icons = [];
    for (var i = 0; i < simpleIconsArray.length; i++) {
        amenities_icons.push(simpleIconsArray[i]);
    }
    for (var i = 0; i < faIconsArray.length; i++) {
        amenities_icons.push('fa ' + faIconsArray[i]);
    }

    // Upload logo
    $('#logoImageBtn').click(function() {
        event.preventDefault();

        var frame = wp.media({
            title: 'Logo Image',
            button: {
                text: 'Insert Image'
            },
            multiple: false
        });

        frame.on( 'select', function() {
            var attachment = frame.state().get('selection').toJSON();
            $.each(attachment, function(index, value) {
                $('#logoImage').val(value.url);
            });
        });

        frame.open();
    });

    // Upload app logo
    $('#appLogoImageBtn').click(function() {
        event.preventDefault();

        var frame = wp.media({
            title: 'Logo Image',
            button: {
                text: 'Insert Image'
            },
            multiple: false
        });

        frame.on( 'select', function() {
            var attachment = frame.state().get('selection').toJSON();
            $.each(attachment, function(index, value) {
                $('#appLogoImage').val(value.url);
            });
        });

        frame.open();
    });

    // Upload favicon
    $('#faviconImageBtn').click(function() {
        event.preventDefault();

        var frame = wp.media({
            title: 'Logo Image',
            button: {
                text: 'Insert Image'
            },
            multiple: false
        });

        frame.on( 'select', function() {
            var attachment = frame.state().get('selection').toJSON();
            $.each(attachment, function(index, value) {
                $('#faviconImage').val(value.url);
            });
        });

        frame.open();
    });

    // Upload video
    $('#homeVideoBtn').click(function() {
        event.preventDefault();

        var frame = wp.media({
            title: 'Logo Image',
            button: {
                text: 'Insert Image'
            },
            multiple: false
        });

        frame.on( 'select', function() {
            var attachment = frame.state().get('selection').toJSON();
            $.each(attachment, function(index, value) {
                $('#homeVideo').val(value.url);
            });
        });

        frame.open();
    });

    // Upload video cover image
    $('#homeVideoCoverBtn').click(function() {
        event.preventDefault();

        var frame = wp.media({
            title: 'Video Cover',
            button: {
                text: 'Insert Image'
            },
            multiple: false
        });

        frame.on( 'select', function() {
            var attachment = frame.state().get('selection').toJSON();
            $.each(attachment, function(index, value) {
                $('#homeVideoCover').val(value.url);
            });
        });

        frame.open();
    });

    // Upload page header image
    $('#pageHeaderBtn').click(function() {
        tb_show('', 'media-upload.php?width=800&amp;height=500&amp;type=image&amp;TB_iframe=true');
        $('#TB_ajaxWindowTitle').html('Page Header Image');
        window.send_to_editor = function(html) {
            var imgURL = $('img',html).attr('src');
            $('#page_header').val(imgURL);
            tb_remove();
        }
        return false;
    });

    $(function() {
        $('.color-field').wpColorPicker();
    });

    if($('#customFieldsTable').length > 0) {
        $('.table-field-type').each(function(index, el) {
            if($(this).val() == 'list_field') {
                $(this).next('input').show();
            }
        });
    }

    $("#custom_field_type").change(function() {
        if($(this).val() == 'list_field') {
            $('#custom_list_field_items').show();
            $(this).siblings('.help').show();
        } else {
            $('#custom_list_field_items').val('').hide();
            $(this).siblings('.help').hide();
        }
    });

    $(".table-field-type").each(function(index, el) {
        $(this).change(function() {
            if($(this).val() == 'list_field') {
                $(this).next('input').show();
            } else {
                $(this).next('input').val('').hide();
            }
        });
    });

    $('#add_fields_btn').click(function() {
        var security = $('#securityAddCustomFields').val();
        var _self = $(this);

        _self.attr('disabled', 'disabled');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: settings_vars.ajaxurl,
            data: {
                'action'     : 'reales_add_custom_fields',
                'name'       : $('#custom_field_name').val(),
                'label'      : $('#custom_field_label').val(),
                'type'       : $('#custom_field_type').val(),
                'list'       : $('#custom_list_field_items').val(),
                'mandatory'  : $('#custom_field_mandatory').val(),
                'position'   : $('#custom_field_position').val(),
                'search'     : $('#custom_field_search').val(),
                'comparison' : $('#custom_field_comparison').val(),
                'security'   : security
            },
            success: function(data) {
                if(data.add == true) {
                    document.location.href = 'themes.php?page=admin/settings.php&tab=fields';
                } else {
                    _self.removeAttr('disabled');
                    alert(data.message);
                }
            }
        });
    });

    $(document).on('click', '.delete-field', function() {
        var _self = $(this);
        var field_name = $(this).attr('data-row');
        var security = $('#securityAddCustomFields').val();
        var _self = $(this);

        _self.children('.preloader').show();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: settings_vars.ajaxurl,
            data: {
                'action': 'reales_delete_custom_fields',
                'field_name': field_name,
                'security': security
            },
            success: function(data) {
                if(data.delete == true) {
                    document.location.href = 'themes.php?page=admin/settings.php&tab=fields';
                } else {
                    _self.children('.preloader').hide();
                }
            }
        });
    });

    $('.datePicker').datepicker({
        'format' : 'yyyy-mm-dd'
    });

    $('#add_amenity_btn').click(function() {
        var security = $('#securityAddAmenities').val();
        var _self = $(this);

        _self.attr('disabled', 'disabled');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: settings_vars.ajaxurl,
            data: {
                'action'     : 'reales_add_amenities',
                'name'       : $('#amenity_name').val(),
                'label'      : $('#amenity_label').val(),
                'icon'       : $('#amenity_icon').val(),
                'position'   : $('#amenity_position').val(),
                'security'   : security
            },
            success: function(data) {
                if(data.add == true) {
                    document.location.href = 'themes.php?page=admin/settings.php&tab=amenities';
                } else {
                    _self.removeAttr('disabled');   
                    alert(data.message);
                }
            }
        });
    });

    $(document).on('click', '.delete-amenity', function() {
        var _self = $(this);
        var amenity_name = $(this).attr('data-row');
        var security = $('#securityAddAmenities').val();
        var _self = $(this);

        _self.children('.preloader').show();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: settings_vars.ajaxurl,
            data: {
                'action': 'reales_delete_amenities',
                'amenity_name': amenity_name,
                'security': security
            },
            success: function(data) {
                if(data.delete == true) {
                    document.location.href = 'themes.php?page=admin/settings.php&tab=amenities';
                } else {
                    _self.children('.preloader').hide();
                }
            }
        });
    });

    $('.dropdown a').click(function(event) {
        var _parent = $(this).parent();
        if(_parent.hasClass('open')) {
            $(this).parent().removeClass('open');
        } else {
            $(this).parent().addClass('open');
        }
    });
    $('.dropdown-backdrop').click(function(event) {
        var _prev = $(this).prev();
        _prev.removeClass('open');
    });
    for(var i = 0; i < amenities_icons.length; i++) {
        var iconsMenuItem = '<li><a href="#"><span class="' + amenities_icons[i] + '"></span> ' + amenities_icons[i] + '</a></li>';
        $('.iconsMenu').each(function(index, el) {
            $(this).append(iconsMenuItem);
        });
    }
    $('.iconsMenu a').click(function(event) {
        var icon = $(this).text();

        $(this).parent().parent().prev('.button').html('<span class="' + icon + '"></span> ' + icon + '&nbsp;&nbsp;&nbsp;<span class="fa fa-caret-down"></span>');
        $(this).parent().parent().next('input').val(icon);
        $(this).parent().parent().parent().removeClass('open');
    });
    $('.iconsField').each(function(index, el) {
        var fieldValue = $(this).val();
        if(fieldValue != '') {
            $(this).prev().prev('.button').html('<span class="' + fieldValue + '"></span> ' + fieldValue + '&nbsp;&nbsp;&nbsp;<span class="fa fa-caret-down"></span>');
        }
    });

    $('#add_city_btn').click(function() {
        var security = $('#securityAddCities').val();
        var _self = $(this);

        _self.attr('disabled', 'disabled');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: settings_vars.ajaxurl,
            data: {
                'action'   : 'reales_add_cities',
                'id'       : $('#city_id').val(),
                'name'     : $('#city_name').val(),
                'position' : $('#city_position').val(),
                'security' : security
            },
            success: function(data) {
                if(data.add == true) {
                    document.location.href = 'themes.php?page=admin/settings.php&tab=cities';
                } else {
                    _self.removeAttr('disabled');
                    alert(data.message);
                }
            }
        });
    });

    $(document).on('click', '.delete-city', function() {
        var _self = $(this);
        var city_id = $(this).attr('data-row');
        var security = $('#securityAddCities').val();

        _self.children('.preloader').show();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: settings_vars.ajaxurl,
            data: {
                'action'   : 'reales_delete_cities',
                'city_id'  : city_id,
                'security' : security
            },
            success: function(data) {
                if(data.delete == true) {
                    document.location.href = 'themes.php?page=admin/settings.php&tab=cities';
                } else {
                    _self.children('.preloader').hide();
                }
            }
        });
    });

    // Upload slide image
    $('.slide_image_btn').click(function() {
        var _self = $(this);
        event.preventDefault();

        var frame = wp.media({
            title: 'Slide Image',
            button: {
                text: 'Insert Image'
            },
            multiple: false
        });

        frame.on( 'select', function() {
            var attachment = frame.state().get('selection').toJSON();
            $.each(attachment, function(index, value) {
                _self.prev().val(value.url);
            });
        });

        frame.open();
    });

    $('#add_slide_btn').click(function() {
        var security = $('#securitySlider').val();
        var _self = $(this);

        _self.attr('disabled', 'disabled');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: settings_vars.ajaxurl,
            data: {
                'action'   : 'reales_add_slide',
                'id'       : $('#slide_id').val(),
                'image'    : $('#slide_image').val(),
                'title'    : $('#slide_title').val(),
                'subtitle' : $('#slide_subtitle').val(),
                'cta_text' : $('#slide_cta_text').val(),
                'cta_link' : $('#slide_cta_link').val(),
                'position' : $('#slide_position').val(),
                'security' : security
            },
            success: function(data) {
                if(data.add == true) {
                    document.location.href = 'themes.php?page=admin/settings.php&tab=slider';
                } else {
                    _self.removeAttr('disabled');   
                    alert(data.message);
                }
            }
        });
    });

    $(document).on('click', '.delete-slide', function() {
        var _self = $(this);
        var id = $(this).attr('data-row');
        var security = $('#securitySlider').val();

        _self.children('.preloader').show();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: settings_vars.ajaxurl,
            data: {
                'action'   : 'reales_delete_slide',
                'id'       : id,
                'security' : security
            },
            success: function(data) {
                if(data.delete == true) {
                    document.location.href = 'themes.php?page=admin/settings.php&tab=slider';
                } else {
                    _self.children('.preloader').hide();
                }
            }
        });
    });

})(jQuery);