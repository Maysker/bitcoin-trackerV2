<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(Request $request)
    {
        $endpoint = "https://api.binance.com/api/v3/ticker/24hr?symbol=BTCUSDT";
        $response = file_get_contents($endpoint);
        $data = json_decode($response, true);

        // Construct the email content
        $emailContent = 'Verlaagde bitcoinprijs: '. $data['priceChange']. '%';
        $emailSubject = 'Bitcoin Price Alert';

        // Check if price change percent is above 10%
        if ($data['priceChangePercent'] > 0.10) {
            Mail::raw($emailContent, function ($message) use ($emailSubject) {
                $message->subject($emailSubject)
                        ->to('wetsjill@gmail.com') // Recipient email
                        ->from('hello@bct.com', 'BCT'); // Sender email
            });
            echo "Email sent successfully.";
        } else {
            echo "No action taken.";
        }

        // Display the price change details
        echo "24-Hour Price Change for Bitcoin (BTC/USDT): ". PHP_EOL;
        echo "<ul>";
        echo "<li>Price Change: ". $data['priceChange']. PHP_EOL. "</li>";
        echo "<li>Price Change Percent: ". $data['priceChangePercent']. "%". PHP_EOL. "</li>";
        echo "</ul>";
    }
}
