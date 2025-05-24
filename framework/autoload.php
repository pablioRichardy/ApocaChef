<?
spl_autoload_register(function ($class){
    
    $prefixes = [
        'framework\\' => __DIR__ . '/',
        'api\\'   => __DIR__ . '/../html/',
        'frontend\\'   => __DIR__ . '/../html/',
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        if (str_starts_with($class, $prefix)) {
            $relativeClass = substr($class, strlen($prefix));
            $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

            if (file_exists($file)) {
                require $file;
                return;
            } else {
                throw new \Exception("Arquivo não encontrado: {$file}");
            }
        }
    }
});