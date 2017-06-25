// icons
var simpleIcons = "icon-user,icon-user-female,icon-users,icon-user-follow,icon-user-following,icon-user-unfollow,icon-trophy,icon-speedometer,icon-social-youtube,icon-social-twitter,icon-social-tumblr,icon-social-facebook,icon-social-dropbox,icon-social-dribbble,icon-shield,icon-screen-tablet,icon-screen-smartphone,icon-screen-desktop,icon-plane,icon-notebook,icon-moustache,icon-mouse,icon-magnet,icon-magic-wand,icon-hourglass,icon-graduation,icon-ghost,icon-game-controller,icon-fire,icon-eyeglasses,icon-envelope-open,icon-envelope-letter,icon-energy,icon-emoticon-smile,icon-disc,icon-cursor-move,icon-crop,icon-credit-card,icon-chemistry,icon-bell,icon-badge,icon-anchor,icon-action-redo,icon-action-undo,icon-bag,icon-basket,icon-basket-loaded,icon-book-open,icon-briefcase,icon-bubbles,icon-calculator,icon-call-end,icon-call-in,icon-call-out,icon-compass,icon-cup,icon-diamond,icon-direction,icon-directions,icon-docs,icon-drawer,icon-drop,icon-earphones,icon-earphones-alt,icon-feed,icon-film,icon-folder-alt,icon-frame,icon-globe,icon-globe-alt,icon-handbag,icon-layers,icon-map,icon-picture,icon-pin,icon-playlist,icon-present,icon-printer,icon-puzzle,icon-speech,icon-vector,icon-wallet,icon-arrow-down,icon-arrow-left,icon-arrow-right,icon-arrow-up,icon-bar-chart,icon-bulb,icon-calendar,icon-control-end,icon-control-forward,icon-control-pause,icon-control-play,icon-control-rewind,icon-control-start,icon-cursor,icon-dislike,icon-equalizer,icon-graph,icon-grid,icon-home,icon-like,icon-list,icon-login,icon-logout,icon-loop,icon-microphone,icon-music-tone,icon-music-tone-alt,icon-note,icon-pencil,icon-pie-chart,icon-question,icon-rocket,icon-share,icon-share-alt,icon-shuffle,icon-size-actual,icon-size-fullscreen,icon-support,icon-tag,icon-trash,icon-umbrella,icon-wrench,icon-ban,icon-bubble,icon-camcorder,icon-camera,icon-check,icon-clock,icon-close,icon-cloud-download,icon-cloud-upload,icon-doc,icon-envelope,icon-eye,icon-flag,icon-folder,icon-heart,icon-info,icon-key,icon-link,icon-lock,icon-lock-open,icon-magnifier,icon-magnifier-add,icon-magnifier-remove,icon-paper-clip,icon-paper-plane,icon-plus,icon-pointer,icon-power,icon-refresh,icon-reload,icon-settings,icon-star,icon-symbol-female,icon-symbol-male,icon-target,icon-volume-1,icon-volume-2,icon-volume-off";
var faIcons = "fa-adjust,fa-anchor,fa-archive,fa-area-chart,fa-arrows,fa-arrows-h,fa-arrows-v,fa-asterisk,fa-at,fa-automobile,fa-ban,fa-bank,fa-bar-chart,fa-bar-chart-o,fa-barcode,fa-bars,fa-beer,fa-bell,fa-bell-o,fa-bell-slash,fa-bell-slash-o,fa-bicycle,fa-binoculars,fa-birthday-cake,fa-bolt,fa-bomb,fa-book,fa-bookmark,fa-bookmark-o,fa-briefcase,fa-bug,fa-building,fa-building-o,fa-bullhorn,fa-bullseye,fa-bus,fa-cab,fa-calculator,fa-calendar,fa-calendar-o,fa-camera,fa-camera-retro,fa-car,fa-caret-square-o-down,fa-caret-square-o-left,fa-caret-square-o-right,fa-caret-square-o-up,fa-cc,fa-certificate,fa-check,fa-check-circle,fa-check-circle-o,fa-check-square,fa-check-square-o,fa-child,fa-circle,fa-circle-o,fa-circle-o-notch,fa-circle-thin,fa-clock-o,fa-close,fa-cloud,fa-cloud-download,fa-cloud-upload,fa-code,fa-code-fork,fa-coffee,fa-cog,fa-cogs,fa-comment,fa-comment-o,fa-comments,fa-comments-o,fa-compass,fa-copyright,fa-credit-card,fa-crop,fa-crosshairs,fa-cube,fa-cubes,fa-cutlery,fa-dashboard,fa-database,fa-desktop,fa-dot-circle-o,fa-download,fa-edit,fa-ellipsis-h,fa-ellipsis-v,fa-envelope,fa-envelope-o,fa-envelope-square,fa-eraser,fa-exchange,fa-exclamation,fa-exclamation-circle,fa-exclamation-triangle,fa-external-link,fa-external-link-square,fa-eye,fa-eye-slash,fa-eyedropper,fa-fax,fa-female,fa-fighter-jet,fa-file-archive-o,fa-file-audio-o,fa-file-code-o,fa-file-excel-o,fa-file-image-o,fa-file-movie-o,fa-file-pdf-o,fa-file-photo-o,fa-file-picture-o,fa-file-powerpoint-o,fa-file-sound-o,fa-file-video-o,fa-file-word-o,fa-file-zip-o,fa-film,fa-filter,fa-fire,fa-fire-extinguisher,fa-flag,fa-flag-checkered,fa-flag-o,fa-flash,fa-flask,fa-folder,fa-folder-o,fa-folder-open,fa-folder-open-o,fa-frown-o,fa-futbol-o,fa-gamepad,fa-gavel,fa-gear,fa-gears,fa-gift,fa-glass,fa-globe,fa-graduation-cap,fa-group,fa-hdd-o,fa-headphones,fa-heart,fa-heart-o,fa-history,fa-home,fa-image,fa-inbox,fa-info,fa-info-circle,fa-institution,fa-key,fa-keyboard-o,fa-language,fa-laptop,fa-leaf,fa-legal,fa-lemon-o,fa-level-down,fa-level-up,fa-life-bouy,fa-life-buoy,fa-life-ring,fa-life-saver,fa-lightbulb-o,fa-line-chart,fa-location-arrow,fa-lock,fa-magic,fa-magnet,fa-mail-forward,fa-mail-reply,fa-mail-reply-all,fa-male,fa-map-marker,fa-meh-o,fa-microphone,fa-microphone-slash,fa-minus,fa-minus-circle,fa-minus-square,fa-minus-square-o,fa-mobile,fa-mobile-phone,fa-money,fa-moon-o,fa-mortar-board,fa-music,fa-navicon,fa-newspaper-o,fa-paint-brush,fa-paper-plane,fa-paper-plane-o,fa-paw,fa-pencil,fa-pencil-square,fa-pencil-square-o,fa-phone,fa-phone-square,fa-photo,fa-picture-o,fa-pie-chart,fa-plane,fa-plug,fa-plus,fa-plus-circle,fa-plus-square,fa-plus-square-o,fa-power-off,fa-print,fa-puzzle-piece,fa-qrcode,fa-question,fa-question-circle,fa-quote-left,fa-quote-right,fa-random,fa-recycle,fa-refresh,fa-remove,fa-reorder,fa-reply,fa-reply-all,fa-retweet,fa-road,fa-rocket,fa-rss,fa-rss-square,fa-search,fa-search-minus,fa-search-plus,fa-send,fa-send-o,fa-share,fa-share-alt,fa-share-alt-square,fa-share-square,fa-share-square-o,fa-shield,fa-shopping-cart,fa-sign-in,fa-sign-out,fa-signal,fa-sitemap,fa-sliders,fa-smile-o,fa-soccer-ball-o,fa-sort,fa-sort-alpha-asc,fa-sort-alpha-desc,fa-sort-amount-asc,fa-sort-amount-desc,fa-sort-asc,fa-sort-desc,fa-sort-down,fa-sort-numeric-asc,fa-sort-numeric-desc,fa-sort-up,fa-space-shuttle,fa-spinner,fa-spoon,fa-square,fa-square-o,fa-star,fa-star-half,fa-star-half-empty,fa-star-half-full,fa-star-half-o,fa-star-o,fa-suitcase,fa-sun-o,fa-support,fa-tablet,fa-tachometer,fa-tag,fa-tags,fa-tasks,fa-taxi,fa-terminal,fa-thumb-tack,fa-thumbs-down,fa-thumbs-o-down,fa-thumbs-o-up,fa-thumbs-up,fa-ticket,fa-times,fa-times-circle,fa-times-circle-o,fa-tint,fa-toggle-down,fa-toggle-left,fa-toggle-off,fa-toggle-on,fa-toggle-right,fa-toggle-up,fa-trash,fa-trash-o,fa-tree,fa-trophy,fa-truck,fa-tty,fa-umbrella,fa-university,fa-unlock,fa-unlock-alt,fa-unsorted,fa-upload,fa-user,fa-users,fa-video-camera,fa-volume-down,fa-volume-off,fa-volume-up,fa-warning,fa-wheelchair,fa-wifi,fa-wrench,fa-file,fa-file-archive-o,fa-file-audio-o,fa-file-code-o,fa-file-excel-o,fa-file-image-o,fa-file-movie-o,fa-file-o,fa-file-pdf-o,fa-file-photo-o,fa-file-picture-o,fa-file-powerpoint-o,fa-file-sound-o,fa-file-text,fa-file-text-o,fa-file-video-o,fa-file-word-o,fa-file-zip-o,fa-check-square,fa-check-square-o,fa-circle,fa-circle-o,fa-dot-circle-o,fa-minus-square,fa-minus-square-o,fa-plus-square,fa-plus-square-o,fa-square,fa-square-o,fa-cc-amex,fa-cc-discover,fa-cc-mastercard,fa-cc-paypal,fa-cc-stripe,fa-cc-visa,fa-credit-card,fa-google-wallet,fa-paypal,fa-area-chart,fa-bar-chart,fa-bar-chart-o,fa-line-chart,fa-pie-chart,fa-bitcoin,fa-btc,fa-cny,fa-dollar,fa-eur,fa-euro,fa-gbp,fa-ils,fa-inr,fa-jpy,fa-krw,fa-money,fa-rmb,fa-rouble,fa-rub,fa-ruble,fa-rupee,fa-shekel,fa-sheqel,fa-try,fa-turkish-lira,fa-usd,fa-won,fa-yen,fa-align-center,fa-align-justify,fa-align-left,fa-align-right,fa-bold,fa-chain,fa-chain-broken,fa-clipboard,fa-columns,fa-copy,fa-cut,fa-dedent,fa-eraser,fa-file,fa-file-o,fa-file-text,fa-file-text-o,fa-files-o,fa-floppy-o,fa-font,fa-header,fa-indent,fa-italic,fa-link,fa-list,fa-list-alt,fa-list-ol,fa-list-ul,fa-outdent,fa-paperclip,fa-paragraph,fa-paste,fa-repeat,fa-rotate-left,fa-rotate-right,fa-save,fa-scissors,fa-strikethrough,fa-subscript,fa-superscript,fa-table,fa-text-height,fa-text-width,fa-th,fa-th-large,fa-th-list,fa-underline,fa-undo,fa-unlink,fa-angle-double-down,fa-angle-double-left,fa-angle-double-right,fa-angle-double-up,fa-angle-down,fa-angle-left,fa-angle-right,fa-angle-up,fa-arrow-circle-down,fa-arrow-circle-left,fa-arrow-circle-o-down,fa-arrow-circle-o-left,fa-arrow-circle-o-right,fa-arrow-circle-o-up,fa-arrow-circle-right,fa-arrow-circle-up,fa-arrow-down,fa-arrow-left,fa-arrow-right,fa-arrow-up,fa-arrows,fa-arrows-alt,fa-arrows-h,fa-arrows-v,fa-caret-down,fa-caret-left,fa-caret-right,fa-caret-square-o-down,fa-caret-square-o-left,fa-caret-square-o-right,fa-caret-square-o-up,fa-caret-up,fa-chevron-circle-down,fa-chevron-circle-left,fa-chevron-circle-right,fa-chevron-circle-up,fa-chevron-down,fa-chevron-left,fa-chevron-right,fa-chevron-up,fa-hand-o-down,fa-hand-o-left,fa-hand-o-right,fa-hand-o-up,fa-long-arrow-down,fa-long-arrow-left,fa-long-arrow-right,fa-long-arrow-up,fa-toggle-down,fa-toggle-left,fa-toggle-right,fa-toggle-up,fa-arrows-alt,fa-backward,fa-compress,fa-eject,fa-expand,fa-fast-backward,fa-fast-forward,fa-forward,fa-pause,fa-play,fa-play-circle,fa-play-circle-o,fa-step-backward,fa-step-forward,fa-stop,fa-youtube-play,fa-adn,fa-android,fa-angellist,fa-apple,fa-behance,fa-behance-square,fa-bitbucket,fa-bitbucket-square,fa-bitcoin,fa-btc,fa-cc-amex,fa-cc-discover,fa-cc-mastercard,fa-cc-paypal,fa-cc-stripe,fa-cc-visa,fa-codepen,fa-css3,fa-delicious,fa-deviantart,fa-digg,fa-dribbble,fa-dropbox,fa-drupal,fa-empire,fa-facebook,fa-facebook-square,fa-flickr,fa-foursquare,fa-ge,fa-git,fa-git-square,fa-github,fa-github-alt,fa-github-square,fa-gittip,fa-google,fa-google-plus,fa-google-plus-square,fa-google-wallet,fa-hacker-news,fa-html5,fa-instagram,fa-ioxhost,fa-joomla,fa-jsfiddle,fa-lastfm,fa-lastfm-square,fa-linkedin,fa-linkedin-square,fa-linux,fa-maxcdn,fa-meanpath,fa-openid,fa-pagelines,fa-paypal,fa-pied-piper,fa-pied-piper-alt,fa-pinterest,fa-pinterest-square,fa-qq,fa-ra,fa-rebel,fa-reddit,fa-reddit-square,fa-renren,fa-share-alt,fa-share-alt-square,fa-skype,fa-slack,fa-slideshare,fa-soundcloud,fa-spotify,fa-stack-exchange,fa-stack-overflow,fa-steam,fa-steam-square,fa-stumbleupon,fa-stumbleupon-circle,fa-tencent-weibo,fa-trello,fa-tumblr,fa-tumblr-square,fa-twitch,fa-twitter,fa-twitter-square,fa-vimeo-square,fa-vine,fa-vk,fa-wechat,fa-weibo,fa-weixin,fa-windows,fa-wordpress,fa-xing,fa-xing-square,fa-yahoo,fa-yelp,fa-youtube,fa-youtube-play,fa-youtube-square,fa-ambulance,fa-h-square,fa-hospital-o,fa-medkit,fa-plus-square,fa-stethoscope,fa-user-md,fa-wheelchair";
var simpleIconsArray = simpleIcons.split(',');
var faIconsArray = faIcons.split(',');
var shortcode_icons = [];
for (var i = 0; i < simpleIconsArray.length; i++) {
    var obj = {text: simpleIconsArray[i], value: simpleIconsArray[i], icon: 'sli ' + simpleIconsArray[i]};
    shortcode_icons.push(obj);
}
for (var i = 0; i < faIconsArray.length; i++) {
    var obj = {text: faIconsArray[i], value: 'fa ' + faIconsArray[i], icon: 'fa fa ' + faIconsArray[i]};
    shortcode_icons.push(obj);
}

