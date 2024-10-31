// server/controllers/instructorController.js
const ThesisSubmission = require('../models/ThesisSubmission');
const Notification = require('../models/Notification');
const Message = require('../models/Message');

// Submissions
exports.getAllSubmissions = async (req, res) => {
    try {
        const submissions = await ThesisSubmission.find(); // You can add filtering logic here
        res.json(submissions);
    } catch (error) {
        res.status(500).json({ message: error.message });
    }
};

exports.getSubmissionById = async (req, res) => {
    try {
        const submission = await ThesisSubmission.findById(req.params.thesis_id);
        if (!submission) return res.status(404).json({ message: "Submission not found" });
        res.json(submission);
    } catch (error) {
        res.status(500).json({ message: error.message });
    }
};

exports.giveFeedback = async (req, res) => {
    try {
        const submission = await ThesisSubmission.findById(req.params.thesis_id);
        if (!submission) return res.status(404).json({ message: "Submission not found" });

        // Assume feedback is sent in the body
        submission.feedback = req.body.feedback;
        submission.grade = req.body.grade;
        await submission.save();

        res.json(submission);
    } catch (error) {
        res.status(500).json({ message: error.message });
    }
};

// Notifications
exports.getNotifications = async (req, res) => {
    try {
        const notifications = await Notification.find();
        res.json(notifications);
    } catch (error) {
        res.status(500).json({ message: error.message });
    }
};

exports.getNotificationsByStudentId = async (req, res) => {
    try {
        const notifications = await Notification.find({ student_id: req.params.student_id });
        res.json(notifications);
    } catch (error) {
        res.status(500).json({ message: error.message });
    }
};

exports.sendNotification = async (req, res) => {
    try {
        const newNotification = new Notification(req.body);
        await newNotification.save();
        res.status(201).json(newNotification);
    } catch (error) {
        res.status(400).json({ message: error.message });
    }
};

// Messages
exports.getMessagesByStudentId = async (req, res) => {
    try {
        const messages = await Message.find({ receiver_id: req.params.student_id });
        res.json(messages);
    } catch (error) {
        res.status(500).json({ message: error.message });
    }
};

exports.sendMessage = async (req, res) => {
    try {
        const newMessage = new Message(req.body);
        await newMessage.save();
        res.status(201).json(newMessage);
    } catch (error) {
        res.status(400).json({ message: error.message });
    }
};
