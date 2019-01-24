<?php

namespace App\Notifications;

use App\Model\AuditBalances;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class AdminNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    //composer require guzzlehttp/guzzle
    
    public function toSlack(){
        $url = "https://www.isjeady.com/crypto";

        $auditBalances = AuditBalances::orderBy('created_at','desc')->limit(3)->get();
        $auditBalanceLast = 0;

        if($auditBalances->count() > 1){
            $auditBalanceLast = $auditBalances[1]->balance;
        }

        $trend = ($this->subject > $auditBalanceLast) ? ':+1:' : ':-1:';

        return (new SlackMessage)
                ->success()
                ->content('Crypto Balance:'. $this->subject.' EUR ' . $trend)
                ->attachment(function ($attachment) use ($url, $auditBalanceLast,$trend) {
                    $attachment->title('Invoice 1322', $url)
                               ->fields([
                                    'Data' => Carbon::now()->format('d-M-Y h:m:s'),
                                    'Amount' => $this->subject .' EUR ',
                                    'Trend' => $trend,
                                    'Last' => $auditBalanceLast .' EUR ',
                                ]);
                });
    }
}
