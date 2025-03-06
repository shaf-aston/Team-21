<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Gadget Grads</title>
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/about.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dark-mode-styles/about-dark-mode.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>

<body>
  @include('components.navbar')

  <main>
    <section class="about-us">
      <h2 class="about-heading">About Us</h2>
      <p>Welcome to Gadget Grads, your one-stop online store dedicated to students who are passionate about technology. Founded by students, for students, we aim to provide the best tech solutions to aid in your academic journey and beyond.</p>

      <h3 class="about-heading">Our Mission</h3>
      <div class="mission-container">
        <p>Our mission is to make high-quality technology accessible and affordable for students. We understand the financial constraints of student life, which is why we've created a platform that offers competitive prices without compromising on quality.</p>
      </div>

      <h3 class="about-heading">Our Values</h3>
      <ul class="values-list">
        <li>Quality Technology</li>
        <li>Student-First Approach</li>
        <li>Affordability</li>
        <li>Community Support</li>
      </ul>

      <h3 class="about-heading">The Symbolism of Our Logo</h3>
      <p>Our logo features twin mountain peaks, symbolizing the journey of academic growth and achievement. These peaks represent the challenges and progress in education, aiming for new heights of excellence and personal growth.</p>

      <div class="about-footer">
        <p><strong>Gadget Grads</strong> - Graduate with better tech!</p>
      </div>
    </section>
  </main>
</body>

</html>