<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Rating Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
        }

        p {
            color: #666666;
        }

        .rating {
            font-size: 24px;
            color: #ffc107;
            margin: 10px 0;
        }

        .review-content {
            color: #333333;
            margin: 10px 0;
        }

        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #ffffff;
            text-decoration: none;
            border-radius: 3px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Dear {{ $name ?: auth()->user()->name}}</h1>
        <p>Your feedback fuels our passion for excellence!</p>

        <a href="{{ $link }}" style="text-decoration: none">
            <div class="rating">⭐⭐⭐⭐⭐</div>
            <div class="rating">⭐⭐⭐⭐ </div>
            <div class="rating">⭐⭐⭐  </div>
            <div class="rating">⭐⭐   </div>
            <div class="rating">⭐   </div>
        </a>

        <p class="review-content">
            Your review lights up our day! Thank you for sharing your thoughts and experiences with us. Your five-star rating reflects the dedication and commitment we pour into our service.
        </p>
        <p class="review-content">
            But wait, we're not stopping there! We're constantly striving to elevate your experience even further. Your feedback is like a guiding star, illuminating our path towards perfection.
        </p>
        <p class="review-content">
            Got more to say? We're all ears! Whether it's a suggestion, a question, or just a friendly chat, don't hesitate to reach out to us. Your voice matters, and we're here to listen.
        </p>
        <p class="review-content">
            Looking forward to hearing from you soon!
        </p>
        <p class="review-content">
            Warm regards,
        </p>

        <p>If you have any further feedback or questions, feel free to reach out to us.</p>
        <p>from: <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}">{{ env('MAIL_FROM_ADDRESS') }}</a></p>
        
        <p>P.S. Ready to embark on another journey of sharing your experiences?  <a href="{{ $link }}" class="">Click here</a> to write another review!</p>

        {{-- <a href="{{ $link }}" class="cta-button">Write Another Review</a> --}}
    </div>
</body>

</html>
