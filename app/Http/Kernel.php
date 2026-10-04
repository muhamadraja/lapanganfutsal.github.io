protected $middlewareAliases = [
    // ... middleware lain
    'admin' => \App\Http\Middleware\IsAdmin::class,
];