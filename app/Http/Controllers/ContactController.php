<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\MailForm;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function contact(ContactFormRequest $request): \Illuminate\Http\JsonResponse
    {
        $formData = $request->validated();

        foreach (['djtresk@gmail.com', 'happy_centre@mail.ru'] as $recipient) {
            Mail::to($recipient)->send(new MailForm($formData));
        }

        return response()->json('Спасибо за заявку!', 200, array());
    }
}
