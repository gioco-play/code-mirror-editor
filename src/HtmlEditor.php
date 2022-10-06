<?php

namespace GiocoPlus\CodeMirrorEditor;

class HtmlEditor extends Editor
{
    protected $options = [
        'mode' => "text/html",
        'lineNumbers' => true,
        'indentUnit' => 4,
        'indentWithTabs' => true,
        'matchBrackets' => true
    ];
}