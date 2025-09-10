<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #2dbe6c;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }

        section {
            padding: 20px;
        }

        footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <header>
            <h2>Contact Us</h2>
        </header>

        <section>
            <p>Hello {{ $site->company_name ?? 'Company Name' }},</p>
            <p>Someone has submitted a message through the contact form on your website. Here are the details:</p>

            <ul>
                <li><strong>Name:</strong> {{ $contact['username'] ?? 'Contact Name'}}</li>
                <li><strong>Email:</strong> {{ $contact['email'] ?? 'Contact Mail'}}</li>
                <li><strong>Phone:</strong> {{ $contact['phone'] ?? 'Contact Phone'}}</li>
                <li><strong>Subject:</strong> {{ $contact['subject'] ?? 'Contact Subject' }}</li>
                <li><strong>Message:</strong> {{ $contact['message'] ?? 'Contact Message' }}</li>
            </ul>

            <p>Please respond to this inquiry at your earliest convenience.</p>

            <p>Best regards,<br>{{ $site->company_name ?? 'Company Name' }}</p>
        </section>

        <footer>
            <p>&copy; {{ date('Y') }} {{ $site->company_name ?? 'Company Name' }}. All rights reserved.</p>
        </footer>
    </div>

</body>
</html>
