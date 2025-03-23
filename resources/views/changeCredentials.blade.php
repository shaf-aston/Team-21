 
<style>
    @import url(
        "https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
    body{
        background-color: #002D62;
        font-family: "Poppins", sans-serif;
    }
    h2{
        color: rgb(255, 255, 255);
    }
    .menu-container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    width: calc(100% - 20px);
    margin: 2px;
    padding: 20px 10px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
}

.menu-item {
    text-decoration: none;
    text-align: center;
    color: white;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    padding: 10px 8px;
    transition: all 0.3s ease;
    white-space: nowrap;
    flex: 1;
    margin: 0 3px;
}

.menu-item:hover {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    transform: translateY(-2px);
}

.menu-item.active {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 8px;
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    font-weight: 600;
}
    .section-container {
    padding: 20px;
    margin-top: 10px;
    position: relative;
    min-height: 400px;
}
.section-content {
    background: rgba(255, 255, 255, 0.95);
    padding: 25px 0 25px 25px;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: opacity 0.3s ease, visibility 0.3s ease;
    position: absolute;
    width: calc(100% - 65px);
}

.section-content h2 {
    color: #6384e4;
    margin-bottom: 20px;
    font-size: 24px;
    font-weight: 600;
}



.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #2d4059;
    font-weight: 500;
}

.form-group input {
    width: 95%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
}

#credentials-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    width: 95%;
    position: relative;
    padding: 20px;
    background: rgb(255, 255, 255);
    border-radius: 15px;
}

.credentials-separator {
    width: 100%;
    height: 1px;
    background: linear-gradient(to right, transparent, #2d4059, transparent);
    margin: 0;
    opacity: 0.5;
}

.form-row {
    display: flex;
    gap: 30px;
    width: 100%;
    padding: 10px 0;
}

.form-row {
    display: flex;
    gap: 30px;
    width: 100%;
    padding: 15px 0;
}

.form-row .form-group {
    flex: 1;
    margin-bottom: 0;
}

.submit-btn,
.save-btn {
    background: #6384e4;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease;
    margin-top: 15px;
    display: block;
}

.submit-btn:hover,
.save-btn:hover {
    background: #4a6cd0;
    transform: translateY(-1px);
}
</style>
 
 <body>
 <nav class="menu-container">
         <a href="{{ route('dashboard') }}" class="menu-item MyAccount">Dashboard Homepage</a>
          <a href="{{ route('changeCredentials') }}" class="menu-item changeEmailPassword">Change Email/Password</a>
          <a href="#" class="menu-item MyOrders" onclick="showSection('orders-section')">Workspace</a>
          <a href="{{ route('statistics') }}" class="menu-item MyWishlist">Statistics</a>
          <a href="#" class="menu-item Newsletter" onclick="showSection('newsletter-section')">Messages</a>
        </nav>
 <!-- Change Credentials Section -->
 <div id="change-credentials-section">
            <h2>Update Your Credentials</h2>
            
            <form id="credentials-form">
              <div class="form-row">
                <div class="form-group">
                  <label for="current-email">Current Email</label>
                  <input type="email" id="current-email" required placeholder="Current email...">
                </div>
                <div class="form-group">
                  <label for="new-email">New Email</label>
                  <input type="email" id="new-email" placeholder="New email...">
                </div>
              </div>

              <div class="credentials-separator"></div>

              <div class="form-row">
                <div class="form-group">
                  <label for="current-password">Current Password</label>
                  <input type="password" id="current-password" required placeholder="Current password...">
                </div>
                <div class="form-group">
                  <label for="new-password">New Password</label>
                  <input type="password" id="new-password" placeholder="New password...">
                </div>
              </div>
              <button type="submit" class="submit-btn">Update Credentials</button>
            </form>
          </div>
          </body>