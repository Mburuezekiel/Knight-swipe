// adminRoutes/admin.js

const express = require('express');
const adminRouter = express.Router();

// Middleware for admin authentication (you can implement your own authentication)

adminRouter.get('/dashboard', (req, res) => {
  // This route is for admin-specific content or settings
  res.send('Admin Dashboard');
});

module.exports = adminRouter;
