const express = require('express');
const router = express.Router();
let messages = require('../../db/messagesdb');

// GET: Retrieve all messages or by receiver ID
router.get('/', (req, res) => {
    res.json(messages);
});

router.get('/:receiver_id', (req, res) => {
    const userMessages = messages.filter(m => m.receiver_id === req.params.receiver_id);
    res.json(userMessages);
});

// POST: Send a new message
router.post('/', (req, res) => {
    const newMessage = req.body;
    if (!newMessage.message_id || !newMessage.sender_id || !newMessage.receiver_id || !newMessage.content) {
        return res.status(400).send({ message: "Required fields are missing" });
    }

    messages.push(newMessage);
    res.status(201).json(newMessage);
});

// PATCH: Mark a message as read
router.patch('/:id', (req, res) => {
    const message = messages.find(m => m.message_id == req.params.id);
    if (!message) {
        return res.status(404).send({ message: "Message not found" });
    }

    // Update the `is_read` field
    message.is_read = true;
    res.json(message);
});

// DELETE: Remove a message by ID
router.delete('/:id', (req, res) => {
    const index = messages.findIndex(m => m.message_id == req.params.id);
    if (index === -1) {
        return res.status(404).send({ message: "Message not found" });
    }

    const deletedMessage = messages.splice(index, 1);
    res.json(deletedMessage[0]);
});

module.exports = router;
