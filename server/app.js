const express = require('express');
const cors = require('cors');
const app = express();
const PORT = process.env.PORT || 5000;

const studentRoutes = require('./routes/studentRoutes');
const thesisRoutes = require('./routes/thesisRoutes');
const notificationRoutes = require('./routes/notificationRoutes');
const messageRoutes = require('./routes/messageRoutes');
const submissionHistoryRoutes = require('./routes/submissionHistoryRoutes'); // New route for submission history

app.use(cors());
app.use(express.json());

app.use('/api/students', studentRoutes);
app.use('/api/thesis', thesisRoutes);
app.use('/api/notifications', notificationRoutes);
app.use('/api/messages', messageRoutes);
app.use('/api/submissionhistory', submissionHistoryRoutes); // Register submission history routes

app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
