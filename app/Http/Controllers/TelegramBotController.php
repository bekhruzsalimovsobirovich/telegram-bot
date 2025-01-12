<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\User;
use Illuminate\Http\Request;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    protected $telegram;

    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    public function setWebhook()
    {
        Telegram::setWebhook(['url' => 'https://5542-84-54-73-249.ngrok-free.app/api/webhook']);

        return 'success';
    }

    public function webhook()
    {
        $update = $this->telegram->getWebhookUpdates();
        $chatId = $update->getMessage()->getChat()->getId();
        $username = $update->getMessage()->getChat()->getFirstName() ?? 'Guest'; // Fallback if username is not set
        $message = $update->getMessage()->getText();

        if (strtolower($message) === '/start') {
            $keyboard = [
                'keyboard' => [
                    [
                        [
                            'text' => 'Share Contact',
                            'request_contact' => true, // Enable contact sharing
                        ],
                    ],
                ],
                'resize_keyboard' => true, // Adjust the keyboard size
                'one_time_keyboard' => true, // Hide the keyboard after use
            ];

            Telegram::setAsyncRequest(true)
                ->sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Assalomu aleykum botimizga xush kelibsiz🙂 ' . '<b>' . $username . '</b>',
                    'parse_mode' => 'HTML',
                    'reply_markup' => json_encode($keyboard),
                ]);
        }

        if (isset($update->getMessage()->contact)) {
            $phoneNumber = $update->getMessage()->contact->phone_number;

//            // Check if the phone number already exists
//            $persons = People::query()->where('phone', $phoneNumber)->get();
//
//            if (count($persons) != 0) {
//                Telegram::setAsyncRequest(true)
//                    ->sendMessage([
//                        'chat_id' => $chatId,
//                        'text' => 'Siz oldin telefon raqamingizni jo\'natgansiz!',
//                    ]);
//                return;
//            }

            // Save the contact
            $people = new People();
            $people->chat_id = $chatId;
            $people->name = $update->getMessage()->getChat()->getFirstName();
            $people->username = $update->getMessage()->getChat()->getUsername();
            $people->phone = $phoneNumber;
            $people->save();

            Telegram::setAsyncRequest(true)
                ->sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Telefon raqamingizni jo\'natganiz uchun tashakkur!',
                    'reply_markup' => json_encode(['remove_keyboard' => true]),
                ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $update->getMessage(),
        ]);
    }
}
