<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Render Hook
    |--------------------------------------------------------------------------
    | You may customize the render hook used to display the hooks visibility
    | toggle button. If null, this will be set to 'global-search.before'.
    | The 'panels::' prefix will be added automatically if omitted.
    |
    */
    'render_hook' => 'global-search.before',
    /*
    |--------------------------------------------------------------------------
    | Icon
    |--------------------------------------------------------------------------
    | You may select a different Heroicon to display for the hooks visibility
    | toggle button. If null, the default will be 'heroicon-m-cursor-arrow-rays'.
    |
    */
    'icon' => 'heroicon-m-cursor-arrow-rays',
    /*
    |--------------------------------------------------------------------------
    | Minify Button
    |--------------------------------------------------------------------------
    | Setting this to true will only display a small icon as a toggle button.
    | Otherwise, the button will display action label to perform.
    |
    */
    'tiny_toggle' => false,
];
