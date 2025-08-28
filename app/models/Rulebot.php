<?php

namespace App\Models;

class RuleBot
{
    private $rules = [
        // Greetings
        'hello' => "Hi there! How can I help you today?",
        'hi' => "Hello! Nice to see you. What can I do for you?",
        'good morning' => "Good morning! I hope you’re having a lovely day 🌞.",
        'good evening' => "Good evening! How was your day?",

        // Well-being
        'how are you' => "I’m just a bot, but I’m doing great! How about you?",
        'i am fine' => "I’m glad to hear that! 😊",
        'i am not feeling well' => "I’m sorry to hear that. Would you like me to give you information about contacting a doctor or caregiver?",

        // Care services
        'about' => "My system provides appointment and care for elderly people but they must be over 50 years old 😊",
        'yes tell me' => "Firstly , You need to register and then go to appointment form and submit your infromation.",
        'appointment' => "Firstly , You need to register and then go to appointment form and submit your infromation.",
        'need help' => "Sure, I’m here to help. Do you need assistance with meals, medicines, or appointments?",
        'help' => "I can answer basic questions. Try asking about meals, medicine reminders, or activities.",
        'doctor' => "If you need a doctor, I can help schedule an appointment or give you the clinic contact details.",
        'medicine' => "Don’t forget to take your medicine on time 💊. Do you want me to set a reminder?",
        'meal' => "It’s important to eat on time. Would you like today’s meal plan?",
        'exercise' => "Staying active is important. I can suggest light exercises suitable for seniors.",
        'activities' => "We have community activities like reading, light exercise, and social gatherings. Would you like details?",

        // Emotional support
        'i am lonely' => "I’m here to chat with you. Would you like me to tell you about upcoming group activities or ways to stay connected?",
        'thank you' => "You’re very welcome! 💖",
        'bye' => "Goodbye! Have a great day, and take care of yourself! 🌷",
    ];


    public function getReply(string $message): string
    {
        $message = strtolower(trim($message));

        // Match exact rule
        if (isset($this->rules[$message])) {
            return $this->rules[$message];
        }

        // Keyword-based (basic contains check)
        foreach ($this->rules as $keyword => $reply) {
            if (strpos($message, $keyword) !== false) {
                return $reply;
            }
        }

        // Default reply
        return "Sorry, I don't understand. Can you try rephrasing?";
    }
}
