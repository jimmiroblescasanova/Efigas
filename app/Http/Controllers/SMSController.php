<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AWS;

class SMSController extends Controller
{
    protected function sendSMS($phone_number){
        $sms = AWS::createClient('sns');

        $sms->publish([
            'Message' => 'Estimado cliente, esta recibiendo este mensaje porque presenta un adeudo en su cuenta, o lo paga o se lo carga el payaso.',
            'PhoneNumber' => $phone_number,
            'MessageAttributes' => [
                'AWS.SNS.SMS.SMSType'  => [
                    'DataType'    => 'String',
                    'StringValue' => 'Transactional',
                ]
            ],
        ]);
    }
}
