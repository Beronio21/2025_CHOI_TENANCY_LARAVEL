const express = require('express');
const router = express.Router();
const Admin = require('../models/Admin');

// GET: Retrieve all admins
router.get('/', async (req, res) => {
    try {
        const admins = await Admin.find();
        res.json(admins);
    } catch (error) {
        console.error('Error retrieving admins:', error);
        res.status(500).json({ message: 'Server error while retrieving admins' });
    }
});

// GET: Retrieve an admin by ID
router.get('/:admin_id', async (req, res) => {
    try {
        const admin = await Admin.findById(req.params.admin_id);
        if (!admin) {
            return res.status(404).json({ message: 'Admin not found' });
        }
        res.json(admin);
    } catch (error) {
        console.error('Error retrieving admin:', error);
        res.status(500).json({ message: 'Server error while retrieving admin' });
    }
});

// POST: Add a new admin
router.post('/', async (req, res) => {
    const { first_name, last_name, email, password_hash, contact_number, role } = req.body;

    // Validate input
    if (!first_name || !last_name || !email || !password_hash || !contact_number || !role) {
        return res.status(400).json({ message: 'All fields are required' });
    }

    const admin = new Admin(req.body);
    try {
        await admin.save();
        res.status(201).json(admin);
    } catch (error) {
        console.error('Error saving admin:', error);
        res.status(400).json({ message: 'Error saving admin' });
    }
});

// PATCH: Update an existing admin
router.patch('/:admin_id', async (req, res) => {
    try {
        const updatedAdmin = await Admin.findByIdAndUpdate(req.params.admin_id, req.body, { new: true });
        if (!updatedAdmin) {
            return res.status(404).json({ message: 'Admin not found' });
        }
        res.json(updatedAdmin);
    } catch (error) {
        console.error('Error updating admin:', error);
        res.status(400).json({ message: 'Error updating admin' });
    }
});

// DELETE: Remove an admin by ID
router.delete('/:admin_id', async (req, res) => {
    try {
        const admin = await Admin.findById(req.params.admin_id);
        if (!admin) {
            return res.status(404).json({ message: 'Admin not found' });
        }

        await admin.remove();
        res.json({ message: 'Admin deleted successfully' });
    } catch (error) {
        console.error('Error deleting admin:', error);
        res.status(500).json({ message: 'Server error while deleting admin' });
    }
});

module.exports = router;
