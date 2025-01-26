<?php

namespace Deployer;

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
add('writable_dirs', []);

// Hosts
import('hosts.yml');

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

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Disable database migrations (because we don't use a DB)
task('artisan:migrate')->disable();

task('artisan:filament:optimize', function () {
	artisan('filament:optimize');
})->desc('Optimize Filament Panels');

after('artisan:config:cache', 'artisan:filament:optimize');

after('deploy:failed', 'deploy:unlock');


// Deploy files.
#before('deploy:symlink', 'files:push');
