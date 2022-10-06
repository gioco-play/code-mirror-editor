<?php

namespace GiocoPlus\CodeMirrorEditor;

use GiocoPlus\Admin\Extension;

class CodeMirrorExtension extends Extension
{
    const ASSETS_PATH = 'vendor/laravel-admin-ext/code-mirror/codemirror-5.65.9/';

    public $name = 'code-mirror';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';
}