<?php

namespace App\Providers;

use Aws\S3\S3Client;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class OciObjectStorageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('filesystems.default') != 'oci') {
            return;
        }

        Storage::extend('s3', function($app, $config) {
            $client = new S3Client([
                'credentials' => [
                    'key'    => $config['key'],
                    'secret' => $config['secret'],
                ],
                'region' => $config['region'],
                'version' => '2006-03-01',
                'bucket_endpoint' => true,
                'endpoint' => $config['url']
            ]);

            return new Filesystem(new AwsS3Adapter($client, $config['bucket'], $config['bucket']));
        });


    }
}
