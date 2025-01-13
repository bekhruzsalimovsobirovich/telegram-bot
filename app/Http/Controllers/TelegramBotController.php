<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use App\Models\People;
use App\Models\User;
use Carbon\Carbon;
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
        Telegram::setWebhook(['url' => 'https://28c9-213-230-96-223.ngrok-free.app/api/webhook']);

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
                            'text' => 'Kontaktni yuborish📞',
                            'request_contact' => true, // Enable contact sharing
                        ],
                    ],
                ],
                'resize_keyboard' => true, // Adjust the keyboard size
                'one_time_keyboard' => true, // Hide the keyboard after use
            ];

            Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Assalomu aleykum botimizga xush kelibsiz🙂 ' . '<b>' . $username . '</b>',
                    'parse_mode' => 'HTML',
                    'reply_markup' => json_encode($keyboard),
                ]);

            Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Botdan foydalanish uchun, Iltimos telefon raqamingizni jo\'nating',
                    'parse_mode' => 'HTML'
                ]);
        }

        if (isset($update->getMessage()->contact)) {
            $phoneNumber = $update->getMessage()->contact->phone_number;

            People::query()
                ->where('chat_id', $chatId)->delete();

            People::updateOrCreate([
                'chat_id' => $chatId
            ],[
                'name' =>$update->getMessage()->getChat()->getFirstName(),
                'username' =>$update->getMessage()->getChat()->getUsername(),
                'phone' =>$phoneNumber,
            ]);

            Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Telefon raqamingizni jo\'natganiz uchun tashakkur😊!',
                    'reply_markup' => json_encode(['remove_keyboard' => true]),
                ]);

            Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Murojaatingizni yuborishingiz mumkin, Siz bilan tez orada bog\'lanishadi😊',
                ]);
        }

        if (isset($update->message) && !empty($update->message->text) && $update->message->text != '/start') {
            $people = People::query()->where('chat_id', $chatId)->first();

            $lastEntry = Appeal::query()
                ->where('people_id',$people->id)
                ->latest()
                ->first();

            if($lastEntry){
                $lastCreatedAt = Carbon::parse($lastEntry->created_at);

                if ($lastCreatedAt->diffInHours(Carbon::now()) < 1){
                    Telegram::sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'Keyingi murojatni yuborish uchun 1 soat kuting‼‼',
                    ]);

                    return ;
                }
            }

            Appeal::create([
                'people_id' => $people->id,
                'text' => $update->message->text,
            ]);

            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'Murojatingiz ko\'rib chiqish uchun yuborildi. Siz bilan albatta bog\'lanishadi',
            ]);

        }

        return response()->json([
            'status' => 'success'
        ]);
    }
}
