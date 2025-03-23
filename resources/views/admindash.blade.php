<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport" 
          content="width=device-width, 
                   initial-scale=1.0">
    <title>GadgetGrads</title>
    <link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/navbar.css') }}">
 
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
   
</head>

<body>

  <header id="main-header">
    <div class="header-left">
      <a href="{{ url('/home') }}">
        <img src="logo.png" alt="Gadget Grads Logo" class="logo">
      </a>
      <div class="navbar-text">
        <h1 class="navbar-title">GADGET GRADS</h1>
        <p class="navbar-subtitle">Graduate with better tech!</p>
      </div>
    </div>

    <div class="search-container">
      <form class="search-form" action="{{ route('search') }}" method="GET">
        <input type="text" class="search-input" name="query" placeholder="Search for products..." required>
        <button class="search-button" type="submit">Search</button>
      </form>
    </div>
    </div>
      <a href="{{ url('/wishlist') }}" class="wishlist-icon" title="Wishlist">
        <img src="heart.svg" height="30" alt="Wishlist icon">
      </a>
      <a href="{{ url('/basket') }}" class="cart-icon" title="Basket">
        <img src="basket.svg" height="30" alt="Basket icon">
      </a>
    </div>
   
    </header>

        <div class="main">

   

            <div class="box-container">

                <div class="box box1">
                    <div class="text">
                        <h2 class="topic-heading">30</h2>
                        <h2 class="topic">Live Product Count</h2>
                    </div>

                    <img src=
"vm-active-svgrepo-com.svg"
                        alt="Product Counter">
                </div>

                <div class="box box2">
                    <div class="text">
                        <h2 class="topic-heading">40</h2>
                        <h2 class="topic">Goal Product Count</h2>
                    </div>

                    <img src=
"product-warranty-term-svgrepo-com.svg" 
                         alt="Goal no.products">
                </div>

                <div class="box box3">
                    <div class="text">
                        <h2 class="topic-heading">5</h2>
                        <h2 class="topic">Tasks Completed</h2>
                    </div>

                    <img src=
"checklist-svgrepo-com.svg"
                        alt="tasks Completed">
                </div>

                <div class="box box4">
                    <div id="text">
                        <h2 id="urgentTasks">3</h2>
                        <h2 class="topic">Urgent Tasks</h2>
                    </div>

                    <img src=
