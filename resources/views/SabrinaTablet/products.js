const products = [
    {
      id: 1,
      title: "APPLE 11\" iPad Air (2024) - 128 GB, Space Grey",
      price: "£599.00",
      description: `Product code: 387472<br><br>
      Inspiration can strike anywhere, and iPad Air will be right there with you. 
        The 11\" Liquid Retina display's perfectly portable and packs accurate colours and life-like contrast. Just 
        what you need for creative projects. You'll also need loads of power – luckily the M2 chip inside has got 
        just that. From sketching to editing and gaming breaks in between, everything will run like a dream. Only 
        longer, because it's got up to 10 hours of battery life. Apple Intelligence helps you write, express yourself 
        and get things done effortlessly. It draws on your personal context while setting a brand-new standard for 
        privacy in AI.<br><br><br>
        Good to know <br><br>
- iPadOS 17 is full of powerful features and apps for productivity, entertainment and everything in-between<br>
- You can capture stunning photos, record 4K video, and scan documents using the 12 MP rear camera <br>
- The 12 MP Ultra Wide front camera is in a landscape orientation and supports Centre Stage, which is perfect for FaceTime <br>
- Touch ID's your key to quickly unlocking your iPad, signing into apps, and making secure payments with Apple Pay <br>
- With WiFi 6E you'll have fast and rock-solid internet connection <br>
- The USB Type-C lets you charge your iPad, connect and external display and transfer files in seconds `,
      image: "Images/iPadAir.svg"
    },
    {
            id: 2,
            title: "LENOVO Tab P12 12.7\" Tablet - 128 GB, Storm Grey",
            price: "£229.00",
            description: `Product code: 636311<br><br>
            Tired of lugging around a heavy laptop? This Lenovo tablet is a lightweight solution to work and play on the go. 
            The 12.7" display's so roomy that you can easily work in split screen mode – amazing for multitasking. 
            And it'll take your note taking to the next level. Use the 8 MP rear cam to snap lecture notes, 
            then annotate all over them with the Tab Pen Plus. For treating yourself to some Netflix, the 3K screen will make any show look stunningly vibrant.
             And no Bluetooth speakers necessary when you have got 4 Dolby Atmos speakers from JBL thatll crank out big, bold, immersive sound.<br><br><br>
             Good to know<br><br>
              - For switching apps, the octa-core MediaTek processor makes the P12 nice and snappy.<br>
              - The 13 MP front-facing cam is perfect for crisp and clear video calls.,<br>
              - Use Lenovo Freestyle and your tablet turns into a drawing pad and pairs to compatible Windows PCs.,<br>
              - The microSD card slot gives you up to 1 TB of extra storage – no need to delete photos!,<br>
              - Log-ins are safe and speedy when you've got a fingerprint sensor.:<br>
              - If you're travelling, the battery can keep you entertained for up to 10 hours of video playback.,<br>
              - For the ultimate mobile productivity, you can connect it to the Lenovo Keyboard Pack (sold separately).`,
              image:"Images/Lenovo.svg"
    },
    {
        id: 3,
        title: "LENOVO Tab Plus 11.5\" Tablet with Sleeve - 128 GB, Luna Grey",
        price: "£199.00",
        description: `Product code: 529220<br><br>
        With the Lenovo Tab Plus,you won't miss a beat. It's perfect for watching your favourite comfort show or the latest blockbuster. 
        The 11.5 2K screen brings scenes to life with amazing detail and vivid colours. 
        And you'll be blown away by the sound coming out of the 8 JBL speakers. 
        That's right – 8 speakers to total with 4 tweeters and 4 bass units. 
        So everything from distant whispers to massive explosions will sound just right. 
        There's even a 175° kickstand on the back that makes it easy to find the perfect viewing angle. 
        Now you just need to find a comfy chair and kick back. <br><br><br>
       Good to know <br><br>
 - For switching apps, the octa-core MediaTek processor makes the Tab Plus nice and snappy<br>
- With a 90 Hz refresh rate you're in for some smooth action in your favourite mobile games <br>
- The 8 MP cameras on the front and back are perfect for crisp video calls <br>
- The microSD card slot gives you up to 1 TB of extra storage – no need to delete photos! <br>
- Log-ins are safe and speedy when you've got a facial recognition <br>
- If you're travelling, the battery can keep you entertained for up to 12 hours of video playback <br>
- It comes with a handy sleeve that keeps the Tab safe while you're out and about.` ,
        image: "Images/LenovoPlus.svg",
    },
    {
        id: 4,
        title: "SAMSUNG Galaxy Tab A9+ 8.7\" Tablet - 64 GB, Graphite",
        price: "£154.00",
        description: `Product code: 530807<br><br>

The Galaxy Tab A9 is perfect for watching movies and TV shows. It's got a nice and bright 8.7" screen that lets you enjoy every detail. 
And to make sure the audio is just as good, there are two powerful speakers. 
They use Dolby Atoms surround sound to make your shows even more gripping. 
And if you need to knock a thing or two off of your to-do list, all your apps will be snappy thanks to the octa-core processor<br><br><br>
 Good to know<br>
 - The 8 MP camera on the back a 5 MP camera on the front let you take sharp photos and jump on video calls <br>
- Facial recognition keeps your personal files safe, secure and for your eyes only <br>
- There's 64 GB of space for your apps and photos - and you can extend the storage up to 1 TB with a microSD card `,
        image: "Images/Samsung",
    },
    {
        id: 5,
        title: "SAMSUNG Galaxy Tab S9 FE 10.9\" 5G Tablet",
        price: "£1469.00",
        description: `Product code: 722805<br><br>

The Galaxy Tab S9 FE's got a screen to behold. The 2K display has a 90 Hz refresh rate,
 so the image isn't just super-sharp, but nice and smooth, too. So whether you're reading, 
 binging or gaming, you'll have a great time. Or whip out the mighty S Pen and turn the Galaxy Tab into a 
 notepad, sketchbook or a canvas. It's up to you and your creativity.
  The Exynos 1380 processor's got plenty of power, so it won't be holding you back.<br><br><br>
 
Good to know <br><br>
 
- Browse, scroll and stream wherever you are thanks to 5G connectivity <br>
- From video calls to Insta-worthy selfies – the 8 MP rear camera and a 12 MP selfie camera will always make you look sharp <br>
- It's IP68 water-resistant, so getting caught in a rain shower doesn't have to bother you <br>
- AKG tuned dual speakers pump out full and punchy sound to match the screens visuals <br>
- You'll have plenty of space for your files and photos with 128 GB of storage  <br>
- Super Fast Charging means you can quickly top-up the battery level between uses (45W Super Fast charger sold separately) <br>
- It supports WiFi 6 connection for super-fast and rock-steady internet <br>
- A fingerprint scanner keeps the tablet secure and for your eyes only.` ,
        image: "Images/Samsung2",
    },
];

// Export the products array if you plan to use it in other files (e.g., in node.js, ES6 modules)
if (typeof module !== 'undefined') {
    module.exports = products;
}
  