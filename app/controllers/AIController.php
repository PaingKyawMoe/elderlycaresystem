<?php

use App\Models\RuleBot;
use Controller;

require_once APPROOT . '/models/RuleBot.php';

class AIController extends Controller
{
    public function chat()
    {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);
        $message = trim($data['message'] ?? '');

        if ($message === '') {
            echo json_encode(['reply' => 'Please type a message.']);
            return;
        }

        // 1. Try Rule-based first
        $bot = new RuleBot();
        $reply = $bot->getReply($message);

        if ($reply !== "Sorry, I don't understand. Can you try rephrasing?") {
            echo json_encode(['reply' => $reply]);
            return;
        }

        // 2. Fallback → OpenAI
        $apiKey = OPENAI_API_KEY;
        $payload = [
            "model" => "gpt-4o-mini",
            "messages" => [
                ["role" => "system", "content" => "You are a helpful assistant."],
                ["role" => "user", "content" => $message]
            ]
        ];

        $ch = curl_init("https://api.openai.com/v1/chat/completions");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: " . "Bearer $apiKey"
            ],
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload)
        ]);

        $response = curl_exec($ch);
        $curlErr  = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($curlErr) {
            echo json_encode(['reply' => "Network error: $curlErr"]);
            return;
        }

        if ($httpCode !== 200) {
            echo json_encode(['reply' => "My brain is tired (API quota exceeded). Please try again later!"]);
            return;
        }

        $json = json_decode($response, true);
        if (isset($json['choices'][0]['message']['content'])) {
            $reply = $json['choices'][0]['message']['content'];
            echo json_encode(['reply' => $reply]);
            return;
        }

        echo json_encode(['reply' => "Sorry, I couldn’t process that."]);
    }
}
