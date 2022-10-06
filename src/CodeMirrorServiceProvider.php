<?php

namespace GiocoPlus\CodeMirrorEditor;

use GiocoPlus\Admin\Admin;
use GiocoPlus\Admin\Form;
use Illuminate\Support\ServiceProvider;

class CodeMirrorServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(CodeMirrorExtension $extension)
    {
        if (! CodeMirrorExtension::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'laravel-admin-code-mirror-editor');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/code-mirror')],
                'laravel-admin-code-mirror-editor'
            );
        }

        Admin::booting(function () {
            Form::extend('codeMirrorEditor', Editor::class);
            Form::alias('codeMirrorEditor', 'cme');

            Form::extend('cmeHtml', HtmlEditor::class);
            // Form::extend('jsond', Jsond::class);
            // Form::extend('typescript', Typescript::class);
        });
    }
}
