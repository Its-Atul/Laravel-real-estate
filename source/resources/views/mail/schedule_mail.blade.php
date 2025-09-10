<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Email Title</title>
  <style>
    body {
      font-family: 'Rubik', sans-serif;
      line-height: 1.6;
      margin: 0;
      color: #93959e;
      padding: 0;
    }

    header {
        background-color: #2dbe6c;
        background-image: url('https://ibb.co/hKDnsbr')!important;
        color: #2d2929;
        text-align: center;
        padding: 1em;
    }

    section {
      padding: 1em;
    }

    footer {
      background-color: #1b1d21;
      color: #fff;
      text-align: center;
      padding: 1em;
    }
    footer, a{
        color: #fff;
        text-decoration: none;

    }
    a:hover{
        color: #2dbe6c;
    }
  </style>
</head>
<body>

  <header>
    <h1><strong>{{ $sitesetting->company_name }}</strong></h1>
    <p><strong>Congratulations!🎉😊👏</strong> Your schedule is confirm.</p>
  </header>

  <section>
    <h2>Latest Updates</h2>
    <p>Hello [Name],</p>
    <h3> Tour Date : {{ $schedule['tour_date'] }} </h3>
    <h3> Tour Time : {{ $schedule['tour_time'] }}</h3>
    <p>This is where you can include the content of your email. You can personalize it by replacing [Name] with the actual recipient's name.</p>
    <p>Feel free to add more sections and customize the content based on your needs.</p>
  </section>

  <footer>
    <p>Follow us on social media:</p>
    <a href="{{ $sitesetting->facebook }}">Facebook</a> | <a href="{{ $sitesetting->twitter }}">Twitter</a> | <a href="{{ $sitesetting->instagram }}">Instagram</a> | <a href="{{ $sitesetting->youtube }}">Youtube</a>
  </footer>

</body>
</html>
