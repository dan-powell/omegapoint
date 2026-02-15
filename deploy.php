<?php

namespace Deployer;

use Symfony\Component\Console\Input\InputOption;

require 'recipe/laravel.php';

// Project name
set('application', 'omegapoint');

// Project repository
set('repository', 'git@github.com:dan-powell/omegapoint.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', [
	'public/storage'
]);

// Writable dirs by web server
set('writable_mode', 'chmod');
set('writable_chmod_mode', 775);
set('writable_use_sudo', true);
set('writable_recursive', true);
set('http_user', 'www-data');
set('http_group', 'www-data');

set('writable_dirs', [
    '{{release_or_current_path}}/storage'
]);

// Hosts
import('hosts.yml');

// Disable database migrations (because we don't use a DB)
task('artisan:migrate')->disable();

// Tasks
task('files:pull', function () {
	download(get('deploy_path') . '/shared/public/storage/', 'public/storage');
	download(get('deploy_path') . '/shared/storage/images/', 'storage/images');
})->desc('Copies server files to local.');

task('files:push', function () {
	upload('public/storage/', get('deploy_path') . '/shared/public/storage/');
	upload('storage/images/', get('deploy_path') . '/shared/storage/images');
})->desc('Copies local files to server.');

task('files:sync', function () {
	download(get('deploy_path') . '/shared/public/storage/', 'public/storage', ['options' => ['--delete']]);
	download(get('deploy_path') . '/shared/storage/images/', 'storage/images', ['options' => ['--delete']]);
})->desc('Removes local files that do not exist server-side.');

task('files:clean', function () {
    $ask = askConfirmation('This is a destructive command. Proceed?');
	if($ask) {
		upload('public/storage/', get('deploy_path') . '/shared/public/storage', ['options' => ['--delete']]);
		upload('storage/images/', get('deploy_path') . '/shared/storage/images', ['options' => ['--delete']]);
	}
})->desc('Removes server-side files that do not exist locally.');

// Push/Pull env file
task('env:pull', function () {
    download('{{deploy_path}}/shared/.env', '.env.production', ['progress_bar' => false]);
});
task('env:push', function () {
    upload('.env.production', '{{deploy_path}}/shared/.env', ['progress_bar' => false]);
});

// Push env on a fresh install
option('fresh', null, InputOption::VALUE_NONE, 'Fresh deployment: pushes local .env to remote');
task('deploy:check_fresh', function () {
    if (input()->getOption('fresh')) {
        writeln('<info>Fresh flag detected: Pushing .env file...</info>');
        invoke('env:push');
    }
});
after('deploy:shared', 'deploy:check_fresh');

// Optimize filament panels
task('artisan:filament:optimize', function () {
	artisan('filament:optimize');
})->desc('Optimize Filament Panels');
after('artisan:config:cache', 'artisan:filament:optimize');

// if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Standalone task to run composer install with dev dependencies
task('composer:install:dev', function () {
    run('{{bin/composer}} install --prefer-dist --optimize-autoloader');
});

// Set binaries to use docker

function getDockerRunCommand($cmd) {
    $composeFile = get('docker_path') . '/docker-compose.yml';
    return sprintf(
        'sudo /usr/bin/docker compose -f %s run --rm -u $(id -u):$(id -g) -w {{release_or_current_path}} deploy %s',
        $composeFile,
        $cmd
    );
}
set('bin/composer', function () {
    return getDockerRunCommand('composer');
});
set('bin/php', function () {
    return getDockerRunCommand('php');
});

// Fix permissions

task('deploy:fix_storage_permissions', function () {
    run('sudo chown -R web {{deploy_path}}/shared/storage');
    run('sudo chgrp -R www-data {{deploy_path}}/shared/storage');
    run('sudo chmod -R g+s {{deploy_path}}/shared/storage');
});
after('deploy:writable', 'deploy:fix_storage_permissions');
