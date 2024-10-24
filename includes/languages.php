<?php
/**
 * List of supported languages for Google Translate
 * Ordered by global popularity and usage
 */

function sgt_get_supported_languages() {
    return array(
        'en' => array('name' => 'English', 'flag' => 'gb'),
        'zh-CN' => array('name' => 'Chinese (Simplified)', 'flag' => 'cn'),
        'es' => array('name' => 'Spanish', 'flag' => 'es'),
        'hi' => array('name' => 'Hindi', 'flag' => 'in'),
        'ar' => array('name' => 'Arabic', 'flag' => 'sa'),
        'bn' => array('name' => 'Bengali', 'flag' => 'bd'),
        'pt' => array('name' => 'Portuguese', 'flag' => 'pt'),
        'ru' => array('name' => 'Russian', 'flag' => 'ru'),
        'ja' => array('name' => 'Japanese', 'flag' => 'jp'),
        'fr' => array('name' => 'French', 'flag' => 'fr'),
        'de' => array('name' => 'German', 'flag' => 'de'),
        'ur' => array('name' => 'Urdu', 'flag' => 'pk'),
        'id' => array('name' => 'Indonesian', 'flag' => 'id'),
        'ko' => array('name' => 'Korean', 'flag' => 'kr'),
        'it' => array('name' => 'Italian', 'flag' => 'it'),
        'tr' => array('name' => 'Turkish', 'flag' => 'tr'),
        'vi' => array('name' => 'Vietnamese', 'flag' => 'vn'),
        'ta' => array('name' => 'Tamil', 'flag' => 'in'),
        'th' => array('name' => 'Thai', 'flag' => 'th'),
        'fa' => array('name' => 'Persian', 'flag' => 'ir'),
        'pl' => array('name' => 'Polish', 'flag' => 'pl'),
        'uk' => array('name' => 'Ukrainian', 'flag' => 'ua'),
        'ml' => array('name' => 'Malayalam', 'flag' => 'in'),
        'nl' => array('name' => 'Dutch', 'flag' => 'nl'),
        'ms' => array('name' => 'Malay', 'flag' => 'my'),
        'zh-TW' => array('name' => 'Chinese (Traditional)', 'flag' => 'tw'),
        'te' => array('name' => 'Telugu', 'flag' => 'in'),
        'mr' => array('name' => 'Marathi', 'flag' => 'in'),
        'sw' => array('name' => 'Swahili', 'flag' => 'tz'),
        'gu' => array('name' => 'Gujarati', 'flag' => 'in'),
        'kn' => array('name' => 'Kannada', 'flag' => 'in'),
        'ro' => array('name' => 'Romanian', 'flag' => 'ro'),
        'he' => array('name' => 'Hebrew', 'flag' => 'il'),
        'el' => array('name' => 'Greek', 'flag' => 'gr'),
        'hu' => array('name' => 'Hungarian', 'flag' => 'hu'),
        'cs' => array('name' => 'Czech', 'flag' => 'cz'),
        'sv' => array('name' => 'Swedish', 'flag' => 'se'),
        'bg' => array('name' => 'Bulgarian', 'flag' => 'bg'),
        'da' => array('name' => 'Danish', 'flag' => 'dk'),
        'fi' => array('name' => 'Finnish', 'flag' => 'fi'),
        'sk' => array('name' => 'Slovak', 'flag' => 'sk'),
        'no' => array('name' => 'Norwegian', 'flag' => 'no'),
        'hr' => array('name' => 'Croatian', 'flag' => 'hr'),
        'sr' => array('name' => 'Serbian', 'flag' => 'rs'),
        'lt' => array('name' => 'Lithuanian', 'flag' => 'lt'),
        'sl' => array('name' => 'Slovenian', 'flag' => 'si'),
        'et' => array('name' => 'Estonian', 'flag' => 'ee'),
        'lv' => array('name' => 'Latvian', 'flag' => 'lv'),
        'af' => array('name' => 'Afrikaans', 'flag' => 'za'),
        'sq' => array('name' => 'Albanian', 'flag' => 'al'),
        'am' => array('name' => 'Amharic', 'flag' => 'et'),
        'hy' => array('name' => 'Armenian', 'flag' => 'am'),
        'az' => array('name' => 'Azerbaijani', 'flag' => 'az'),
        'eu' => array('name' => 'Basque', 'flag' => 'es'),
        'be' => array('name' => 'Belarusian', 'flag' => 'by'),
        'bs' => array('name' => 'Bosnian', 'flag' => 'ba'),
        'ca' => array('name' => 'Catalan', 'flag' => 'es'),
        'ceb' => array('name' => 'Cebuano', 'flag' => 'ph'),
        'co' => array('name' => 'Corsican', 'flag' => 'fr'),
        'eo' => array('name' => 'Esperanto', 'flag' => 'eu'),
        'fy' => array('name' => 'Frisian', 'flag' => 'nl'),
        'gl' => array('name' => 'Galician', 'flag' => 'es'),
        'ka' => array('name' => 'Georgian', 'flag' => 'ge'),
        'ht' => array('name' => 'Haitian Creole', 'flag' => 'ht'),
        'ha' => array('name' => 'Hausa', 'flag' => 'ng'),
        'haw' => array('name' => 'Hawaiian', 'flag' => 'us'),
        'hmn' => array('name' => 'Hmong', 'flag' => 'cn'),
        'is' => array('name' => 'Icelandic', 'flag' => 'is'),
        'ig' => array('name' => 'Igbo', 'flag' => 'ng'),
        'ga' => array('name' => 'Irish', 'flag' => 'ie'),
        'jv' => array('name' => 'Javanese', 'flag' => 'id'),
        'kk' => array('name' => 'Kazakh', 'flag' => 'kz'),
        'km' => array('name' => 'Khmer', 'flag' => 'kh'),
        'rw' => array('name' => 'Kinyarwanda', 'flag' => 'rw'),
        'ku' => array('name' => 'Kurdish', 'flag' => 'iq'),
        'ky' => array('name' => 'Kyrgyz', 'flag' => 'kg'),
        'lo' => array('name' => 'Lao', 'flag' => 'la'),
        'la' => array('name' => 'Latin', 'flag' => 'va'),
        'lb' => array('name' => 'Luxembourgish', 'flag' => 'lu'),
        'mk' => array('name' => 'Macedonian', 'flag' => 'mk'),
        'mg' => array('name' => 'Malagasy', 'flag' => 'mg'),
        'mi' => array('name' => 'Maori', 'flag' => 'nz'),
        'mn' => array('name' => 'Mongolian', 'flag' => 'mn'),
        'my' => array('name' => 'Myanmar (Burmese)', 'flag' => 'mm'),
        'ne' => array('name' => 'Nepali', 'flag' => 'np'),
        'ny' => array('name' => 'Nyanja (Chichewa)', 'flag' => 'mw'),
        'or' => array('name' => 'Odia (Oriya)', 'flag' => 'in'),
        'ps' => array('name' => 'Pashto', 'flag' => 'af'),
        'pa' => array('name' => 'Punjabi', 'flag' => 'in'),
        'sm' => array('name' => 'Samoan', 'flag' => 'ws'),
        'gd' => array('name' => 'Scots Gaelic', 'flag' => 'gb'),
        'st' => array('name' => 'Sesotho', 'flag' => 'ls'),
        'sn' => array('name' => 'Shona', 'flag' => 'zw'),
        'sd' => array('name' => 'Sindhi', 'flag' => 'pk'),
        'si' => array('name' => 'Sinhala (Sinhalese)', 'flag' => 'lk'),
        'so' => array('name' => 'Somali', 'flag' => 'so'),
        'su' => array('name' => 'Sundanese', 'flag' => 'id'),
        'tl' => array('name' => 'Tagalog (Filipino)', 'flag' => 'ph'),
        'tg' => array('name' => 'Tajik', 'flag' => 'tj'),
        'tt' => array('name' => 'Tatar', 'flag' => 'ru'),
        'tk' => array('name' => 'Turkmen', 'flag' => 'tm'),
        'ug' => array('name' => 'Uyghur', 'flag' => 'cn'),
        'uz' => array('name' => 'Uzbek', 'flag' => 'uz'),
        'cy' => array('name' => 'Welsh', 'flag' => 'gb'),
        'xh' => array('name' => 'Xhosa', 'flag' => 'za'),
        'yi' => array('name' => 'Yiddish', 'flag' => 'il'),
        'yo' => array('name' => 'Yoruba', 'flag' => 'ng'),
        'zu' => array('name' => 'Zulu', 'flag' => 'za')
    );
}
