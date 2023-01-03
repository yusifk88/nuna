<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('application', 'backend');

set('repository', 'https://github.com/yusifk88/nuna.git');
set('branch', 'main');

add('shared_files', ['.env']);
add('shared_dirs', ['vendor']);
add('writable_dirs', ['storage']);

// Hosts

host('134.209.186.174')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '/var/www/html/mynunaa.com');

// Hooks
before('deploy:symlink', 'artisan:migrate');

after('deploy:failed', 'deploy:unlock');
