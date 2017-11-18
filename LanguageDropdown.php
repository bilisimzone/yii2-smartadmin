<?php

namespace coreb2c\smartadmin;

class LanguageDropdown extends Widget {
/**
 *
 * @var array Languages. Keys are used to create multi language urls. 'flag' indexes are used to display flag icons 
 */
    public $languages = [
        'tr' => [
            'name' => 'Türkçe',
            'flag' => 'tr'
        ],
        'en' => [
            'name' => 'English',
            'flag' => 'us'
        ],
    ];
    public $activeLanguage = null;

    public function run() {
        return $this->render('language_dropdown', [
                    'languages' => $this->languages,
                    'activeLanguage' => $this->activeLanguage,
        ]);
    }

}
