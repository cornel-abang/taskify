<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class EncryptEnv extends Command
{
    protected $signature = 'env:encrypt {filename?}';
    protected $description = 'Encrypt the .env file';

    public function handle()
    {
        $filename = $this->argument('filename') ?? '.env';

        if (!File::exists($filename)) {
            $this->error("File $filename does not exist.");
            return;
        }

        $envContent = File::get($filename);
        $encryptedContent = Crypt::encryptString($envContent);
        File::put("$filename.enc", $encryptedContent);

        $this->info("File $filename has been encrypted to $filename.enc");
    }
}