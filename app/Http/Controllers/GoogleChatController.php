<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class GoogleChatController extends Controller
{
    protected $webhookUrl;

    public function __construct()
    {
        $this->webhookUrl = config('services.google_chat.webhook_url');
    }

    public function sendCard()
    {
        $cardPayload = [
            'cardsV2' => [
                [
                    'cardId' => 'unique_card_id_' . time(),
                    'card' => [
                        'header' => [
                            'title' => 'Example Card',
                            'subtitle' => 'Google Card v2 Example',
                        ],
                        'sections' => [
                            [
                                'widgets' => [
                                    [
                                        'textParagraph' => [
                                            'text' => 'This is an example of a Google Card v2 message.'
                                        ]
                                    ],
                                    [
                                        'buttonList' => [
                                            'buttons' => [
                                                [
                                                    'text' => 'Visit Website',
                                                    'onClick' => [
                                                        'openLink' => [
                                                            'url' => 'https://example.com'
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'widgets' => [
                                    [
                                        'textParagraph' => [
                                            'text' => 'Status: Active'
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return $this->sendToWebhook($cardPayload);
    }

    protected function sendToWebhook($payload)
    {
        try {
            $response = Http::post($this->webhookUrl, $payload);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Message sent successfully!'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send message',
                    'error' => $response->body()
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error sending message',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}