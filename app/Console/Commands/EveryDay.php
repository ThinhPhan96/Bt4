<?php

namespace App\Console\Commands;

use App\Mail\BookLateMail;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EveryDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'everyday:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gui mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            foreach ($user->books as $book) {
                if ($book->pivot->status == 1) {
                    $email = $user->email;
                    Mail::to($email)->send(new BookLateMail());
                }
            }
        }
    }
}
