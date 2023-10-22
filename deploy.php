<?php

namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:yusifk88/nuna.git');
set("branch", "admin");

add('shared_files', ['.env']);
add('shared_dirs', ['storage']);
add('writable_dirs', [
    'bootstrap/cache',
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/cache/data',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);

set('log_files', 'storage/logs/*.log');

// Hosts

host('134.209.186.174')
    ->set('remote_user', 'root')
    ->set('deploy_path', '/var/www/html/admin');

// Hooks
desc("clear opcache cache");
after('deploy:success', run('service php8.1-fpm reload'));

after('deploy:failed', 'deploy:unlock');
