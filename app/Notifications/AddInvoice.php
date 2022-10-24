<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\invoices;
use Illuminate\Support\Facades\Auth;

class AddInvoice extends Notification
{
    use Queueable;
    private $invoice_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice_id)
    {
        $this->invoice_id=$invoice_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     *public function toMail($notifiable)
    * {
    *    $url = 'http://127.0.0.1:8000/InvoicesDetails/'.$this->invoice_id;
    *    return (new MailMessage)
    *                ->subject('Add New Invoice')
    *                ->line('The introduction to the notification.')
    *                ->action('Show Invoice', $url)
    *                ->line('Thank you for using our application!');
    * }
    */


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'id'=>$this->invoice_id->id,
            'title'=>'an Invoice has been added by: ',
            'user'=>Auth::user()->name,
            //'data' => $this->details['body']
        ];
    }
}
