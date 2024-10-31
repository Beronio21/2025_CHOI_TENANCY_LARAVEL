const express = require('express');
const router = express.Router();
const Instructor = require('../models/Instructor'); // Ensure Instructor model exists

// GET: Retrieve all instructors
router.get('/', async (req, res) => {
    try {
        const instructors = await Instructor.find();
        res.json(instructors);
    } catch (err) {
        res.status(500).json({ message: err.message });
    }
});

// GET: Retrieve a specific instructor by ID
router.get('/:id', async (req, res) => {
    try {
        const instructor = await Instructor.findById(req.params.id);
        if (!instructor) {
            return res.status(404).json({ message: 'Instructor not found' });
        }
        res.json(instructor);
    } catch (err) {
        res.status(500).json({ message: err.message });
    }
});

// POST: Add a new instructor
router.post('/', async (req, res) => {
    const { instructor_id, first_name, last_name, email, password_hash, contact_number, department, position, profile_picture, total_reviews, created_at, updated_at } = req.body;

    const newInstructor = new Instructor({
        instructor_id,
        first_name,
        last_name,
        email,
        password_hash,
        contact_number,
        department,
        position,
        profile_picture,
        total_reviews,
        created_at,
        updated_at
    });

    try {
        const savedInstructor = await newInstructor.save();
        res.status(201).json(savedInstructor);
    } catch (err) {
        res.status(400).json({ message: err.message });
    }
});

// PATCH: Update an instructor's details
router.patch('/:id', async (req, res) => {
    try {
        const updatedInstructor = await Instructor.findByIdAndUpdate(req.params.id, req.body, { new: true });
        if (!updatedInstructor) {
            return res.status(404).json({ message: 'Instructor not found' });
        }
        res.json(updatedInstructor);
    } catch (err) {
        res.status(400).json({ message: err.message });
    }
});

// DELETE: Remove an instructor by ID
router.delete('/:id', async (req, res) => {
    try {
        const instructor = await Instructor.findByIdAndDelete(req.params.id);
        if (!instructor) {
            return res.status(404).json({ message: 'Instructor not found' });
        }
        res.json({ message: 'Instructor deleted successfully' });
    } catch (err) {
        res.status(500).json({ message: err.message });
    }
});

module.exports = router;
