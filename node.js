// Assuming you have an array of admin phone numbers
const admin_phone_number = ["0714487081",  /* Add more admin phone numbers here */];

// Phone number to be checked
const user_phone_number = user_phone_number; // Replace with the user's phone number

// Check if the userPhoneNumber is in the adminPhoneNumbers array
if (admin_phone_number.includes(user_phone_number)) {
    // This is an admin, no deposit required
    console.log("User is an admin. No deposit required.");
    // You can handle admin-specific logic here
} else {
    // This is not an admin, deposit is required
    console.log("User is not an admin. Deposit is required.");
    // You can proceed with deposit logic for regular users here
}

let unirest = require('unirest');
let req = unirest('GET', 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials')
.headers({ 'Authorization': 'Bearer cFJZcjZ6anEwaThMMXp6d1FETUxwWkIzeVBDa2hNc2M6UmYyMkJmWm9nMHFRR2xWOQ==' })
.send()
.end(res => {
    if (res.error) throw new Error(res.error);
    console.log(res.raw_body);
});
const express = require('express');
const bodyParser = require('body-parser');
const app = express();
const port = 3000;

app.use(bodyParser.json());

// In-memory storage for user data (replace with a database in a real application)
const userData = {};
// Withdraw Funds
app.post('/withdraw', (req, res) => {
  const { phone, amount } = req.body;

  if (!userData[phone] || userData[phone] < amount) {
    res.json({ success: false, message: 'Insufficient funds.' });
  } else {
    userData[phone] -= amount;
    res.json({ success: true });
  }
});

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
const express = require('express');
const mongoose = require('mongoose');
const passport = require('passport');
const LocalStrategy = require('passport-local').Strategy;
const session = require('express-session');
const bodyParser = require('body-parser');


// Set up a MongoDB database connection
mongoose.connect('mongodb://localhost/userapp', { useNewUrlParser: true, useUnifiedTopology: true });
const User = require('./models/user');

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));
app.use(session({ secret: 'secret', resave: true, saveUninitialized: true }));
app.use(passport.initialize());
app.use(passport.session());

// Passport Configuration
passport.use(new LocalStrategy(User.authenticate()));
passport.serializeUser(User.serializeUser());
passport.deserializeUser(User.deserializeUser());

// Routes
app.get('/', (req, res) => res.send('Welcome to the Knight Referrals platform'));

// Registration Route
app.post('/register', (req, res) => {
  const newUser = new User({ username: req.body.username });
  User.register(newUser, req.body.password, (err, user) => {
    if (err) {
      console.log(err);
      return res.render('register');
    }
    passport.authenticate('local')(req, res, () => {
      res.redirect('/profile');
    });
  });
});

// User Profile Route
app.get('/profile', isLoggedIn, (req, res) => {
  res.send('User Profile Page');
});

// User Settings Route
app.get('/settings', isLoggedIn, (req, res) => {
  res.send('User Settings Page');
});

// Middleware to check if the user is authenticated
function isLoggedIn(req, res, next) {
  if (req.isAuthenticated()) {
    return next();
  }
  res.redirect('/login');
}

app.listen(3000, () => {
  console.log('Server started on port 3000');
});
// JavaScript code in your scripts.js file

// Function to fetch referral data (Replace with actual API calls)
function fetchReferralData(userId) {
  // Simulate fetching data from an API using user ID
  return new Promise((resolve) => {
      // Replace this with your actual API endpoint or data retrieval logic
      setTimeout(() => {
          const referralData = [
              { name: "Reffered member 1",referral_userid },
              { name: "Reffered member 2", referral_userid},
              { name: "Reffered member 3", referral_userid },
              // Add more referral data as needed
          ];
          resolve(referralData);
      }, 1000); // Simulating a delay
  });
}

// Function to render the list of referred members
async function renderReferrals(userId) {
  const referralList = document.querySelector(".referral-list");
  
  try {
      const referralData = await fetchReferralData(userId);
      
      if (referralData.length === 0) {
          referralList.innerHTML = "No referred members to display.";
      } else {
          referralList.innerHTML = referralData
              .map((referral) => `<li>${referral.id} </li>`)
              .join("");
      }
  } catch (error) {
      console.error("Error fetching referral data:", error);
      referralList.innerHTML = "Error loading referred members.";
  }
}

