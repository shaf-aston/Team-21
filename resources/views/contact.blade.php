<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
  <title>Contact Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dark-mode-styles/contact-dark-mode.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
  @include('components.navbar')

  <div class="contact-page">
    <div class="container">
      <div class="mail-icon-container">
        <img src="{{asset('images/mail.gif')}}" alt="email icon">
      </div>

      <div class="container-text">
        @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST">
          @csrf
          <h2>Contact Form:</h2>

          <label for="name">Your Name:</label><br>
          <input type="text" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}"><br>
          @error('name')<span class="error">{{ $message }}</span><br>@enderror

          <label for="email">Your Email Address:</label><br>
          <input type="email" id="email" name="email" placeholder="Enter your email address" value="{{ old('email') }}"><br>
          @error('email')<span class="error">{{ $message }}</span><br>@enderror

          <label for="subject">Subject:</label><br>
          <input type="text" id="subject" name="subject" placeholder="Enter subject" value="{{ old('subject') }}"><br>
          @error('subject')<span class="error">{{ $message }}</span><br>@enderror

          <label for="pwho">Who should receive your message?</label><br>
          <select id="pwho" name="pwho" title="Select the department or person you want to contact">
            <option value="" disabled selected>-- Select a Department --</option>
            <option value="hr" {{ old('pwho') == 'hr' ? 'selected' : '' }}>HR</option>
            <option value="admin" {{ old('pwho') == 'admin' ? 'selected' : '' }}>Admin Team</option>
            <option value="services" {{ old('pwho') == 'services' ? 'selected' : '' }}>Customer Services</option>
            <option value="management" {{ old('pwho') == 'management' ? 'selected' : '' }}>Stock Management</option>
            <option value="ceo" {{ old('pwho') == 'ceo' ? 'selected' : '' }}>CEO</option>
            <option value="nsure" {{ old('pwho') == 'nsure' ? 'selected' : '' }}>Not Sure</option>
          </select><br>
          @error('pwho')<span class="error">{{ $message }}</span><br>@enderror

          <label for="ymessage">Type Your Message:</label><br>
          <textarea id="ymessage" name="message" placeholder="Write your message here...">{{ old('message') }}</textarea><br>
          @error('message')<span class="error">{{ $message }}</span><br>@enderror

          <input type="submit" value="Submit">
        </form>
      </div>
    </div>
  </div>
  @include('components.chat-support')
  <script src="{{ asset('js/chatbot.js') }}"></script>
</body>
@include('components.Footer')

</html>