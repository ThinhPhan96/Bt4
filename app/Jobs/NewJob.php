<?php

namespace App\Jobs;

use App\Model\Admin\BookModel;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NewJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $bookId;

    public function __construct($id)
    {
        $this->bookId = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $book = BookModel::find($this->bookId);
        if ($book->status == 2) {
            $book->status = 0;
            $book->save();
        }
    }
}