// Replace '123' with the actual user ID of the logged-in user
const userId = $usercode;

// Call the renderReferrals function to display the list of referred members
renderReferrals(userId);
// JavaScript code in your scripts.js file

// Function to fetch earnings and bonuses data (Replace with actual API calls)
function fetchEarningsData(userId) {
  // Simulate fetching data from an API using user ID
  return new Promise((resolve) => {
      // Replace this with your actual API endpoint or data retrieval logic
      setTimeout(() => {
          const earningsData = {
              balance: "ksh 0.00", // Replace with the actual available balance
              bonuses: [
                  { amount: 50.00, date: "2023-11-09" },
                  { amount: 100.50, date: "2023-11-08" },
                 
                  // Add more bonus data as needed
              ],
          };
          resolve(earningsData);
      }, 1000); // Simulating a delay
  });
}

// Function to render earnings and bonuses information
async function renderEarnings(userId) {
  const balanceAmount = document.querySelector(".balance-amount");
  const bonusList = document.querySelector(".bonus-list");

  try {
      const earningsData = await fetchEarningsData(userId);

      // Display the available balance
      balanceAmount.textContent = `$${earningsData.balance.toFixed(2)}`;

      // Display the list of bonuses earned
      if (earningsData.bonuses.length === 0) {
          bonusList.innerHTML = "No bonuses earned.";
      } else {
          bonusList.innerHTML = earningsData.bonuses
              .map(
                  (bonus) =>
                      `<li>${bonus.date} - Bonus: $${bonus.amount.toFixed(2)}</li>`
              )
              .join("");
      }
  } catch (error) {
      console.error("Error fetching earnings data:", error);
      balanceAmount.textContent = "Error loading earnings data.";
  }
}


// Call the renderEarnings function to display earnings and bonuses information
renderEarnings(userId);
// JavaScript code in your scripts.js file

// Function to fetch user profile data (Replace with actual API calls)
function fetchUserProfile(userId) {
  // Simulate fetching data from an API using user ID
  return new Promise((resolve) => {
      // Replace this with your actual API endpoint or data retrieval logic
      setTimeout(() => {
          const userData = {
              name: username, // Replace with actual user data
              userId: user_phone_number,
              // Add more profile fields as needed
          };
          resolve(userData);
      }, 1000); // Simulating a delay
  });
}

// Function to fetch user settings data (Replace with actual API calls)
function fetchUserSettings(userId) {
  // Simulate fetching data from an API using user ID
  return new Promise((resolve) => {
      // Replace this with your actual API endpoint or data retrieval logic
      setTimeout(() => {
          const userSettings = {
              notification: true, // Replace with actual user settings data
              theme: "light",
              
              // Add more settings fields as needed
          };
          resolve(userSettings);
      }, 1000); // Simulating a delay
  });
}

// Function to render user profile information
async function renderUserProfile(userId) {
  const profileInfo = document.querySelector(".profile-info");

  try {
      const userData = await fetchUserProfile(userId);

      // Display user profile information
      profileInfo.innerHTML = `
          <p><strong>Username:</strong> ${userData.username}</p>
          <p><strong>Phone Number:</strong> ${userData.user_phone_number}</p>
          <!-- Add more profile fields here -->
      `;
  } catch (error) {
      console.error("Error fetching user profile data:", error);
      profileInfo.innerHTML = "Error loading user profile information.";
  }
}

// Function to render user settings
async function renderUserSettings(userId) {
  const settingsInfo = document.querySelector(".settings-info");

  try {
      const userSettings = await fetchUserSettings(userId);

      // Display user settings
      settingsInfo.innerHTML = `
          <p><strong>Receive Notifications:</strong> ${
              userSettings.notification ? "Yes" : "No"
          }</p>
          <p><strong>Theme:</strong> ${userSettings.theme}</p>
          <p><strong>Language:</strong> ${userSettings.language}</p>
          <p><strong>Timezone:</strong> ${userSettings.timezone}</p>
          <p><strong>Display Name:</strong> ${userSettings.displayName}</p>
          <!-- Add more settings fields here -->
      `;
  } catch (error) {
      console.error("Error fetching user settings data:", error);
      settingsInfo.innerHTML = "Error loading user settings information.";
  }
}

// Call the renderUserProfile and renderUserSettings functions to display user profile and settings
renderUserProfile(userId);
renderUserSettings(userId);




