<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;

function get_ai_advice($question)
{
    // Load .env file and access the API key
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $apiKey = $_ENV['API_KEY'];

    // Prepare the API URL with the key
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=$apiKey";
    // Set the data payload
    $data = [
        'contents' => [
            [
                'parts' => [
                    ['text' => $question]
                ]
            ]
        ]
    ];
    // echo "cURL Data: ";
    // print_r($data);
    // echo "<br>";
    // Initialize cURL
    $ch = curl_init($url);

    // Set the necessary options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute the request
    $response = curl_exec($ch);
    // echo "Response: ";
    // print_r($response);
    // echo  "<br>";
    // Check for errors
    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        return "cURL error: $error";
    }

    // Close the cURL session
    curl_close($ch);

    // Decode and return the response
    $responseData = json_decode($response, true);
    $candidates = $responseData["candidates"];
    // echo "Candidates: ";
    // print_r($candidates);
    // echo  "<br>";
    $response_message = $candidates[0]["content"]["parts"][0]["text"];
    return $response_message ?? 'I\'m so sorry, I don\'t know what to say at this point.';
}
