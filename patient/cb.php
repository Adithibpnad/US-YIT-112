<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Chatbot</title>
    <style>
        #chat-container {
            border: 1px solid #ccc;
            padding: 10px;
            max-width: 700px;
            height: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<?php
// Function to handle user input and generate chatbot response
function simpleChatbot($userInput) {
    $userInput = strtolower($userInput);

    // Define some simple rules for the chatbot
    $greetings = ['hello', 'hi', 'hey', 'howdy'];
    $farewells = ['bye', 'goodbye', 'see you later'];
    $compliments = ['nice', 'great', 'awesome', 'cool'];
    $symptomsQuery = ['cold', 'fever', 'diabetes','flu'];

    // List of doctors with their specialties
    $doctors = [
        "Dr. Disha" => ["cold", "flu"],
        "Dr. Jason" => ["fever"],
        "Dr. Adithi BP" => ["diabetes"]
        // Add more doctors and their specialties as needed
    ];

    // Check user input and generate a response
    if (in_array($userInput, $greetings)) {
        return "Hello! What are your symptoms?";
    } elseif (in_array($userInput, $farewells)) {
        return "Goodbye! Have a great day!";
    } elseif (in_array($userInput, $compliments)) {
        return "Thank you! I'm here to assist you.";
    } elseif (array_intersect(explode(' ', $userInput), $symptomsQuery)) {
        // Randomly select a symptom and suggest a doctor
        $randomSymptom = $symptomsQuery[array_rand($symptomsQuery)];
        $doctorSuggestions = [];

        foreach ($doctors as $doctor => $specialties) {
            if (in_array($randomSymptom, $specialties)) {
                $doctorSuggestions[] = $doctor;
            }
        }

        if (!empty($doctorSuggestions)) {
            return "It sounds like you might have $randomSymptom. I recommend consulting with one of these doctors: " . implode(', ', $doctorSuggestions);
        } else {
            return "I'm just a simple chatbot and don't have any symptoms. How can I assist you today?";
        }
    } else {
        return "I'm sorry, I didn't understand that. Can you please rephrase?";
    }
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userInput = strtolower($_POST["user-input"]);
    $botResponse = simpleChatbot($userInput);

    echo "<div id='chat-container'>";
    echo "<div id='chat-log'>Simple Chatbot: Hello! Type 'bye' to exit.<br>User: $userInput<br>Simple Chatbot: $botResponse</div>";
    echo "<form method='post' action=''>";
    echo "<input type='text' name='user-input' placeholder='User:'>";
    echo "<button type='submit'>Send</button>";
    echo "</form>";
    echo "</div>";
} else {
    // Initial page load
    echo "<div id='chat-container'>";
    echo "<div id='chat-log'>Simple Chatbot: Hello! Type 'bye' to exit.</div>";
    echo "<form method='post' action=''>";
    echo "<input type='text' name='user-input' placeholder='User:'>";
    echo "<button type='submit'>Send</button>";
    echo "</form>";
    echo "</div>";
}
?>

</body>
</html>