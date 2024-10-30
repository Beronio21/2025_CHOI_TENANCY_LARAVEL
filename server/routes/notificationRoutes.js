const express = require('express');
const router = express.Router();
let notifications = require('../../db/notificationdb');

// GET: Retrieve all notifications or by student ID
router.get('/', (req, res) => {
    res.json(notifications);
});

router.get('/:student_id', (req, res) => {
    const studentNotifications = notifications.filter(n => n.student_id === req.params.student_id);
    res.json(studentNotifications);
});

// POST: Add a new notification
router.post('/', (req, res) => {
    const newNotification = req.body;
    if (!newNotification.notification_id || !newNotification.student_id) {
        return res.status(400).send({ message: "Notification ID and Student ID are required" });
    }
    
    notifications.push(newNotification);
    res.status(201).json(newNotification);
});

// PATCH: Mark a notification as read
router.patch('/:id', (req, res) => {
    const notification = notifications.find(n => n.notification_id == req.params.id);
    if (!notification) {
        return res.status(404).send({ message: "Notification not found" });
    }

    // Update the `is_read` field
    notification.is_read = true;
    res.json(notification);
});

// DELETE: Remove a notification by ID
router.delete('/:id', (req, res) => {
    const index = notifications.findIndex(n => n.notification_id == req.params.id);
    if (index === -1) {
        return res.status(404).send({ message: "Notification not found" });
    }

    const deletedNotification = notifications.splice(index, 1);
    res.json(deletedNotification[0]);
});

module.exports = router;
