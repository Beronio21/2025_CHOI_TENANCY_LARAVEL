const express = require('express');
const router = express.Router();
const Admin = require('../models/Admin');

// GET: Retrieve all admins
router.get('/', async (req, res) => {
    const admins = await Admin.find();
    res.json(admins);
});

// POST: Add a new admin
router.post('/', async (req, res) => {
    const admin = new Admin(req.body);
    await admin.save();
    res.status(201).json(admin);
});

module.exports = router;
