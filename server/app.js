const express = require('express');
const cors = require('cors');
const app = express();
const PORT = process.env.PORT || 5000;

console.log("Server is starting...");

// Import routes
try {
    const studentRoutes = require('./routes/studentRoutes');
    const thesisRoutes = require('./routes/thesisRoutes');

    // Middleware
    app.use(cors());
    app.use(express.json());

    // Use routes
    app.use('/api/students', studentRoutes);
    app.use('/api/  ', thesisRoutes);

    // Start server
    app.listen(PORT, () => {
        console.log(`Server is running on port ${PORT}`);
    });

} catch (error) {
    console.error("Error while starting the server:", error);
}
