<?php

namespace App\Tasks;


use App\Extensions\Sms\Tasks\SendTextMessage;
use App\Extensions\TaskManager\Task;
use App\Mail\SendEnquiryByMail;
use App\Models\Enquiry;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendEnquiry extends Task
{
    protected $trigger = 'enquiry.created';

    const TOTAL_CHARS_PER_UNIT = 160;

    /**
     * @param array $args
     */
    public function execute(...$args)
    {
        /** @var Enquiry $enquiry */
        $enquiry = $args[0];


        $this->sendSms($enquiry);

        $this->sendEmail($enquiry);
    }


    /**
     * @param Enquiry $enquiry
     */
    private function sendEmail(Enquiry $enquiry)
    {
        /** @var User $receipient */
        $receipient = $enquiry->user;

        // todo send email
        $email = $receipient->email;
//        $email = 'dennisohere@live.com';

        Mail::to($email)->send(new SendEnquiryByMail($enquiry));
    }


    private function sendSms(Enquiry $enquiry)
    {
        /** @var User $recipient */
        $recipient = $enquiry->user;

        $text_message = "Hi $recipient->username, ";
        $text_message .= "$enquiry->name just requested for $enquiry->product_name ";
        $text_message .= "on your MyDLT platform, contact him/her now on $enquiry->phone";

        $total_chars = Str::length($text_message);

        $estimated_units = ceil($total_chars / self::TOTAL_CHARS_PER_UNIT);


        // todo send sms

        if (!$recipient->canAffordUnit($estimated_units)){
            Log::alert($recipient->username . ': Insufficient units!');
            return ;
        }


        $phone = $recipient->phone;
//        $phone = '08060935051';

        Task::publishTask(new SendTextMessage(), $text_message, [$phone], 'MyDLT', $enquiry->user);

    }
}