<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class DecryptEnv extends Command
{
    protected $signature = 'env:decrypt {filename?}';
    protected $description = 'Decrypt the encrypted .env file';

    public function handle()
    {
        $filename = $this->argument('filename') ?? '.env.enc';

        if (!File::exists($filename)) {
            $this->error("File $filename does not exist.");
            return;
        }

        $encryptedContent = File::get($filename);
        $decryptedContent = Crypt::decryptString($encryptedContent);
        File::put('.env', $decryptedContent);

        $this->info("File $filename has been decrypted to .env");
    }
}