"file-urgent-svgrepo-com.svg" alt="to do">
                </div>
            </div>
            <nav class="menu-container">
            <a href="{{ route('dashboard') }}" class="menu-item MyAccount">Dashboard Homepage</a>
          <a href="{{ route('changeCredentials') }}" class="menu-item changeEmailPassword">Change Email/Password</a>
          <a href="#" class="menu-item MyOrders" onclick="showSection('orders-section')">Workspace</a>
          <a href="{{ route('statistics') }}" class="menu-item MyWishlist">Statistics</a>
          <a href="#" class="menu-item Newsletter" onclick="showSection('newsletter-section')">Messages</a>
        </nav>
        <!-- <h1 class="admin-title">Admin Dashboard</h1> -->
            <div class="dash-container">
           
                <div class="graph-container">
                 <div class="WWCalendar">
                    <div class="container">
                        <img src="calendar-svgrepo-com.svg"class="calendar" alt="calendar icon">
                    <div class="description">
                    <h2>Today</h2>
                    <small>date of Event A</small>
                   <label for="workStatus" ><br>Work Status:</br></label>
                    <select id="workStatus"name="workStatus" title="Select Your Work Status" placeholder = "">
                    <option value="notPosted">Not Posted</option>
                    <option value="working">Working</option>
                    <option value="off">Time Off</option>
                    <option value="noShift">No Shift</option>
                    <option value="holiday">Holiday</option>
                    
                </select>
                    <span class="arrow"></span>
                    </div>
                    </div>
                    <div class="container">
                        <div class="description">
                        <h2>Tomorrow</h2>
                        <small>date of Event A</small>
                        <label for="workStatus" ><br>Work Status:</br></label>
                        <select id="workStatus"name="workStatus" title="Select Your Work Status" placeholder = "">
                        <option value="notPosted">Not Posted</option>
                        <option value="working">Working</option>
                        <option value="off">Time Off</option>
                        <option value="noShift">No Shift</option>
                        <option value="holiday">Holiday</option>
                        
                    </select>
                        <span class="arrow"></span>
                        </div>
                        <img src="calendar-svgrepo-com.svg"class="calendar" alt="calendar icon">
                        </div>
                        <div class="container">
                            <div class="description">
                            <h2>In Two Days</h2>
                            <small>date of Event A</small>
                            <label for="workStatus" ><br>Work Status:</br></label>
                            <select id="workStatus"name="workStatus" title="Select Your Work Status" placeholder = "">
                            <option value="notPosted">Not Posted</option>
                            <option value="working">Working</option>
                            <option value="off">Time Off</option>
                            <option value="noShift">No Shift</option>
                            <option value="holiday">Holiday</option>
                            
                        </select>
                            <span class="arrow"></span>
                            </div>
                            <img src="calendar-svgrepo-com.svg"class="calendar" alt="calendar icon">
                            </div>
                            <div class="container">
                                <div class="description">
                                <h2>In Three Days</h2>
                                <small>date of Event A</small>
                                <label for="workStatus" ><br>Work Status:</br></label>
                                <select id="workStatus"name="workStatus" title="Select Your Work Status" placeholder = "">
                                <option value="notPosted">Not Posted</option>
                                <option value="working">Working</option>
                                <option value="off">Time Off</option>
                                <option value="noShift">No Shift</option>
                                <option value="holiday">Holiday</option>
                                
                            </select>
                                <span class="arrow"></span>
                                </div>
                                <img src="calendar-svgrepo-com.svg"class="calendar" alt="calendar icon">
                                </div>
                                <div class="container">
                                    <div class="description">
                                    <h2>In Four days</h2>
                                    <small>date of Event A</small>
                                    <label for="workStatus" ><br>Work Status:</br></label>
                                    <select id="workStatus"name="workStatus" title="Select Your Work Status" placeholder = "">
                                    <option value="notPosted">Not Posted</option>
                                    <option value="working">Working</option>
                                    <option value="off">Time Off</option>
                                    <option value="noShift">No Shift</option>
                                    <option value="holiday">Holiday</option>
                                    
                                </select>
                                    <span class="arrow"></span>
                    
                                    </div>
                                    <img src="calendar-svgrepo-com.svg"class="calendar" alt="calendar icon">
                                    
                                    </div>
                 </div>
                    
                <div class="outer">
                    <div class="inner">
                        <div id="percent">
                            0%
                        </div>
                    </div>
                </div>
                
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="155px" height="155px">
                    <defs>
                        <linearGradient id="GradientColor">
                            <stop offset="0%" stop-color="#00A86B"/>
                            <stop offset="50%"stop-color="#FDDA0D"/>
                            <stop offset="100%" stop-color="#D2122E"/>
                        </linearGradient>
                    </defs>
                    <circle cx="77" cy="77" r="65" stroke-linecap="round"/>
                </svg>
               
                    
                </div>
                
            <div class ="todo-container">
                
            <div class="todo-list">
                <h2>Assignments To Complete<img src="checklist-marketing-pointer-svgrepo-com.svg"alt="to do"> </h2>
              <div class ="task-input">
                <input type ="text" id="input-box" placeholder="Remember to do">
                <button onclick ="addTask()">Add </button>
                
              </div>
              
              <ul id="task-container">
                <!-- <li class="done">Task 1</li>
                <li>Task 2</li>
                <li>Task 3</li>
                <li>Task 4</li> -->
                
              </ul>
            </div>
           </div>
            </div>
        

   
</body>

</html>