// server/controllers/studentController.js
const Student = require('../models/Student');

// Get all students
exports.getStudents = async (req, res) => {
    try {
        const students = await Student.find();
        res.json(students);
    } catch (err) {
        res.status(500).json({ message: err.message });
    }
};

// Create a new student
exports.createStudent = async (req, res) => {
    const student = new Student(req.body);
    try {
        const newStudent = await student.save();
        res.status(201).json(newStudent);
    } catch (err) {
        res.status(400).json({ message: err.message });
    }
};

// Update an existing student by ID
exports.updateStudent = async (req, res) => {
    try {
        const updatedStudent = await Student.findByIdAndUpdate(req.params.id, req.body, { new: true });
        if (!updatedStudent) {
            return res.status(404).json({ message: 'Student not found' });
        }
        res.json(updatedStudent);
    } catch (err) {
        res.status(400).json({ message: err.message });
    }
};

// Delete a student by ID
exports.deleteStudent = async (req, res) => {
    try {
        const deletedStudent = await Student.findByIdAndDelete(req.params.id);
        if (!deletedStudent) {
            return res.status(404).json({ message: 'Student not found' });
        }
        res.json({ message: 'Student deleted' });
    } catch (err) {
        res.status(500).json({ message: err.message });
    }
};

// PATCH: Update specific fields of a student by student_id
exports.patchStudent = async (req, res) => {
    const { student_id } = req.params;
    const updateData = req.body;

    try {
        const updatedStudent = await Student.findOneAndUpdate(
            { student_id },
            { $set: updateData },
            { new: true } // Return the updated document
        );

        if (!updatedStudent) {
            return res.status(404).json({ message: 'Student not found' });
        }

        res.json(updatedStudent);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};
