<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class MailController extends Controller
{
    public static function send()
    {
        $endpoint = "https://api.binance.com/api/v3/ticker/24hr?symbol=BTCUSDT";
        $response = file_get_contents($endpoint);
        $data = json_decode($response, true);
        $minimumEmailInterval = 60;

        // Construct the email content
        $emailContent = 'Beste, de Bitcoinprijs is verlaagd met '. $data['priceChangePercent']. '%. Grijp nu je kans!';
        $emailSubject = 'Bitcoin Price Alert';

        // Check if price change percent is above 10%
        if (abs($data['priceChangePercent']) > 0.10) {
            // Check when the last email was sent
            $lastSent = Cache::get('last_sent_time');

            if (is_null($lastSent) || now()->diffInMinutes($lastSent) >= $minimumEmailInterval) {
                // Send the email
                Mail::raw($emailContent, function ($message) use ($emailSubject) {
                    $message->subject($emailSubject)
                            ->to('wetsjill@gmail.com') // Recipient email
                            ->from('hello@bct.com', 'BCT'); // Sender email
                });

                // Update the last sent time
                Cache::put('last_sent_time', now());
            }
        }

        return $data;
    }
}