var propsAjaxURL = my_plugin.admin_url + 'admin-ajax.php';
var categories = new Array({ text : 'All', value : '0' });
var types = new Array({ text : 'All', value : '0' });
jQuery.ajax({
    type: 'POST',
    dataType: 'json',
    url: propsAjaxURL,
    data: {
        'action': 'reales_get_cts'
    },
    success: function(data) {
        if(data.getcts === true) {
            for(var i = 0; i < data.categories.length; i++) {
                categories.push({ text : data.categories[i].name, value : data.categories[i].term_id });
            }
            for(var i = 0; i < data.types.length; i++) {
                types.push({ text : data.types[i].name, value : data.types[i].term_id });
            }
        }
    },
    error: function(errorThrown) {

    }
});

/**
 * Create services custom shortcode button
 */
(function() {
    tinymce.create('tinymce.plugins.services', {
        init: function(editor, url) {
            editor.addButton('services', {
                title: 'Services',
                image: url + '/tinymce-icons/services-icon.png',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Insert Services Shortcode',
                        width: 600,
                        height: 400,
                        body: [
                            {
                                type: 'textbox',
                                name: 'servicesTitle',
                                label: 'Services Title',
                                value: 'Services title here'
                            },
                            {
                                type: 'listbox',
                                name: 'show',
                                label: 'Services Number',
                                'values': [
                                    { text : '2', value : '2' },
                                    { text : '3', value : '3' },
                                    { text : '4', value : '4' }
                                ]
                            },
                            {
                                type: 'listbox',
                                name: 'firstServiceIcon',
                                label: '1st service Icon',
                                'values': shortcode_icons
                            },
                            {
                                type: 'textbox',
                                name: 'firstServiceTitle',
                                label: '1st Service Title',
                                value: '1st service title here'
                            },
                            {
                                type: 'textbox',
                                name: 'firstServiceText',
                                label: '1st Service Text',
                                value: '1st service text here'
                            },
                            {
                                type: 'textbox',
                                name: 'firstServiceLink',
                                label: '1st Service Link',
                                value: 'http://'
                            },
                            {
                                type: 'listbox',
                                name: 'secondServiceIcon',
                                label: '2nd service Icon',
                                'values': shortcode_icons
                            },
                            {
                                type: 'textbox',
                                name: 'secondServiceTitle',
                                label: '2nd Service Title',
                                value: '2nd service title here'
                            },
                            {
                                type: 'textbox',
                                name: 'secondServiceText',
                                label: '2nd Service Text',
                                value: '2nd service text here'
                            },
                            {
                                type: 'textbox',
                                name: 'secondServiceLink',
                                label: '2nd Service Link',
                                value: 'http://'
                            },
                            {
                                type: 'listbox',
                                name: 'thirdServiceIcon',
                                label: '3rd service Icon',
                                'values': shortcode_icons
                            },
                            {
                                type: 'textbox',
                                name: 'thirdServiceTitle',
                                label: '3rd Service Title',
                                value: '3rd service title here'
                            },
                            {
                                type: 'textbox',
                                name: 'thirdServiceText',
                                label: '3rd Service Text',
                                value: '3rd service text here'
                            },
                            {
                                type: 'textbox',
                                name: 'thirdServiceLink',
                                label: '3rd Service Link',
                                value: 'http://'
                            },
                            {
                                type: 'listbox',
                                name: 'fourthServiceIcon',
                                label: '4th service Icon',
                                'values': shortcode_icons
                            },
                            {
                                type: 'textbox',
                                name: 'fourthServiceTitle',
                                label: '4th Service Title',
                                value: '4th service title here'
                            },
                            {
                                type: 'textbox',
                                name: 'fourthServiceText',
                                label: '4th Service Text',
                                value: '4th service text here'
                            },
                            {
                                type: 'textbox',
                                name: 'fourthServiceLink',
                                label: '4th Service Link',
                                value: 'http://'
                            }
                        ],
                        onsubmit: function(e) {
                            editor.insertContent('[services stitle="' + e.data.servicesTitle + 
                                '" show="' + e.data.show + 
                                '" s1icon="' + e.data.firstServiceIcon + 
                                '" s1title="' + e.data.firstServiceTitle + 
                                '" s1text="' + e.data.firstServiceText + 
                                '" s1link="' + e.data.firstServiceLink + 
                                '" s2icon="' + e.data.secondServiceIcon + 
                                '" s2title="' + e.data.secondServiceTitle + 
                                '" s2text="' + e.data.secondServiceText + 
                                '" s2link="' + e.data.secondServiceLink + 
                                '" s3icon="' + e.data.thirdServiceIcon + 
                                '" s3title="' + e.data.thirdServiceTitle + 
                                '" s3text="' + e.data.thirdServiceText + 
                                '" s3link="' + e.data.thirdServiceLink + 
                                '" s4icon="' + e.data.fourthServiceIcon + 
                                '" s4title="' + e.data.fourthServiceTitle + 
                                '" s4text="' + e.data.fourthServiceText + 
                                '" s4link="' + e.data.fourthServiceLink + '"]');
                        }
                    });
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('services', tinymce.plugins.services);
})();

/**
 * Create recent properties custom shortcode button
 */
(function() {
    tinymce.create('tinymce.plugins.recent_properties', {
        init: function(editor, url) {
            editor.addButton('recent_properties', {
                title: 'Recent Properties',
                image: url + '/tinymce-icons/recent-properties-icon.png',
                onclick: function() {
                    editor.windowManager.open({
                        title: 'Insert Recent Properties Shortcode',
                        width: 600,
                        height: 220,
                        scrollbars: true,
                        autoScroll: true,
                        body: [
                            {
                                type: 'textbox',
                                name: 'title',
                                label: 'Title',
                                value: 'Recently Listed Properties'
                            },
                            {
                                type: 'textbox',
                                name: 'show',
                                label: 'Number of properties',
                                value: '6'
                            },
                            {
                                type: 'listbox',
                                name: 'category',
                                label: 'Category',
                                'values': categories
                            },
                            {
                                type: 'listbox',
                                name: 'type',
                                label: 'Type',
                                'values': types
                            }
                        ],
                        onsubmit: function(e) {
                            editor.insertContent('[recent_properties title="' + e.data.title + '" show="' + e.data.show + '" category="' + e.data.category + '" type="' + e.data.type + '"]');
                        }
                    });
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('recent_properties', tinymce.plugins.recent_properties);
})();

/**
 * Create featured properties custom shortcode button
 */
(function() {
    tinymce.create('tinymce.plugins.featured_properties', {
        init: function(editor, url) {
            editor.addButton('featured_properties', {
                title: 'Featured Properties',
                image: url + '/tinymce-icons/featured-properties-icon.png',
                onclick: function() {
                    editor.windowManager.open({
                        title: 'Insert Featured Properties Shortcode',
                        width: 600,
                        height: 220,
                        scrollbars: true,
                        autoScroll: true,
                        body: [
                            {
                                type: 'textbox',
                                name: 'title',
                                label: 'Title',
                                value: 'Featured Listed Properties'
                            },
                            {
                                type: 'textbox',
                                name: 'show',
                                label: 'Number of properties',
                                value: '3'
                            },
                            {
                                type: 'listbox',
                                name: 'category',
                                label: 'Category',
                                'values': categories
                            },
                            {
                                type: 'listbox',
                                name: 'type',
                                label: 'Type',
                                'values': types
                            }
                        ],
                        onsubmit: function(e) {
                            editor.insertContent('[featured_properties title="' + e.data.title + '" show="' + e.data.show + '" category="' + e.data.category + '" type="' + e.data.type + '"]');
                        }
                    });
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('featured_properties', tinymce.plugins.featured_properties);
})();

/**
 * Create single property custom shortcode button
 */
(function() {
    tinymce.create('tinymce.plugins.single_property', {
        init: function(editor, url) {
            editor.addButton('single_property', {
                title: 'Single Property',
                image: url + '/tinymce-icons/single-property-icon.png',
                onclick: function() {
                    editor.windowManager.open({
                        title: 'Insert Single Property Shortcode',
                        width: 600,
                        height: 160,
                        scrollbars: true,
                        autoScroll: true,
                        body: [
                            {
                                type: 'textbox',
                                name: 'title',
                                label: 'Title',
                                value: 'Single Property'
                            },
                            {
                                type: 'textbox',
                                name: 'id',
                                label: 'Property ID',
                                value: ''
                            },
                            {
                                type: 'listbox',
                                name: 'position',
                                label: 'Image Position',
                                'values': [
                                    {text: 'Right', value: 'right'},
                                    {text: 'Left', value: 'left'}
                                ]
                            }
                        ],
                        onsubmit: function(e) {
                            editor.insertContent('[single_property title="' + e.data.title + '" id="' + e.data.id + '" position="' + e.data.position + '"]');
                        }
                    });
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('single_property', tinymce.plugins.single_property);
})();

/**
 * Create featured agents custom shortcode button
 */
(function() {
    tinymce.create('tinymce.plugins.featured_agents', {
        init: function(editor, url) {
            editor.addButton('featured_agents', {
                title: 'Featured Agents',
                image: url + '/tinymce-icons/featured-agents-icon.png',
                onclick: function() {
                    editor.windowManager.open({
                        title: 'Insert Featured Agents Shortcode',
                        width: 600,
                        height: 120,
                        scrollbars: true,
                        autoScroll: true,
                        body: [
                            {
                                type: 'textbox',
                                name: 'title',
                                label: 'Title',
                                value: 'Our Agents'
                            },
                            {
                                type: 'textbox',
                                name: 'show',
                                label: 'Number of agents',
                                value: '4'
                            }
                        ],
                        onsubmit: function(e) {
                            editor.insertContent('[featured_agents title="' + e.data.title + '" show="' + e.data.show + '"]');
                        }
                    });
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('featured_agents', tinymce.plugins.featured_agents);
})();

/**
 * Create testimonials custom shortcode button
 */
(function() {
    tinymce.create('tinymce.plugins.testimonials', {
        init: function(editor, url) {
            editor.addButton('testimonials', {
                title: 'Testimonials',
                image: url + '/tinymce-icons/testimonials-icon.png',
                onclick: function() {
                    editor.windowManager.open({
                        title: 'Insert Testimonials Shortcode',
                        width: 600,
                        height: 100,
                        scrollbars: true,
                        autoScroll: true,
                        body: [
                            {
                                type: 'textbox',
                                name: 'title',
                                label: 'Title',
                                value: 'Testimonials'
                            }
                        ],
                        onsubmit: function(e) {
                            editor.insertContent('[testimonials title="' + e.data.title + '"]');
                        }
                    });
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('testimonials', tinymce.plugins.testimonials);
})();

/**
 * Create latest blog posts custom shortcode button
 */
(function() {
    tinymce.create('tinymce.plugins.latest_posts', {
        init: function(editor, url) {
            editor.addButton('latest_posts', {
                title: 'Latest Blog Posts',
                image: url + '/tinymce-icons/latest-posts-icon.png',
                onclick: function() {
                    editor.windowManager.open({
                        title: 'Insert Latest Blog Posts Shortcode',
                        width: 600,
                        height: 140,
                        scrollbars: true,
                        autoScroll: true,
                        body: [
                            {
                                type: 'textbox',
                                name: 'title',
                                label: 'Title',
                                value: 'Latest Blog Posts'
                            },
                            {
                                type: 'textbox',
                                name: 'show',
                                label: 'Number of posts',
                                value: '4'
                            }
                        ],
                        onsubmit: function(e) {
                            editor.insertContent('[latest_posts title="' + e.data.title + '" show="' + e.data.show + '"]');
                        }
                    });
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('latest_posts', tinymce.plugins.latest_posts);
})();

/**
 * Create featured blog posts custom shortcode button
 */
(function() {
    tinymce.create('tinymce.plugins.featured_posts', {
        init: function(editor, url) {
            editor.addButton('featured_posts', {
                title: 'Featured Blog Posts',
                image: url + '/tinymce-icons/featured-posts-icon.png',
                onclick: function() {
                    editor.windowManager.open({
                        title: 'Insert Featured Blog Posts Shortcode',
                        width: 600,
                        height: 140,
                        scrollbars: true,
                        autoScroll: true,
                        body: [
                            {
                                type: 'textbox',
                                name: 'title',
                                label: 'Title',
                                value: 'Featured Blog Posts'
                            },
                            {
                                type: 'textbox',
                                name: 'show',
                                label: 'Number of posts',
                                value: '4'
                            }
                        ],
                        onsubmit: function(e) {
                            editor.insertContent('[featured_posts title="' + e.data.title + '" show="' + e.data.show + '"]');
                        }
                    });
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('featured_posts', tinymce.plugins.featured_posts);
})();

/**
 * Create membership plans custom shortcode button
 */
(function() {
    tinymce.create('tinymce.plugins.membership_plans', {
        init: function(editor, url) {
            editor.addButton('membership_plans', {
                title: 'Membership Plans',
                image: url + '/tinymce-icons/membership-plans-icon.png',
                onclick: function() {
                    editor.windowManager.open({
                        title: 'Insert Membership Plans Shortcode',
                        width: 600,
                        height: 100,
                        scrollbars: true,
                        autoScroll: true,
                        body: [
                            {
                                type: 'textbox',
                                name: 'title',
                                label: 'Title',
                                value: 'Membership Plans'
                            }
                        ],
                        onsubmit: function(e) {
                            editor.insertContent('[membership_plans title="' + e.data.title + '"]');
                        }
                    });
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('membership_plans', tinymce.plugins.membership_plans);
})();

/**
 * Create columns custom shortcode button
 */
(function() {
    tinymce.create('tinymce.plugins.column', {
        init: function(editor, url) {
            editor.addButton('column', {
                title: 'Column',
                image: url + '/tinymce-icons/columns-icon.png',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Insert Column',
                        width: 600,
                        height: 100,
                        scrollbars: true,
                        autoScroll: true,
                        body: [
                            {
                                type: 'listbox',
                                name: 'column',
                                label: 'Column Type',
                                'values': [
                                    {text: 'one half', value: 'one_half', icon: 'column one-half'},
                                    {text: 'one half (last)', value: 'one_half_last', icon: 'column one-half-last'},
                                    {text: 'one third', value: 'one_third', icon: 'column one-half', icon: 'column one-third'},
                                    {text: 'one third (last)', value: 'one_third_last', icon: 'column one-half', icon: 'column one-third-last'},
                                    {text: 'one fourth', value: 'one_fourth', icon: 'column one-half', icon: 'column one-fourth'},
                                    {text: 'one fourth (last)', value: 'one_fourth_last', icon: 'column one-half', icon: 'column one-fourth-last'},
                                    {text: 'two third', value: 'two_third', icon: 'column one-half', icon: 'column two-third'},
                                    {text: 'two third (last)', value: 'two_third_last', icon: 'column one-half', icon: 'column two-third-last'},
                                    {text: 'three fourth', value: 'three_fourth', icon: 'column one-half', icon: 'column three-fourth'},
                                    {text: 'three fourth (last)', value: 'three_fourth_last', icon: 'column one-half', icon: 'column three-fourth-last'}
                                ]
                            }
                        ],
                        onsubmit: function(e) {
                            editor.insertContent('[column type="' + e.data.column + '"] [/column]');
                        }
                    });
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('column', tinymce.plugins.column);
})();