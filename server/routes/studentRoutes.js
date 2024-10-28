// server/routes/studentRoutes.js
const express = require('express');
const router = express.Router();
let studentdb = require('../../db/studentdb'); // Adjusted to go up a level


// GET: Retrieve all students or find a student by ID
router.get('/', (req, res) => {
    res.json(studentdb);
});

router.get('/:id', (req, res) => {
    const student = studentdb.find(s => s.student_id === req.params.id);
    if (student) {
        res.json(student);
    } else {
        res.status(404).send({ message: "Student not found" });
    }
});

// POST: Add a new student
router.post('/', (req, res) => {
    const newStudent = req.body;
    if (!newStudent.student_id) {
        return res.status(400).send({ message: "Student ID is required" });
    }
    
    const existingStudent = studentdb.find(s => s.student_id === newStudent.student_id);
    if (existingStudent) {
        return res.status(400).send({ message: "Student ID already exists" });
    }
    
    studentdb.push(newStudent);
    res.status(201).json(newStudent);
});

// PUT: Replace student data
router.put('/:id', (req, res) => {
    const index = studentdb.findIndex(s => s.student_id === req.params.id);
    if (index === -1) {
        return res.status(404).send({ message: "Student not found" });
    }

    // Replace the student data
    studentdb[index] = { ...req.body, student_id: req.params.id };
    res.json(studentdb[index]);
});

// PATCH: Update specific fields of student data
router.patch('/:id', (req, res) => {
    const student = studentdb.find(s => s.student_id === req.params.id);
    if (!student) {
        return res.status(404).send({ message: "Student not found" });
    }

    // Update fields provided in the request body
    Object.assign(student, req.body);
    res.json(student);
});

// DELETE: Remove a student
router.delete('/:id', (req, res) => {
    const index = studentdb.findIndex(s => s.student_id === req.params.id);
    if (index === -1) {
        return res.status(404).send({ message: "Student not found" });
    }

    // Remove the student from the array
    const deletedStudent = studentdb.splice(index, 1);
    res.json(deletedStudent[0]);
});

module.exports = router;
