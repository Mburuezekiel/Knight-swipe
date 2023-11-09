const express = require('express');
const app = express();
const port = 3000; // Set your desired port number

// Define middleware, body parser, and routes here

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
// Import your admin routes
const adminRoutes = require('./adminRoutes/admin');

// Use the admin routes
app.use('/admin', adminRoutes);

// The 'admin' prefix specifies that these routes are for admin-specific logic
