<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class OtpService
{
    public function sendOtp($toPhoneNumber)
    {
        try {
            // Generate a 6-digit OTP
            $otp = rand(100000, 999999);

            // Create a new Twilio Client instance
            $client = new Client(
                env('TWILIO_SID'),
                env('TWILIO_AUTH_TOKEN')
            );

            // Send OTP via SMS
            $message = $client->messages->create(
                $toPhoneNumber,
                [
                    'from' => env('TWILIO_PHONE_NUMBER'),
                    'body' => 'Your verification code is: ' . $otp
                ]
            );

            // Log the message SID (for debugging purposes)
            Log::info('OTP sent to ' . $toPhoneNumber . '. Message SID: ' . $message->sid);

            return true;
        } catch (TwilioException $e) {
            // Log specific Twilio error
            Log::error('Twilio error: ' . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            // Log other general errors
            Log::error('General error: ' . $e->getMessage());
            return false;
        }
    }

}