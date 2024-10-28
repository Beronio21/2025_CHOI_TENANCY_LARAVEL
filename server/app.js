// server/app.js
const express = require('express');
const cors = require('cors');
const app = express();
const PORT = process.env.PORT || 5000;
let studentdb = require('../db/studentdb');

// Middleware
app.use(cors());
app.use(express.json());

// GET: Retrieve all students or find a student by ID
app.get('/api/students', (req, res) => {
    res.json(studentdb);
});

app.get('/api/students/:id', (req, res) => {
    const student = studentdb.find(s => s.student_id === req.params.id);
    if (student) {
        res.json(student);
    } else {
        res.status(404).send({ message: "Student not found" });
    }
});

// POST: Add a new student
app.post('/api/students', (req, res) => {
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
app.put('/api/students/:id', (req, res) => {
    const index = studentdb.findIndex(s => s.student_id === req.params.id);
    if (index === -1) {
        return res.status(404).send({ message: "Student not found" });
    }

    // Replace the student data
    studentdb[index] = { ...req.body, student_id: req.params.id };
    res.json(studentdb[index]);
});

// PATCH: Update specific fields of student data
app.patch('/api/students/:id', (req, res) => {
    const student = studentdb.find(s => s.student_id === req.params.id);
    if (!student) {
        return res.status(404).send({ message: "Student not found" });
    }

    // Update fields provided in the request body
    Object.assign(student, req.body);
    res.json(student);
});

// DELETE: Remove a student
app.delete('/api/students/:id', (req, res) => {
    const index = studentdb.findIndex(s => s.student_id === req.params.id);
    if (index === -1) {
        return res.status(404).send({ message: "Student not found" });
    }

    // Remove the student from the array
    const deletedStudent = studentdb.splice(index, 1);
    res.json(deletedStudent[0]);
});

// Start server
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
