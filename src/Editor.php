<?php

namespace GiocoPlus\CodeMirrorEditor;

use GiocoPlus\Admin\Form\Field;
use GiocoPlus\Admin\Form\NestedForm;
class Editor extends Field
{
    protected $options = [
        'mode'             => 'javascript',
        'lineNumbers'      => true,
        'matchBrackets'    => true,
        'continueComments' => true,
        'extraKeys'        => [
            'Ctrl-Q' => 'toggleComment',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    protected $view = 'laravel-admin-code-mirror-editor::editor';

    /**
     * {@inheritdoc}
     */
    protected static $css = [
        CodeMirrorExtension::ASSETS_PATH.'lib/codemirror.css',
    ];

    /**
     * {@inheritdoc}
     */
    protected static $js = [
        CodeMirrorExtension::ASSETS_PATH.'lib/codemirror.js',
        CodeMirrorExtension::ASSETS_PATH.'addon/edit/matchbrackets.js',
        CodeMirrorExtension::ASSETS_PATH.'addon/comment/continuecomment.js',
        CodeMirrorExtension::ASSETS_PATH.'addon/comment/comment.js',
        CodeMirrorExtension::ASSETS_PATH.'mode/javascript/javascript.js',
        CodeMirrorExtension::ASSETS_PATH.'addon/mode/multiplex.js',
        CodeMirrorExtension::ASSETS_PATH.'mode/xml/xml.js',
        CodeMirrorExtension::ASSETS_PATH.'mode/htmlembedded/htmlembedded.js',
        CodeMirrorExtension::ASSETS_PATH.'mode/htmlmixed/htmlmixed.js',
    ];

    
    /**
     * 客製化參數
     *
     * @param array $options
     * @return self
     */
    public function options($options = [])
    {
        $this->options = $options;
        return $this;
    }

    /**
     * 加載 js / mode 
     *
     * @param array $js
     * @return self
     */
    public function libs($js = []) {
        foreach($js as $path) {
            self::$js[] = CodeMirrorExtension::ASSETS_PATH . $path;
        }
        return $this;
    }

    /**
     * 編輯模式
     * https://codemirror.net/5/doc/manual.html#option_mode
     * @param string $mode
     * @return self
     */
    public function mode($mode = 'javascript')
    {
        $this->options['mode'] = $mode;
        return $this;
    }

    /**
     * Set editor height.
     *
     * @param int $height
     * @return $this
     */
    public function height($height = 10)
    {
        return $this->addVariables(compact('height'));
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $options = array_merge(
            $this->options,
            CodeMirrorExtension::config('config', [])
        );

        $options = json_encode($options);
        $name = $this->variables()["name"];
        $defaultKey = NestedForm::DEFAULT_KEY_NAME;
        $this->script = <<<EOT
var {$name}="{$name}".replace(/{$defaultKey}/g, window.index);
cm_{$name} = CodeMirror.fromTextArea(document.getElementById("{$name}"), $options);
\$tabs = $('.nav.nav-tabs');
if (\$tabs) {
    \$('a[data-toggle="tab"]').on('shown.bs.tab', function() {
        cm_{$name}.refresh();
    });
}
EOT;

        return parent::render();
    }
}