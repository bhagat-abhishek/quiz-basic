<!DOCTYPE html>
<html>

<head>
    <title>Result Email</title>
    <style>
        /* Inline styles for email client compatibility */
        @media (max-width: 600px) {

            /* Mobile styles */
            .container {
                width: 100% !important;
                padding-left: 20px !important;
                padding-right: 20px !important;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Quiz Result</h1>
        <p class="text-gray-800">Your score: {{ $score }}</p>
    </div>
</body>

</html>
